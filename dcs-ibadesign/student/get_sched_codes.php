<?php
include '../db/config.php';

$query = "SELECT sched_code FROM subjects"; 

$result = mysqli_query($conn, $query);

if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Error fetching sched codes']);
}
?>