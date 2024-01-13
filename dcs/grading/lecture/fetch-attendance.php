<?php
include __DIR__ . '/../../config.php';
// Get the selected student ID from the AJAX request
$selectedStudentId = $_POST['selectedStudentId'];

// Prepare and execute the SQL query
$sql = "SELECT COUNT(*) AS count FROM tblattendance WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $selectedStudentId);
$stmt->execute();

// Bind the result variable
$stmt->bind_result($count);

// Fetch the result
$stmt->fetch();

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the count as a response to the AJAX request
echo $count;

?>