<?php
include __DIR__ . '/../../config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission and database insertion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $conn->real_escape_string($_POST["student_name"]);
    $student_number = intval($_POST["student_number"]);
    $attendance_score = floatval($_POST["attendance_score"]);
    $participation_score = floatval($_POST["participation_score"]);

    // Retrieve quiz scores and totals
    $quiz_scores = array();
    $quiz_totals = array();
    for ($i = 1; $i <= 10; $i++) {
        $quiz_scores[$i] = floatval($_POST["quiz{$i}_score"]);
        $quiz_totals[$i] = floatval($_POST["quiz{$i}_total"]);
    }

    // Retrieve portfolio scores and totals
    $portfolio_scores = array();
    $portfolio_totals = array();
    for ($i = 1; $i <= 10; $i++) {
        $portfolio_scores[$i] = floatval($_POST["portfolio{$i}_score"]);
        $portfolio_totals[$i] = floatval($_POST["portfolio{$i}_total"]);
    }

    // Retrieve finals scores and total
    $finals_score = floatval($_POST["finals_score"]);
    $finals_total = floatval($_POST["finals_total"]);

    // Insert data into the combined table
    $sql = "INSERT INTO FinalsData (student_name, student_number, attendance_score, participation_score, ";
    $sql .= "quiz1_score, quiz1_total, quiz2_score, quiz2_total, quiz3_score, quiz3_total, quiz4_score, quiz4_total, quiz5_score, quiz5_total, quiz6_score, quiz6_total, quiz7_score, quiz7_total, quiz8_score, quiz8_total, quiz9_score, quiz9_total, quiz10_score, quiz10_total, ";
    $sql .= "portfolio1_score, portfolio1_total, portfolio2_score, portfolio2_total, portfolio3_score, portfolio3_total, portfolio4_score, portfolio4_total, portfolio5_score, portfolio5_total, portfolio6_score, portfolio6_total, portfolio7_score, portfolio7_total, portfolio8_score, portfolio8_total, portfolio9_score, portfolio9_total, portfolio10_score, portfolio10_total, finals_score, finals_total) VALUES ('$student_name', $student_number, $attendance_score, $participation_score, ";
    $sql .= implode(", ", $quiz_scores) . ", " . implode(", ", $quiz_totals) . ", " . implode(", ", $portfolio_scores) . ", " . implode(", ", $portfolio_totals) . ", $finals_score, $finals_total)";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture Input Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }

        input {
            width: 100%;
            box-sizing: border-box;
        }

        input[type="number"] {
    -moz-appearance: textfield; /* Firefox */
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none; /* Safari and Chrome */
    margin: 0;
}

    </style>
</head>
<body>
    <h1>Lecture Input Table</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <thead>
                <th colspan="20">Students</th>
                <tr>
                    <th rowspan="2">Student Name</th>
                    <th rowspan="2">Student Number</th>
                    <th rowspan="2">Attendance</th>
                    <th rowspan="2">Participation</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th colspan="2">Quiz <?php echo $i ?></th>
                    <?php endfor; ?>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th colspan="2">Portfolio <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Finals</th>
                </tr>
                <tr>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                        <th class="total">Total</th>
                    <?php endfor; ?>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                        <th class="total">Total</th>
                    <?php endfor; ?>
                    <th>Score</th>
                    <th class="total">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="student_name" required></td>
                    <td><input type="number" name="student_number" required></td>
                    <td><input type="number" step="0.01" name="attendance_score" required></td>
                    <td><input type="number" step="0.01" name="participation_score" required></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" required></td>
                        <td><input type="number" step="0.01" name="quiz<?php echo $i ?>_total" required></td>
                    <?php endfor; ?>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" required></td>
                        <td><input type="number" step="0.01" name="portfolio<?php echo $i ?>_total" required></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="finals_score" required></td>
                    <td><input type="number" step="0.01" name="finals_total" required></td>
                </tr>
            </tbody>
        </table>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
