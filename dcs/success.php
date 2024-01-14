<?php
// Retrieve the class ID from the query parameter
$classId = $_GET['class_id'] ?? '';

// Display success message with QR code and verification link
echo "Class created successfully! QR Code generated: <img src='qrcodes/class_$classId.png' width='150' height='150'><br>";
echo "To verify attendance, students can scan the QR code or click the link below:<br>";
echo "<a href='verify-attendance.php?class_id=$classId' target='_blank'>Verify Attendance</a>";

// Provide a link to go back to the class creation page
echo "<br><br>Redirecting to class creation page in 5 seconds...";
header("refresh:5;url=create-class-attendance.php");
?>
