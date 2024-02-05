<?php
include __DIR__ . '/../../db/config.php';
error_log("Executing insert_data_wlab.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitAttendance"])) {
    // Retrieve form data
    $selectedStudentId = $_POST["selectedStudentId"];
    $studentNumber = $_POST["studentNumber"];
    $finalGrade = $_POST["finalGrade"];
    $consolidated = $_POST["consolidated"];

    // Check if finalGrade and consolidated are empty
    if (empty($finalGrade) || empty($consolidated)) {
        // Display a warning message
        echo "Please finish computation first before submitting grade!";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tbl_wlab (selectedStudentId, studentNumber, finalGrade, consolidated) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iidd", $selectedStudentId, $studentNumber, $finalGrade, $consolidated);

        // Execute the statement
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "Grades submitted successfully!";
        } else {
            // Error occurred during insertion
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
} else {
    // Invalid request method or form not submitted
    echo "Invalid request method or form not submitted.";
}

// Close the database connection
$conn->close();
?>