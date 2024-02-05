<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Lectures Data</title>
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
// Include the database configuration
include __DIR__ . '/../../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the dropdown option is set
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Fetch data from tbl_lecture or tbl_lab_lecture based on the filter
if ($filter == 'lecture') {
    $table = 'tbl_lecture';
    $selectedOption = 'Lecture';
} elseif ($filter == 'lab') {
    $table = 'tbl_wlab';
    $selectedOption = 'Lecture with Lab';
} else {
    $table = 'all';
    $selectedOption = '';
}

// Display the dropdown menu with automatic submission
echo '<form method="get">';
echo '<label for="filter">Filter:</label>';
echo '<select name="filter" id="filter" onchange="this.form.submit()">';
echo '<option value="all" ' . ($filter == 'all' ? 'selected' : '') . '>All</option>';
echo '<option value="lecture" ' . ($filter == 'lecture' ? 'selected' : '') . '>Lecture</option>';
echo '<option value="lab" ' . ($filter == 'lab' ? 'selected' : '') . '>Lecture with Lab</option>';
echo '</select>';
echo '</form>';

// Display the selected option
if (!empty($selectedOption)) {
    echo '<h2> ' . $selectedOption . ' Records</h2>';
}

// Display the table based on the selected option
if ($table != 'all') {
    $sql = "SELECT l.id AS lecture_id, CONCAT(s.last_name, ', ', s.first_name, ' ', s.middle_name) AS selectedStudentName, l.studentNumber, l.finalgrade, l.consolidated FROM $table l JOIN tblstudents s ON l.selectedStudentId = s.id";
    $result = $conn->query($sql);

    // Display the table
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th style="width: auto;">Student Name</th>';
        echo '<th style="width: auto;">Student Number</th>';
        echo '<th style="width: auto;">Final Grade</th>';
        echo '<th style="width: auto;">Consolidated</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['selectedStudentName'] . '</td>';
            echo '<td>' . $row['studentNumber'] . '</td>';
            echo '<td>' . $row['finalgrade'] . '</td>';
            echo '<td>' . $row['consolidated'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No records found';
    }
} else {
    echo 'Please select a filter option.';
}

// Close connection
$conn->close();
?>

</body>
</html>
