<?php
// Include the database configuration
include __DIR__ . '/../../config.php';

// Fetch existing students for dropdown
$studentsQuery = "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, student_number FROM tblstudents";

$studentsResult = $conn->query($studentsQuery);
$students = [];

// Default student ID
/*$selectedStudentId = 1; // Replace with your default value or leave it empty

// Check if a student ID is provided in the form
if (isset($_POST['selectedStudentId'])) {
    $selectedStudentId = $_POST['selectedStudentId'];
}

// Prepare and execute the SQL query
$sql = "SELECT COUNT(*) AS count FROM tblattendance WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $selectedStudentId);
$stmt->execute();

// Bind the result variable
$stmt->bind_result($count);

// Fetch the result
$stmt->fetch();*/

while ($row = $studentsResult->fetch_assoc()) {
    $students[] = $row;
}

// Initialize total attendance
$totalAttendance = 0;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $conn->real_escape_string($_POST["student_name"]);
    $student_number = intval($_POST["student_number"]);

    // Retrieve total attendance status for the selected student
    $attendanceQuery = "SELECT COUNT(attendance_status) AS total_attendance FROM tblattendance WHERE student_id = (SELECT id FROM tblstudents WHERE student_number = $student_number)";
    $attendanceResult = $conn->query($attendanceQuery);

    if ($attendanceResult) {
        $attendanceRow = $attendanceResult->fetch_assoc();
        $totalAttendance = $attendanceRow['total_attendance'];
    } else {
        $totalAttendance = 0; // Default value if there's an error
    }
}

// Form submission and database insertion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $participation_score = floatval($_POST["participation_score"]);

    // Retrieve quiz scores and totals
    $quiz_scores = $quiz_totals = $portfolio_scores = $portfolio_totals = [];

    for ($i = 1; $i <= 10; $i++) {
        $quiz_scores[$i] = floatval($_POST["quiz{$i}_score"]);
        $quiz_totals[$i] = floatval($_POST["quiz{$i}_total"]);
        $portfolio_scores[$i] = floatval($_POST["portfolio{$i}_score"]);
        $portfolio_totals[$i] = floatval($_POST["portfolio{$i}_total"]);
    }

    // Retrieve midterm scores and total
    $midterm_score = floatval($_POST["midterm_score"]);
    $midterm_total = floatval($_POST["midterm_total"]);

    // Insert data into the database
    $sql = "INSERT INTO LectureData (student_name, student_number, attendance_score, participation_score, ";
    $sql .= "quiz1_score, quiz1_total, quiz2_score, quiz2_total, quiz3_score, quiz3_total, quiz4_score, quiz4_total, quiz5_score, quiz5_total, quiz6_score, quiz6_total, quiz7_score, quiz7_total, quiz8_score, quiz8_total, quiz9_score, quiz9_total, quiz10_score, quiz10_total, ";
    $sql .= "portfolio1_score, portfolio1_total, portfolio2_score, portfolio2_total, portfolio3_score, portfolio3_total, portfolio4_score, portfolio4_total, portfolio5_score, portfolio5_total, portfolio6_score, portfolio6_total, portfolio7_score, portfolio7_total, portfolio8_score, portfolio8_total, portfolio9_score, portfolio9_total, portfolio10_score, portfolio10_total, ";
    $sql .= "midterm_score, midterm_total) VALUES ('$student_name', $student_number, $totalAttendance, $participation_score, ";
    $sql .= implode(", ", $quiz_scores) . ", " . implode(", ", $quiz_totals) . ", " . implode(", ", $portfolio_scores) . ", " . implode(", ", $portfolio_totals) . ", $midterm_score, $midterm_total)";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch attendance count for the selected student (AJAX request)
if (isset($_GET['fetch_attendance']) && $_GET['fetch_attendance'] == 1) {
    $student_number_for_attendance = intval($_GET['student_number']);
    $attendanceQuery = "SELECT COUNT(attendance_status) AS total_attendance FROM tbl_attendance WHERE student_id = (SELECT id FROM tblstudents WHERE student_number = $student_number_for_attendance)";
    $attendanceResult = $conn->query($attendanceQuery);

    if ($attendanceResult) {
        $attendanceRow = $attendanceResult->fetch_assoc();
        echo $attendanceRow['total_attendance'];
    } else {
        echo 0; // Default value if there's an error
    }

    exit; // Stop further processing
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        #studentNumber {
            width: auto;
            max-width: 80px; /* Adjust this value based on your preference */
        }
    </style>
