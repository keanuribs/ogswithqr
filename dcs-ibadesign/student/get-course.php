<?php
include '../db/config.php';

$query = mysqli_query($conn, "SELECT course_id, courses FROM course");
$result = array();

if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }

    echo json_encode(['courses' => $result]);
} else {
    echo json_encode(['error' => 'Error fetching courses']);
}
?>
