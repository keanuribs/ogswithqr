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
    <h1>Lecture Input Table</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <thead>
                <th colspan="20">Students</th>
                <tr>
                    <th rowspan="4">Student Name</th>
                    <th rowspan="4">Student Number</th>
                    <th rowspan="4">Attendance</th>
                    <th rowspan="4">Participation</th>
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
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="quiztotal<?php echo $i ?>-score" oninput="alltotal()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="quizscore_total" id="quizscore-total"></td>
                    <th>15%</td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <th><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="portfoliototal<?php echo $i ?>-score" oninput="alltotal()"></td>
                    <?php endfor; ?>
                    <th><input type="number" step="0.01" name="portfolioscore_total" id="portfolioscore-total"></td>
                    <th>25%</td>
                    <th><input type="number" step="0.01" name="midtermscore_total" id="midtermscore-total" oninput="alltotal()"></td>
                    <th>20%</td>  
                </tr>
                <tr>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
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
                    <td><input type="number" step="0.01" name="attendance_score" id="attendanceScore" value="<?php echo $totalAttendance; ?>"></td>
                    <td><input type="number" step="0.01" name="participation_score"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="quiz<?php echo $i ?>_score" id="quiz<?php echo $i ?>-score" oninput="alltotal()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="quiz_total" id="quiz-total"></td>
                    <td><input type="number" step="0.01" name="quiz_weighted" id="quiz-weighted"></td>
                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                        <td><input type="number" step="0.01" name="portfolio<?php echo $i ?>_score" id="portfolio<?php echo $i ?>-score" oninput="alltotal()"></td>
                    <?php endfor; ?>
                    <td><input type="number" step="0.01" name="portfolio_total" id="portfolio-total"></td>
                    <td><input type="number" step="0.01" name="portfolio_weighted" id="portfolio-weighted"></td>
                    <td><input type="number" step="0.01" name="midterm_score" id="midterm-score" oninput="alltotal()"></td>
                    <td><input type="number" step="0.01" name="midterm_weighted" id="midterm-weighted" readonly></td>
                </tr>
            </tbody>
        </table>

        <input type="submit" value="Submit">
    </form>

    <!-- Add this script to update the student number and fetch attendance count when a student is selected -->
    <script>
        function alltotal(){
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
