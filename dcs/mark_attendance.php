<?php
date_default_timezone_set('Asia/Manila');

include 'phpqrcode/qrlib.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentNumber = $_POST['student_number'] ?? '';

    // Validate the student number (you might want to add more validation)
    if (empty($studentNumber)) {
        echo "<div style='text-align: center; color: red; margin-top: 20px;'>Please enter a valid student number.</div>";
        die();
    }

    $classId = $_GET['class_id'] ?? '';

    // Check if the student with the given student number exists
    $checkStudentQuery = "SELECT * FROM tblstudents WHERE student_number = ?";
    $stmtCheckStudent = $conn->prepare($checkStudentQuery);
    $stmtCheckStudent->bind_param("s", $studentNumber);

    // Execute and handle errors
    if (!$stmtCheckStudent->execute()) {
        echo "<div style='text-align: center; color: red; margin-top: 20px;'>Error checking student.</div>";
        die();
    }

    $resultStudent = $stmtCheckStudent->get_result();

    if ($resultStudent->num_rows > 0) {
        $studentData = $resultStudent->fetch_assoc();

        $year = $studentData['year'] ?? '';
        $section = $studentData['section'] ?? '';
        $course = $studentData['course'] ?? '';

        // Check if the class exists and retrieve class data
        $checkClassQuery = "SELECT c.*, d.day_name FROM tblclass c 
                    INNER JOIN tbldays d ON c.day_id = d.day_id
                    WHERE c.id = ? AND c.year_level = ? AND c.section_id = ?";
        $stmtCheckClass = $conn->prepare($checkClassQuery);

        // Fetch the ID from tblsection based on the section
        $fetchSectionQuery = "SELECT section_id FROM tblsection WHERE section_name = ?";
        $stmtFetchSection = $conn->prepare($fetchSectionQuery);
        $stmtFetchSection->bind_param("s", $section);

        // Execute and handle errors
        if (!$stmtFetchSection->execute()) {
            echo "<div style='text-align: center; color: red; margin-top: 20px;'>Error fetching section ID.</div>";
            $stmtCheckStudent->close();
            die();
        }

        $resultSection = $stmtFetchSection->get_result();

        if ($resultSection->num_rows > 0) {
            $sectionData = $resultSection->fetch_assoc();
            $sectionId = $sectionData['section_id'];

            $stmtCheckClass->bind_param("iii", $classId, $year, $sectionId);

            // Execute and handle errors
            if (!$stmtCheckClass->execute()) {
                echo "<div style='text-align: center; color: red; margin-top: 20px;'>Error checking class.</div>";
                $stmtCheckStudent->close();
                $stmtFetchSection->close();
                die();
            }

            $resultClass = $stmtCheckClass->get_result();

            if ($resultClass->num_rows > 0) {
                $classData = $resultClass->fetch_assoc();

                // Check if the current day matches the scheduled day for the class
                $scheduledDay = date('N', strtotime($classData['day_name'])); // Convert day name to day of the week (1 to 7)

                if ($scheduledDay != date('N')) {
                    echo "<div style='text-align: center; color: red; margin-top: 20px;'>It's not the scheduled day for this class. Attendance cannot be marked.</div>";
                    $stmtCheckStudent->close();
                    $stmtFetchSection->close();
                    $stmtCheckClass->close();
                    die();
                }

                // Check if the current time is within the class time range
                $currentTime = strtotime(date('H:i:s'));
                $classStartTime = strtotime($classData['time']);
                $classEndTime = strtotime($classData['time_end']);

                if ($currentTime < $classStartTime || $currentTime > $classEndTime) {
                    echo "<div style='text-align: center; color: red; margin-top: 20px;'>It's currently not the class time. Attendance cannot be marked.</div>";
                    $stmtCheckStudent->close();
                    $stmtFetchSection->close();
                    $stmtCheckClass->close();
                    die();
                }

                // Check if the student has already marked attendance for this class
                $checkAttendanceQuery = "SELECT * FROM tblattendance WHERE class_id = ? AND student_id = ?";
                $stmtCheckAttendance = $conn->prepare($checkAttendanceQuery);
                $stmtCheckAttendance->bind_param("ii", $classId, $studentData['id']);

                // Execute and handle errors
                if (!$stmtCheckAttendance->execute()) {
                    echo "<div style='text-align: center; color: red; margin-top: 20px;'>Error checking attendance.</div>";
                    $stmtCheckStudent->close();
                    $stmtFetchSection->close();
                    $stmtCheckClass->close();
                    die();
                }

                $resultAttendance = $stmtCheckAttendance->get_result();

                if ($resultAttendance->num_rows > 0) {
                    echo "<div style='text-align: center; margin-top: 20px;'>Attendance already marked for this class.</div>";
                } else {
                    // Determine the attendance status based on the current time
                    $timeBuffer = 15 * 60; // 15 minutes buffer in seconds
                    if ($currentTime < $classStartTime) {
                        $attendanceStatus = 'present';
                    } elseif ($currentTime <= $classEndTime) {
                        $attendanceStatus = 'late';
                    } else {
                        echo "<div style='text-align: center; color: red; margin-top: 20px;'>It's currently not the class time. Attendance cannot be marked.</div>";
                        $stmtCheckStudent->close();
                        $stmtFetchSection->close();
                        $stmtCheckClass->close();
                        die();
                    }

                    // Continue with the rest of your code...
                    // (Get student ID, mark attendance, etc.)

                    // For example, you can insert attendance record into tblattendance with status
                    $insertAttendanceQuery = "INSERT INTO tblattendance (class_id, student_id, attendance_time, attendance_status) VALUES (?, ?, NOW(), ?)";
                    $stmtInsertAttendance = $conn->prepare($insertAttendanceQuery);
                    $stmtInsertAttendance->bind_param("iis", $classId, $studentData['id'], $attendanceStatus);

                    // Execute and handle errors
                    if ($stmtInsertAttendance->execute()) {
                        // Mark attendance successfully
                        echo "<div style='text-align: center; margin-top: 20px;'>Attendance marked successfully.</div>";
                    } else {
                        echo "<div style='text-align: center; color: red; margin-top: 20px;'>Error marking attendance.</div>";
                    }

                    $stmtInsertAttendance->close();
                }
            } else {
                echo "<div style='text-align: center; color: red; margin-top: 20px;'>Class not found or class details do not match.</div>";
            }
        } else {
            echo "<div style='text-align: center; color: red; margin-top: 20px;'>Section not found for the given section name.</div>";
        }
    } else {
        echo "<div style='text-align: center; color: red; margin-top: 20px;'>Student not found with the given student number.</div>";
    }

    // Close statements and the database connection
    $stmtCheckStudent->close();
    $stmtFetchSection->close();
    $stmtCheckClass->close();
    // (Close other statements as needed...)
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            margin: 50px auto;
            padding: 20px;
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 20px;
            text-align: center;
        }

        .success-message {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 style="text-align: center;">Student Attendance Form</h2>

    <form method="post" action="" style="text-align: center;">
        <label for="student_number">Student Number:</label>
        <input type="text" name="student_number" required><br>

        <input type="submit" value="Mark Attendance">
    </form>

    <?php
    if (isset($successMessage)) {
        echo "<div class='success-message'>$successMessage</div>";
    }
    ?>
</div>

</body>
</html>