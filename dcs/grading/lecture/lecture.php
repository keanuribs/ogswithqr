<?php
include __DIR__ . '/../../config.php';

// Assuming your database connection is in $conn variable

// Function to display data from a table
function displayTableData($tableName, $conn)
{
    // Display data from the specified table
    $sqlData = "SELECT * FROM $tableName";
    $resultData = $conn->query($sqlData);

    echo "<h2>Displaying Data from $tableName</h2>";
    if ($resultData->num_rows > 0) {
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';

        // Output column names as table headers
        $resultColumns = $conn->query("SHOW COLUMNS FROM $tableName");
        while ($rowColumn = $resultColumns->fetch_assoc()) {
            echo '<th>' . $rowColumn['Field'] . '</th>';
        }

        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row from the table
        while ($rowData = $resultData->fetch_assoc()) {
            echo '<tr>';
            foreach ($rowData as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No data found for $tableName";
    }
}

// Call the function for each table
displayTableData('lecture', $conn);
displayTableData('quiz', $conn);
displayTableData('output_portfolio', $conn);
displayTableData('midterm', $conn);

// Close the database connection
$conn->close();
?>
