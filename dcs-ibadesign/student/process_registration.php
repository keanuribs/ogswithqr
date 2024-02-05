<?php
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Personal Information
    $studentNumber = $_POST['studentNumber'];
    $middleName = $_POST['middleName'];
    $semester = $_POST['semester'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    $schoolYear = $_POST['schoolYear'];
    $status = $_POST['status'];
    $major = $_POST['major'];
    $address = $_POST['address'];

    // Subject Registration
    $subjectCount = isset($_POST['subjectCount']) ? (int)$_POST['subjectCount'] : 0;
    $schedCodes = $_POST['schedCodes'];
    $courseCodes = $_POST['courseCodes'];
    $courseDescs = $_POST['courseDescs'];

    // Get user_id from session
    session_start();
    $user_id = isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : null;

    // Perform database insertion for Personal Information or update if user_id already exists
    $query = "INSERT INTO students (student_number, user_id, middle_name, semester, course, section, school_year, status, major, address) 
              VALUES ('$studentNumber', '$user_id', '$middleName', '$semester', '$course', '$section', '$schoolYear', '$status', '$major', '$address')
              ON DUPLICATE KEY UPDATE student_number = VALUES(student_number),
              user_id = VALUES(user_id), middle_name = VALUES(middle_name), semester = VALUES(semester), course = VALUES(course),
              section = VALUES(section), school_year = VALUES(school_year), status = VALUES(status), major = VALUES(major), address = VALUES(address)";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $affectedRows = mysqli_affected_rows($conn);

        if ($affectedRows > 0) {
            // Perform database insertion for Subject Registration
            for ($i = 0; $i < $subjectCount; $i++) {
                $schedCode = mysqli_real_escape_string($conn, $schedCodes[$i]);
                $courseCode = mysqli_real_escape_string($conn, $courseCodes[$i]);
                $courseDesc = mysqli_real_escape_string($conn, $courseDescs[$i]);

                $query = "INSERT INTO subject_registration (student_number, sched_code, course_code, course_desc) 
                          VALUES ('$studentNumber', '$schedCode', '$courseCode', '$courseDesc')";
                $resultSubject = mysqli_query($conn, $query);

                if (!$resultSubject) {
                    // Log the error and break the loop
                    error_log("Error inserting into subject_registration table: " . mysqli_error($conn));
                    break;
                }
            }

            // Check if there were no errors in the subject registration insertion
            if ($resultSubject) {
                echo json_encode(['success' => 'Registration successful']);
            } else {
                echo json_encode(['error' => 'Error inserting into subject_registration table']);
            }
        } else {
            // Show an error message if no rows were affected
            echo json_encode(['error' => 'Error inserting or updating personal information: No rows affected']);
        }
    } else {
        // Show detailed error message
        echo json_encode(['error' => 'Error inserting or updating personal information: ' . mysqli_error($conn)]);
    }
} else {
    // Show an error message for an invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
