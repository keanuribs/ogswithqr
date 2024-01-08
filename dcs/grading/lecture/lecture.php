<?php

// Include the config.php file
include __DIR__ . '/../../config.php';  

// Function to fetch data from a table
function fetchTableData($mysqli, $tableName, $excludeColumns = array()) {
    $columns = array();
    $data = array();

    // Get column names
    $result = $mysqli->query("SHOW COLUMNS FROM $tableName");
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }

    // Remove excluded columns
    $columns = array_diff($columns, $excludeColumns);

    // Fetch data
    $result = $mysqli->query("SELECT * FROM $tableName");
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return array('columns' => $columns, 'data' => $data);
}
// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch data from each table
$lectureData = fetchTableData($mysqli, 'lecture', array('id', 'option_selected'));
$quizData = fetchTableData($mysqli, 'quiz', array('id', 'option_selected'));
$outputPortfolioData = fetchTableData($mysqli, 'output_portfolio', array('id', 'option_selected'));
$midtermData = fetchTableData($mysqli, 'midterm', array('id', 'option_selected'));

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Lecture Data</h2>
<table>
    <tr>
        <?php foreach ($lectureData['columns'] as $column): ?>
            <th><?= $column ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($lectureData['data'] as $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?= $value ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Quiz Data</h2>
<table>
    <!-- Similar code for displaying quiz data -->

<h2>Output Portfolio Data</h2>
<table>
    <!-- Similar code for displaying output portfolio data -->

<h2>Midterm Data</h2>
<table>
    <!-- Similar code for displaying midterm data -->

</body>
</html>
