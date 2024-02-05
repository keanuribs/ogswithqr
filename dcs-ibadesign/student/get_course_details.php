<?php
include '../db/config.php';

if (isset($_GET['schedCode'])) {
    $schedCode = mysqli_real_escape_string($conn, $_GET['schedCode']);

    $query = "SELECT course_code, course_desc FROM subjects WHERE sched_code = '$schedCode'";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Error fetching course details']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>