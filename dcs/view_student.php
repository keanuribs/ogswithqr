<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
include 'config.php'; // Include your database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the class ID is set
$classID = isset($_GET['class_id']) ? $_GET['class_id'] : null;

// Fetch attendance data based on the class ID
$sql = "SELECT a.id, class_id, CONCAT(s.last_name, ', ', s.first_name, ' ', s.middle_name) AS student_name, a.attendance_status, a.attendance_time
        FROM tblattendance a
        JOIN tblclass c ON a.class_id = c.id
        JOIN tblstudents s ON a.student_id = s.id
        WHERE a.class_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $classID);
$stmt->execute();
$result = $stmt->get_result();

// Display the table
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th style="width: auto;">Student Name</th>';
    echo '<th style="width: auto;">Attendance Status</th>';
    echo '<th style="width: auto;">Attendance Time</th>';
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['student_name'] . '</td>';
        echo '<td>' . $row['attendance_status'] . '</td>';
        echo '<td>' . $row['attendance_time'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No attendance records found for the specified class';
}

// Close connection
$stmt->close();
$conn->close();
?>

</body>
</html>