</head>
<body>
    <!--Input lecture table-->
    <h1>Lecture Input Table</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <thead>
                <th colspan="20">Midterm</th>
                <tr>
                    <th rowspan="4">Student Name</th>
                    <th rowspan="4">Student Number</th>
                    <th colspan="2">Attendance</th>
                    <th colspan="2">Participation</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Quiz <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Quiz total</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Portfolio <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Portfolio total</th>
                    <th colspan="4">Midterm</th>
                </tr>
                <tr>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th>Score</th>
                    <th class="total">Weighted</th>
                </tr>
                <tr>
                    <td><input type="number" step="0.01" name="attendance_score" id="attendanceTotalScore" oninput="allAttPart()"></td>
                    <th>10%</td>
                    <td><input type="number" step="0.01" name="participation_score" id="participationTotal-score" oninput="allAttPart()"></td>
                    <th>10%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="quiztotal<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="quizscore_total" id="quizscore-total"></td>
                    <th>15%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="portfoliototal<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="portfolioscore_total" id="portfolioscore-total"></td>
                    <th>25%</td>
                    <th><input type="number" step="0.01" name="midtermscore_total" id="midtermscore-total" oninput="alltotal_BM()"></td>
                    <th>20%</td>  
                </tr>
                <tr>
                    <?php for ($i = 1; $i <= 14; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th>Score</th>
                    <th class="total">Weighted</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="student_name" id="studentName" required>
                            <?php foreach ($students as $student) : ?>
                                <option value="<?php echo $student['full_name']; ?>" data-student-number="<?php echo $student['student_number']; ?>">
                                    <?php echo $student['full_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="text" name="student_number" id="studentNumber" readonly></td>
                    <td><input type="number" step="0.01" name="attendance_score" id="attendanceScore" value="<?php echo $totalAttendance; ?>" onchange="allAttPart()"></td>
                    <td><input type="number" step="0.01" name="attendance_weighted" id="attendanceWeighted" oninput="allAttPart()"></td>
                    <td><input type="number" step="0.01" name="participation_score" id="participation-score" oninput="allAttPart()"></td>
                    <td><input type="number" step="0.01" name="participation_weighted" id="participation-weighted" oninput="allAttPart()"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="quiz<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="quiz_total" id="quiz-total"></td>
                    <td><input type="number" step="0.01" name="quiz_weighted" id="quiz-weighted"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="portfolio<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="portfolio_total" id="portfolio-total"></td>
                    <td><input type="number" step="0.01" name="portfolio_weighted" id="portfolio-weighted"></td>
                    <td><input type="number" step="0.01" name="midterm_score" id="midterm-score" oninput="alltotal_BM()"></td>
                    <td><input type="number" step="0.01" name="midterm_weighted" id="midterm-weighted" readonly></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <th colspan="20">Performance after Midterm</th>
                <tr>
                    <th colspan="3">Attendance after Midterm</th>
                    <th colspan="3">Participation after Midterm</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Quiz <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Quiz total</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Portfolio <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Portfolio total</th>
                    <th colspan="4">Finals</th>
                </tr>
                <tr>
                    <th class="total">Current</th>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th class="total">Current</th>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th>Score</th>
                    <th class="total">Weighted</th>
                </tr>
                <tr>
                    <td><input type="number" name="attendancetotal_cur" id="AM-attendancetotalCurrent" oninput="allAttPart()"></td>
                    <td><input type="number" name="attendancetotal_Total" id="AM-attendanceTotalTotal" oninput="allAttPart()"></td>
                    <th>10%</th>
                    <td><input type="number" name="participationTotal_score" id="AM-participationTotalScore" oninput="allAttPart()"></td>
                    <td><input type="number" name="participationTotal_Total" id="AM-participationTotalTotal" oninput="allAttPart()"></td>
                    <th>10%</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="AM-quiztotal<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="quizscore_total" id="AM-quizscore-total"></td>
                    <th>15%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="AM-portfoliototal<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="portfolioscore_total" id="AM-portfolioscore-total"></td>
                    <th>25%</td>
                    <th><input type="number" step="0.01" name="midtermscore_total" id="AM-finalscore-total" oninput="alltotal_BM()"></td>
                    <th>20%</td>  
                </tr>
                <tr>
                    <?php for ($i = 1; $i <= 16; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <th>Score</th>
                    <th class="total">Weighted</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" name="attendance_cur" id="AM-attendanceScore" oninput="allAttPart()"></td>
                    <td><input type="number" name="attendance_Total" id="AM-attendanceTotal" oninput="allAttPart()"></td>
                    <td><input type="number" name="attendance_Weighted" id="AM-attendanceWeighted" oninput="allAttPart()"></td>
                    <td><input type="number" name="participation_score" id="AM-participationScore" oninput="allAttPart()"></td>
                    <td><input type="number" name="participation_Total" id="AM-participationTotal" oninput="allAttPart()"></td>
                    <td><input type="number" name="participation_Weighted" id="AM-participationWeighted" oninput="allAttPart()"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="AM-quiz<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="quiz_total" id="AM-quiz-total"></td>
                    <td><input type="number" step="0.01" name="quiz_weighted" id="AM-quiz-weighted"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="AM-portfolio<?php echo $i ?>-score" oninput="alltotal_BM()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="portfolio_total" id="AM-portfolio-total"></td>
                    <td><input type="number" step="0.01" name="portfolio_weighted" id="AM-portfolio-weighted"></td>
                    <td><input type="number" step="0.01" name="final_score" id="AM-final-score" oninput="alltotal_BM()"></td>
                    <td><input type="number" step="0.01" name="final_weighted" id="AM-final-weighted" readonly></td>
                </tr>
            </tbody>
        </table>     
    </form>

    <!--End of Lecture table-->

    <!--Input lab Table-->

    <h1>Lab Input Table</h1>

    <form>
        <table>
            <thead>
                <th colspan="20">Midterm</th>
                <tr>
                    <th colspan="2">Attendance</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Lab Activity <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Lab Activity total</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Practical Exam <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Practical Exam total</th>
                </tr>
                <tr>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                </tr>
                <tr>
                    <td><input type="number" step="0.01" name="attendance_score" id="lab-attendanceTotalScore" oninput="allAttPart()"></td>
                    <th>20%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="Lab Activity<?php echo $i ?>_score" id="BF-labacttotal<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="labactscore_total" id="BF-labactscore-total"></td>
                    <th>50%</td>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <th><input type="number" step="0.01" name="Practical Exam<?php echo $i ?>_score" id="BF-practexamtotal<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="practexamscore_total" id="BF-practexamscore-total"></td>
                    <th>30%</td>
                </tr>
                <tr>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" step="0.01" name="attendance_score" id="lab-attendanceScore" oninput="allAttPart()"></td>
                    <td><input type="number" step="0.01" name="attendance_weighted" id="lab-weightedScore"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="Lab Activity<?php echo $i ?>_score" id="BF-labact<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="BF-labact_total" id="BF-labact-total"></td>
                    <td><input type="number" step="0.01" name="BF-labact_weighted" id="BF-labact-weighted"></td>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <td><input type="number" step="0.01" name="Practical Exam<?php echo $i ?>_score" id="BF-practexam<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="BF-practexam_total" id="BF-practexam-total"></td>
                    <td><input type="number" step="0.01" name="BF-practexam_weighted" id="BF-practexam-weighted"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <th colspan="20">Performance after Midterm</th>
                <tr>
                    <th colspan="3">Attendance after midterm</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Lab Activity <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Lab Activity total</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Practical Exam <?php echo $i ?></th>
                    <?php endfor; ?>
                    <th colspan="2">Practical Exam total</th>
                </tr>
                <tr>
                    <th class="total">Current</th>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Total Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                </tr>
                <tr>
                    <td><input type="number" step="0.01" name="attendance_currentscore" id="AM-lab-attendanceCurrScore" oninput="allAttPart()"></td>
                    <td><input type="number" step="0.01" name="attendance_score" id="AM-lab-attendanceTotalScore" oninput="allAttPart()"></td>
                    <th>20%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="Lab Activity<?php echo $i ?>_score" id="AM-labacttotal<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="labactscore_total" id="AM-labactscore-total"></td>
                    <th>50%</td>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <th><input type="number" step="0.01" name="Practical Exam<?php echo $i ?>_score" id="AM-practexamtotal<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="practexamscore_total" id="AM-practexamscore-total"></td>
                    <th>30%</td>
                </tr>
                <tr>
                    <th class="total">Current</th>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <th>Score</th>
                    <?php endfor; ?>
                    <th class="total">Total</th>
                    <th class="total">Weighted</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" name="attendance_cur" id="AM-labattendanceScore" oninput="allAttPart()"></td>
                    <td><input type="number" name="attendance_Total" id="AM-labattendanceTotal" oninput="allAttPart()"></td>
                    <td><input type="number" name="attendance_Weighted" id="AM-labattendanceWeighted" oninput="allAttPart()"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="Lab Activity<?php echo $i ?>_score" id="AM-labact<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="labact_total" id="AM-labact-total"></td>
                    <td><input type="number" step="0.01" name="labact_weighted" id="AM-labact-weighted"></td>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <td><input type="number" step="0.01" name="Practical exam<?php echo $i ?>_score" id="AM-practexam<?php echo $i ?>-score" oninput="allLabTotal_BF()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="practexam_total" id="AM-practexam-total"></td>
                    <td><input type="number" step="0.01" name="practexam_weighted" id="AM-practexam-weighted" onchange="consolidation()" oninput="consolidation()"></td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td>Midterm Grade</td>
                    <td>Final Grade Grade</td>
                    <td>Transmuted Grade</td>
                </tr>
                <tr>
                    <td><input type="number" name="finalmidtermgrade" id="finalmidtermgrade" readonly></td>
                    <td><input type="number" name="finalgrade" id="finalgrade" readonly></td>
                    <td><input type="number" name="transmutedgrade" id="transmutedgrade" readonly></td>    
                </tr>
            </thead>
        </table>
    </form>
    <!-- End of Lab Input table-->
    
    <input type="submit" value="compute grade" onclick="consolidation()">

    <script>
        function consolidation(){
            //lecture
            var totalattendance=eval(document.getElementById('AM-attendanceWeighted').value);
            var totalparticipation=eval(document.getElementById('AM-participationWeighted').value);
            var totalquizes=eval(document.getElementById('AM-quiz-weighted').value);
            var totalportfolio=eval(document.getElementById('AM-portfolio-weighted').value);
            var totalmidterm=eval(document.getElementById('midterm-weighted').value);
            var totalfinals=eval(document.getElementById('AM-final-weighted').value);
            var totallecture=totalattendance+totalparticipation+totalquizes+totalportfolio+totalmidterm+totalfinals;
            var totallectureweighted=totallecture*0.75;

            //lab
            var totallabattendance=eval(document.getElementById('AM-labattendanceWeighted').value);
            var totallabactivity=eval(document.getElementById('AM-labact-weighted').value);
            var totalpractexam=eval(document.getElementById('AM-practexam-weighted').value);
            var totallab=totallabattendance+totallabactivity+totalpractexam;
            var totallabweighted=totallab*0.25;

            //finals
            var totalmidtermgrade=(eval(document.getElementById('attendanceWeighted').value)+eval(document.getElementById('participation-weighted').value)+eval(document.getElementById('quiz-weighted').value)+eval(document.getElementById('portfolio-weighted').value)+eval(document.getElementById('midterm-weighted').value)+eval(document.getElementById('lab-weightedScore').value)+eval(document.getElementById('BF-labact-weighted').value)+eval(document.getElementById('BF-practexam-weighted').value)).toFixed(2);
            var totalfinalgrade=(totallectureweighted+totallabweighted).toFixed(2);
            var transmutedgrade=0;
            if(totalfinalgrade<=49.99){
                transmutedgrade=5.0;
            }
            else if(totalfinalgrade>=50.0&&totalfinalgrade<=69.9){
                transmutedgrade=4.0;
            }
            else if(totalfinalgrade>=70.0&&totalfinalgrade<=73.3){
                transmutedgrade=3.0;
            }
            else if(totalfinalgrade>=73.4&&totalfinalgrade<=76.6){
                transmutedgrade=2.75;
            }
            else if(totalfinalgrade>=76.7&&totalfinalgrade<=80.0){
                transmutedgrade=2.50;
            }
            else if(totalfinalgrade>=80.1&&totalfinalgrade<=83.3){
                transmutedgrade=2.25;
            }
            else if(totalfinalgrade>=83.4&&totalfinalgrade<=86.6){
                transmutedgrade=2.0;
            }
            else if(totalfinalgrade>=86.7&&totalfinalgrade<=90.0){
                transmutedgrade=1.75;
            }
            else if(totalfinalgrade>=90.1&&totalfinalgrade<=93.3){
                transmutedgrade=1.5;
            }
            else if(totalfinalgrade>=93.4&&totalfinalgrade<=96.6){
                transmutedgrade=1.25;
            }
            else if(totalfinalgrade>=96.7&&totalfinalgrade<=100){
                transmutedgrade=1.0;
            }

            document.getElementById('finalmidtermgrade').value=totalmidtermgrade;
            document.getElementById('finalgrade').value=totalfinalgrade;
            document.getElementById('transmutedgrade').value=transmutedgrade;
            console.log(totalmidtermgrade);
            console.log(totalfinalgrade);
            console.log(transmutedgrade);
        }

        //attendance
        function allAttPart(){
            //lecture midterm
            var attendancetotal=eval(document.getElementById('attendanceTotalScore').value);
            var attendancescore=eval(document.getElementById('attendanceScore').value);
            var attendanceweighted=attendancescore/attendancetotal*10;
            var participationtotal=eval(document.getElementById('participationTotal-score').value);
            var participationscore=eval(document.getElementById('participation-score').value);
            var participationweighted=participationscore/participationtotal*10;


            document.getElementById('attendanceWeighted').value=attendanceweighted;
            document.getElementById('participation-weighted').value=participationweighted;

            //lecture finals
            var AM_attendancetotal=attendancetotal+eval(document.getElementById("AM-attendancetotalCurrent").value);
            var AM_attendancescore=attendancescore+eval(document.getElementById("AM-attendanceScore").value);
            var AM_attendanceweighted=AM_attendancescore/AM_attendancetotal*10;
            var AM_participationtotal=attendancetotal+eval(document.getElementById("AM-participationTotalScore").value);
            var AM_participationscore=attendancetotal+eval(document.getElementById("AM-participationScore").value);
            var AM_participationweighted=AM_participationscore/AM_participationtotal*10;

            document.getElementById('AM-attendanceTotalTotal').value=AM_attendancetotal;
            document.getElementById('AM-participationTotalTotal').value=AM_participationtotal;
            document.getElementById('AM-attendanceTotal').value=AM_attendancescore;
            document.getElementById('AM-attendanceWeighted').value=AM_attendanceweighted;
            document.getElementById('AM-participationTotal').value=AM_participationscore;
            document.getElementById('AM-participationWeighted').value=AM_participationweighted;

            //lab Midterm
            var Labattendancetotal=eval(document.getElementById('lab-attendanceTotalScore').value);
            var Labattendancescore=eval(document.getElementById('lab-attendanceScore').value);
            var Labattendanceweighted=Labattendancescore/Labattendancetotal*20;

            document.getElementById('lab-weightedScore').value=Labattendanceweighted;

            //lab Finals
            var AM_labattendancetotal=Labattendancetotal+eval(document.getElementById("AM-lab-attendanceCurrScore").value);
            var AM_labattendancescore=Labattendancescore+eval(document.getElementById("AM-labattendanceScore").value);
            var AM_labattendanceweighted=AM_labattendancescore/AM_labattendancetotal*20;

            document.getElementById('AM-lab-attendanceTotalScore').value=AM_labattendancetotal;
            document.getElementById('AM-labattendanceTotal').value=AM_labattendancescore;
            document.getElementById('AM-labattendanceWeighted').value=AM_labattendanceweighted;

        }

        //Lecture Midterm
        function alltotal_BM(){
            var quiztotal=0;
            var quizScoreTotal=0;
            var portfoliototal=0;
            var portfolioScoreTotal=0;
            var midtermscoretotal=document.getElementById('midtermscore-total').value;
            var midtermfinal=document.getElementById('midterm-score').value;
            var midtermweighted=(midtermfinal)/midtermscoretotal*20;

            var quizweightedbf=0;
            var portfolioweightedbf=0;

            //for all quiz score
            var allquiz=[
                document.getElementById('quiz1-score').value,
                document.getElementById('quiz2-score').value,
                document.getElementById('quiz3-score').value,
                document.getElementById('quiz4-score').value,
                document.getElementById('quiz5-score').value,
                document.getElementById('quiz6-score').value,
                document.getElementById('quiz7-score').value,
                document.getElementById('quiz8-score').value,
                document.getElementById('quiz9-score').value,
                document.getElementById('quiz10-score').value

            ];
            
            //for all quiz total score
            var allquizScore=[
                document.getElementById('quiztotal1-score').value,
                document.getElementById('quiztotal2-score').value,
                document.getElementById('quiztotal3-score').value,
                document.getElementById('quiztotal4-score').value,
                document.getElementById('quiztotal5-score').value,
                document.getElementById('quiztotal6-score').value,
                document.getElementById('quiztotal7-score').value,
                document.getElementById('quiztotal8-score').value,
                document.getElementById('quiztotal9-score').value,
                document.getElementById('quiztotal10-score').value

            ];

            //for all portfolio score
            var allportfolio=[
                document.getElementById('portfolio1-score').value,
                document.getElementById('portfolio2-score').value,
                document.getElementById('portfolio3-score').value,
                document.getElementById('portfolio4-score').value,
                document.getElementById('portfolio5-score').value,
                document.getElementById('portfolio6-score').value,
                document.getElementById('portfolio7-score').value,
                document.getElementById('portfolio8-score').value,
                document.getElementById('portfolio9-score').value,
                document.getElementById('portfolio10-score').value

            ];

            //for all portfolio total score
            var allportfolioscore=[
                document.getElementById('portfoliototal1-score').value,
                document.getElementById('portfoliototal2-score').value,
                document.getElementById('portfoliototal3-score').value,
                document.getElementById('portfoliototal4-score').value,
                document.getElementById('portfoliototal5-score').value,
                document.getElementById('portfoliototal6-score').value,
                document.getElementById('portfoliototal7-score').value,
                document.getElementById('portfoliototal8-score').value,
                document.getElementById('portfoliototal9-score').value,
                document.getElementById('portfoliototal10-score').value

            ];
            
            for(let i=0;i<allquiz.length;i++){
                if(allquiz[i]!=''){
                    quiztotal+=eval(allquiz[i]);
                }
            }
            for(let i=0;i<allquiz.length;i++){
                if(allquizScore[i]!=''){
                    quizScoreTotal+=eval(allquizScore[i]);
                }
            }

            for(let i=0;i<allportfolio.length;i++){
                if(allportfolio[i]!=''){
                    portfoliototal+=eval(allportfolio[i]);
                }
            }
            for(let i=0;i<allportfolio.length;i++){
                if(allportfolioscore[i]!=''){
                    portfolioScoreTotal+=eval(allportfolioscore[i]);
                }
            }

            document.getElementById('quiz-total').value=quiztotal;
            if(quiztotal<=quizScoreTotal){
                document.getElementById('quiz-weighted').value=(quiztotal)/quizScoreTotal*15;
                quizweightedbf=(quiztotal)/quizScoreTotal*15;
            }
            else{
                document.getElementById('quiz-weighted').value='';
            }
            document.getElementById('portfolio-total').value=portfoliototal;
            if(portfoliototal<=portfolioScoreTotal){
                document.getElementById('portfolio-weighted').value=(portfoliototal)/portfolioScoreTotal*25;
                portfolioweightedbf=(portfoliototal)/portfolioScoreTotal*25;
            }
            else{
                document.getElementById('portfolio-weighted').value='';
            }
            document.getElementById('quizscore-total').value=quizScoreTotal;
            document.getElementById('portfolioscore-total').value=portfolioScoreTotal;
            document.getElementById('midterm-weighted').value=midtermweighted;

            //console.log(quiztotal);
            //console.log(allquiz);
            //console.log(allportfolio);
            alltotal_AM(quizScoreTotal,quiztotal,portfolioScoreTotal,portfoliototal);
        }

        //Lecture Finals
        function alltotal_AM(qztotal,qzscore,pftotal,pfscore){
            var quiztotal=qzscore;
            var quizScoreTotal=qztotal;
            var portfoliototal=pfscore;
            var portfolioScoreTotal=pftotal;
            var finalscoretotal=document.getElementById('AM-finalscore-total').value;
            var final=document.getElementById('AM-final-score').value;
            var finalweighted=(final)/finalscoretotal*20;

            var quizweightedbf=0;
            var portfolioweightedbf=0;

            //for all quiz score
            var allquiz=[
                document.getElementById('AM-quiz1-score').value,
                document.getElementById('AM-quiz2-score').value,
                document.getElementById('AM-quiz3-score').value,
                document.getElementById('AM-quiz4-score').value,
                document.getElementById('AM-quiz5-score').value,
                document.getElementById('AM-quiz6-score').value,
                document.getElementById('AM-quiz7-score').value,
                document.getElementById('AM-quiz8-score').value,
                document.getElementById('AM-quiz9-score').value,
                document.getElementById('AM-quiz10-score').value

            ];

            //for all quiz total score
            var allquizScore=[
                document.getElementById('AM-quiztotal1-score').value,
                document.getElementById('AM-quiztotal2-score').value,
                document.getElementById('AM-quiztotal3-score').value,
                document.getElementById('AM-quiztotal4-score').value,
                document.getElementById('AM-quiztotal5-score').value,
                document.getElementById('AM-quiztotal6-score').value,
                document.getElementById('AM-quiztotal7-score').value,
                document.getElementById('AM-quiztotal8-score').value,
                document.getElementById('AM-quiztotal9-score').value,
                document.getElementById('AM-quiztotal10-score').value

            ];

            //for all portfolio score
            var allportfolio=[
                document.getElementById('AM-portfolio1-score').value,
                document.getElementById('AM-portfolio2-score').value,
                document.getElementById('AM-portfolio3-score').value,
                document.getElementById('AM-portfolio4-score').value,
                document.getElementById('AM-portfolio5-score').value,
                document.getElementById('AM-portfolio6-score').value,
                document.getElementById('AM-portfolio7-score').value,
                document.getElementById('AM-portfolio8-score').value,
                document.getElementById('AM-portfolio9-score').value,
                document.getElementById('AM-portfolio10-score').value

            ];

            //for all portfolio total score
            var allportfolioscore=[
                document.getElementById('AM-portfoliototal1-score').value,
                document.getElementById('AM-portfoliototal2-score').value,
                document.getElementById('AM-portfoliototal3-score').value,
                document.getElementById('AM-portfoliototal4-score').value,
                document.getElementById('AM-portfoliototal5-score').value,
                document.getElementById('AM-portfoliototal6-score').value,
                document.getElementById('AM-portfoliototal7-score').value,
                document.getElementById('AM-portfoliototal8-score').value,
                document.getElementById('AM-portfoliototal9-score').value,
                document.getElementById('AM-portfoliototal10-score').value

            ];
            
            for(let i=0;i<allquiz.length;i++){
                if(allquiz[i]!=''){
                    quiztotal+=eval(allquiz[i]);
                }
            }
            for(let i=0;i<allquiz.length;i++){
                if(allquizScore[i]!=''){
                    quizScoreTotal+=eval(allquizScore[i]);
                }
            }

            for(let i=0;i<allportfolio.length;i++){
                if(allportfolio[i]!=''){
                    portfoliototal+=eval(allportfolio[i]);
                }
            }
            for(let i=0;i<allportfolio.length;i++){
                if(allportfolioscore[i]!=''){
                    portfolioScoreTotal+=eval(allportfolioscore[i]);
                }
            }

            document.getElementById('AM-quiz-total').value=quiztotal;
            if(quiztotal<=quizScoreTotal){
                document.getElementById('AM-quiz-weighted').value=(quiztotal)/quizScoreTotal*15;
                quizweightedbf=(quiztotal)/quizScoreTotal*15;
            }
            else{
                document.getElementById('AM-quiz-weighted').value='';
            }
            document.getElementById('AM-portfolio-total').value=portfoliototal;
            if(portfoliototal<=portfolioScoreTotal){
                document.getElementById('AM-portfolio-weighted').value=(portfoliototal)/portfolioScoreTotal*25;
                portfolioweightedbf=(portfoliototal)/portfolioScoreTotal*25;
            }
            else{
                document.getElementById('AM-portfolio-weighted').value='';
            }
            document.getElementById('AM-quizscore-total').value=quizScoreTotal;
            document.getElementById('AM-portfolioscore-total').value=portfolioScoreTotal;
            document.getElementById('AM-final-weighted').value=finalweighted;

            //console.log(quiztotal);
            //console.log(allquiz);
            //console.log(allportfolio);
        }

        //Lab Midterm
        function allLabTotal_BF(qztotal,qzscore,pftotal,pfscore){
            
            var LabActScoreTotal=0;
            var LabActTotal=0;
            var PractExamScoreTotal=0;
            var PractExamtotal=0;

            var LabActWeightedBF= 0;
            var PractExamWeightedBF=0;


            //for all Laboratory Acitivty score
            var allLabAct=[
                document.getElementById('BF-labact1-score').value,
                document.getElementById('BF-labact2-score').value,
                document.getElementById('BF-labact3-score').value,
                document.getElementById('BF-labact4-score').value,
                document.getElementById('BF-labact5-score').value,
                document.getElementById('BF-labact6-score').value,
                document.getElementById('BF-labact7-score').value,
                document.getElementById('BF-labact8-score').value,
                document.getElementById('BF-labact9-score').value,
                document.getElementById('BF-labact10-score').value

            ];

            //for all Laboratory Acitivty  total score
            var allLabActScore=[
                document.getElementById('BF-labacttotal1-score').value,
                document.getElementById('BF-labacttotal2-score').value,
                document.getElementById('BF-labacttotal3-score').value,
                document.getElementById('BF-labacttotal4-score').value,
                document.getElementById('BF-labacttotal5-score').value,
                document.getElementById('BF-labacttotal6-score').value,
                document.getElementById('BF-labacttotal7-score').value,
                document.getElementById('BF-labacttotal8-score').value,
                document.getElementById('BF-labacttotal9-score').value,
                document.getElementById('BF-labacttotal10-score').value

            ];

            //for all Practical Exam score
            var allPractExam=[
                document.getElementById('BF-practexam1-score').value,
                document.getElementById('BF-practexam2-score').value,
                document.getElementById('BF-practexam3-score').value,
                document.getElementById('BF-practexam4-score').value,
                document.getElementById('BF-practexam5-score').value,

            ];

            //for all Practical Exam total score
            var allPractExamscore=[
                document.getElementById('BF-practexamtotal1-score').value,
                document.getElementById('BF-practexamtotal2-score').value,
                document.getElementById('BF-practexamtotal3-score').value,
                document.getElementById('BF-practexamtotal4-score').value,
                document.getElementById('BF-practexamtotal5-score').value,

            ];
            
            //Sum of scores of Lab Activity and Practical exam
            for(let i=0;i<allLabAct.length;i++){
                if(allLabAct[i]!=''){
                    LabActTotal+=eval(allLabAct[i]);
                }
            }
            for(let i=0;i<allLabAct.length;i++){
                if(allLabActScore[i]!=''){
                    LabActScoreTotal+=eval(allLabActScore[i]);
                }
            }

            for(let i=0;i<allPractExam.length;i++){
                if(allPractExam[i]!=''){
                    PractExamtotal+=eval(allPractExam[i]);
                }
            }
            for(let i=0;i<allPractExamscore.length;i++){
                if(allPractExamscore[i]!=''){
                    PractExamScoreTotal+=eval(allPractExamscore[i]);
                }
            }

            //Computation of Lab Activity and Practical exam
            document.getElementById('BF-labact-total').value=LabActTotal;
            if(LabActTotal<=LabActScoreTotal){
                document.getElementById('BF-labact-weighted').value=(LabActTotal)/LabActScoreTotal*50;
                LabActWeightedBF=(LabActTotal)/LabActScoreTotal*50;
            }
            else{
                document.getElementById('BF-labact-weighted').value='';
            }
            document.getElementById('BF-practexam-total').value=PractExamtotal;
            if(PractExamtotal<=PractExamScoreTotal){
                document.getElementById('BF-practexam-weighted').value=(PractExamtotal)/PractExamScoreTotal*30;
                PractExamWeightedBF=(PractExamtotal)/PractExamScoreTotal*30;
            }
            else{
                document.getElementById('BF-practexam-weighted').value='';
            }
            document.getElementById('BF-labactscore-total').value=LabActScoreTotal;
            document.getElementById('BF-practexamscore-total').value=PractExamScoreTotal;

            //console.log(quiztotal);
            //console.log(allquiz);
            //console.log(allportfolio);
            allLabTotal_AM(LabActTotal,LabActScoreTotal,PractExamtotal,PractExamScoreTotal)
        }

        //Lab Finals
        function allLabTotal_AM(LAscore,LAtotal,PEscore,PEtotal){
            
            var LabActScoreTotal=LAtotal;
            var LabActTotal=LAscore;
            var PractExamScoreTotal=PEtotal;
            var PractExamtotal=PEscore;

            var LabActWeightedAM= 0;
            var PractExamWeightedAM=0;


            //for all Laboratory Acitivty score
            var allLabAct=[
                document.getElementById('AM-labact1-score').value,
                document.getElementById('AM-labact2-score').value,
                document.getElementById('AM-labact3-score').value,
                document.getElementById('AM-labact4-score').value,
                document.getElementById('AM-labact5-score').value,
                document.getElementById('AM-labact6-score').value,
                document.getElementById('AM-labact7-score').value,
                document.getElementById('AM-labact8-score').value,
                document.getElementById('AM-labact9-score').value,
                document.getElementById('AM-labact10-score').value

            ];

            //for all Laboratory Acitivty  total score
            var allLabActScore=[
                document.getElementById('AM-labacttotal1-score').value,
                document.getElementById('AM-labacttotal2-score').value,
                document.getElementById('AM-labacttotal3-score').value,
                document.getElementById('AM-labacttotal4-score').value,
                document.getElementById('AM-labacttotal5-score').value,
                document.getElementById('AM-labacttotal6-score').value,
                document.getElementById('AM-labacttotal7-score').value,
                document.getElementById('AM-labacttotal8-score').value,
                document.getElementById('AM-labacttotal9-score').value,
                document.getElementById('AM-labacttotal10-score').value

            ];

            //for all Practical Exam score
            var allPractExam=[
                document.getElementById('AM-practexam1-score').value,
                document.getElementById('AM-practexam2-score').value,
                document.getElementById('AM-practexam3-score').value,
                document.getElementById('AM-practexam4-score').value,
                document.getElementById('AM-practexam5-score').value,

            ];

            //for all Practical Exam total score
            var allPractExamscore=[
                document.getElementById('AM-practexamtotal1-score').value,
                document.getElementById('AM-practexamtotal2-score').value,
                document.getElementById('AM-practexamtotal3-score').value,
                document.getElementById('AM-practexamtotal4-score').value,
                document.getElementById('AM-practexamtotal5-score').value,

            ];
            
            //Sum of scores of Lab Activity and Practical exam
            for(let i=0;i<allLabAct.length;i++){
                if(allLabAct[i]!=''){
                    LabActTotal+=eval(allLabAct[i]);
                }
            }
            for(let i=0;i<allLabAct.length;i++){
                if(allLabActScore[i]!=''){
                    LabActScoreTotal+=eval(allLabActScore[i]);
                }
            }

            for(let i=0;i<allPractExam.length;i++){
                if(allPractExam[i]!=''){
                    PractExamtotal+=eval(allPractExam[i]);
                }
            }
            for(let i=0;i<allPractExamscore.length;i++){
                if(allPractExamscore[i]!=''){
                    PractExamScoreTotal+=eval(allPractExamscore[i]);
                }
            }

            //Computation of Lab Activity and Practical exam
            document.getElementById('AM-labact-total').value=LabActTotal;
            if(LabActTotal<=LabActScoreTotal){
                document.getElementById('AM-labact-weighted').value=(LabActTotal)/LabActScoreTotal*50;
                LabActWeightedAM=(LabActTotal)/LabActScoreTotal*50;
            }
            else{
                document.getElementById('AM-labact-weighted').value='';
            }
            document.getElementById('AM-practexam-total').value=PractExamtotal;
            if(PractExamtotal<=PractExamScoreTotal){
                document.getElementById('AM-practexam-weighted').value=(PractExamtotal)/PractExamScoreTotal*30;
                PractExamWeightedAM=(PractExamtotal)/PractExamScoreTotal*30;
            }
            else{
                document.getElementById('AM-practexam-weighted').value='';
            }
            document.getElementById('AM-labactscore-total').value=LabActScoreTotal;
            document.getElementById('AM-practexamscore-total').value=PractExamScoreTotal;

            //console.log(quiztotal);
            //console.log(allquiz);
            //console.log(allportfolio);
        }

        document.querySelector('select[name="student_name"]').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const studentNumber = selectedOption.getAttribute('data-student-number');
            var studentId = (this.selectedIndex)+1;
            
            console.log('Student id:', studentId);
            console.log('Selected Student:', selectedOption.value);
            console.log('Student Number:', studentNumber);
            document.getElementById('studentNumber').value = studentNumber;

            // Fetch attendance count for the selected student
        });

        $('#studentName').change(function() {
            var selectedStudentId = $(this).prop('selectedIndex');
            console.log('Student Index:', selectedStudentId);
            fetchAttendanceCount(selectedStudentId+1);
            //console.log('Student attendance:',); 
        });

        function fetchAttendanceCount(selectedStudentId) {
            $.ajax({
                type: 'POST',
                url: 'fetch-attendance.php', // Replace with the actual path to your PHP script
                data: { selectedStudentId: selectedStudentId },
                success: function(response) {
                    // 'response' will contain the result from the PHP script
                    var count = parseInt(response);
                    console.log("Count: " + count);
                    document.getElementById('attendanceScore').value = count;

                    // Now you can use the 'count' variable as needed in your JavaScript code
                },
                error: function(error) {
                    console.error("Error fetching data: " + error);
                }
            });
        }
    </script>
</body>
</html>
