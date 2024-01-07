<?php
date_default_timezone_set('Asia/Manila');

include 'phpqrcode/qrlib.php';
include 'config.php';

$currentPage = basename($_SERVER['PHP_SELF']);

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");


if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $name = $row['name'];
    } else {
        $name = "User Not Found"; // Set a default name for this case
    }
} else {
    die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentNumber = $_POST['student_number'] ?? '';

    // Validate the student number (you might want to add more validation)
    if (empty($studentNumber)) {
        die("Please enter a valid student number.");
    }

    $classId = $_GET['class_id'] ?? '';

    // Check if the student with the given student number exists
    $checkStudentQuery = "SELECT * FROM tblstudents WHERE student_number = ?";
    $stmtCheckStudent = $conn->prepare($checkStudentQuery);
    $stmtCheckStudent->bind_param("s", $studentNumber);

    // Execute and handle errors
    if (!$stmtCheckStudent->execute()) {
        die("Error checking student: " . $stmtCheckStudent->error);
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
            die("Error fetching section ID: " . $stmtFetchSection->error);
        }

        $resultSection = $stmtFetchSection->get_result();

        if ($resultSection->num_rows > 0) {
            $sectionData = $resultSection->fetch_assoc();
            $sectionId = $sectionData['section_id'];

            $stmtCheckClass->bind_param("iii", $classId, $year, $sectionId);

            // Execute and handle errors
            if (!$stmtCheckClass->execute()) {
                die("Error checking class: " . $stmtCheckClass->error);
            }

            $resultClass = $stmtCheckClass->get_result();

            if ($resultClass->num_rows > 0) {
                $classData = $resultClass->fetch_assoc();

                // Debugging output
                echo "Current Day: " . date('N') . "<br>";
                echo "Scheduled Day: " . $classData['day_name'] . "<br>";
                echo "Current Time: " . date('H:i:s') . "<br>";
                echo "Time: " . $classData['start_time'] . " - " . $classData['end_time'] . "<br>";

                // Check if the current day matches the scheduled day for the class
                $scheduledDay = date('N', strtotime($classData['day_name'])); // Convert day name to day of the week (1 to 7)

                if ($scheduledDay != date('N')) {
                    die("It's not the scheduled day for this class. Attendance cannot be marked.");
                }

                // Check if the current time is within the class time range
                $currentTime = strtotime(date('H:i:s'));
                $classStartTime = strtotime($classData['start_time']);
                $classEndTime = strtotime($classData['end_time']);

                if ($currentTime < $classStartTime || $currentTime > $classEndTime) {
                    die("It's currently not the class time. Attendance cannot be marked.");
                }

                // Check if the student has already marked attendance for this class
                $checkAttendanceQuery = "SELECT * FROM tblattendance WHERE class_id = ? AND student_id = ?";
                $stmtCheckAttendance = $conn->prepare($checkAttendanceQuery);
                $stmtCheckAttendance->bind_param("ii", $classId, $studentData['id']);

                // Execute and handle errors
                if (!$stmtCheckAttendance->execute()) {
                    die("Error checking attendance: " . $stmtCheckAttendance->error);
                }

                $resultAttendance = $stmtCheckAttendance->get_result();

                if ($resultAttendance->num_rows > 0) {
                    echo "Attendance already marked for this class.";
                } else {
                    // Set the attendance status explicitly to "present" or "late"
                    $attendanceStatus = determineAttendanceStatus($classData, $currentTime);

                    // Insert attendance record into tblattendance
                    $insertAttendanceQuery = "INSERT INTO tblattendance (class_id, student_id, attendance_status) VALUES (?, ?, ?)";
                    $stmtInsertAttendance = $conn->prepare($insertAttendanceQuery);
                    $stmtInsertAttendance->bind_param("iis", $classId, $studentData['id'], $attendanceStatus);

                    // Execute and handle errors
                    if (!$stmtInsertAttendance->execute()) {
                        die("Error marking attendance: " . $stmtInsertAttendance->error);
                    }

                    echo "Attendance marked successfully. Status: $attendanceStatus";
                }
            } else {
                echo "Class not found or class details do not match.";
            }
        } else {
            echo "Section not found for the given section name.";
        }
    } else {
        echo "Student not found with the given student number.";
    }

    // Close statements and the database connection
    $stmtCheckStudent->close();
    $stmtFetchSection->close();
    $stmtCheckClass->close();
    // (Close other statements as needed...)
    $conn->close();
}

// Function to determine attendance status based on current time and class schedule
function determineAttendanceStatus($classData, $currentTime) {
    $classStartTime = strtotime($classData['start_time']);
    $classEndTime = strtotime($classData['end_time']);

    // Adjust the threshold as needed
    $lateThreshold = 15 * 60; // 15 minutes

    if ($currentTime < $classStartTime + $lateThreshold) {
        return "present";
    } else {
        return "late";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DCS | Student Attendance Form</title>

  
    <!-- Font Awesome icons for additional styling and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Favicon for the website tab -->
    <link rel="icon" href="image/dcss.png" type="image"/>

    <!-- Bootstrap CSS for styling and layout components -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

    <!-- Custom styles for the post dashboard -->
    <link rel="stylesheet" href="css/postdashboard.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    
    <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>

    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />

    <!-- JavaScript module for application logic -->
    <script src="js/course.js" type="module"></script>
  </head>
  <body>
   <?php include 'inc/sidebar.php';?>

    <section class="content">
    <?php include 'inc/navbar.php';?>
<main>


<div class="head-title" >
          <div class="left">
            <h1>Student Attendance Form</h1>
            <ul class="breadcrumb">
            </ul>
          </div>
        </div>

<form method="post" action="">
    <label for="student_number">Student Number:</label>
    <input type="text" name="student_number" required><br>

    <input type="submit" value="Mark Attendance">
</form>

</body>
</html>