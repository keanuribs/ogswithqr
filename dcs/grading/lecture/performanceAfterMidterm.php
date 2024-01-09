<?php
include __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST['options'] ?? '';

    switch ($selectedOption) {
        case 'classParticipation':
            $overallTotal = $_POST['classParticipationOverallTotal'] ?? '';
            $numberOfParticipants = $_POST['classParticipationNumberOfParticipants'] ?? '';
            
            $weightPercentage = 0.10;
            $weightedOverallTotal = sprintf("%.2f", $numberOfParticipants / $overallTotal * 10);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO performance_after_midterm (option_selected, overall_total, num_of_participants, weighted_total) 
                    VALUES ('$selectedOption', '$overallTotal', '$numberOfParticipants', '$weightedOverallTotal')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            break;

        case 'quizzesExams':
            $quizScores = [];
            $quizTotals = [];
        
            for ($i = 1; $i <= 10; $i++) {
                $quizScores[] = $_POST["quizScore$i"] ?? '';
                $quizTotals[] = $_POST["quizTotal$i"] ?? '';
            }
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            $scoreColumns = [];
            $totalColumns = [];
        
            for ($i = 1; $i <= 10; $i++) {
                $scoreColumns[] = "quiz{$i}_score";
                $totalColumns[] = "quiz{$i}_total";
            }
        
            $sql = "INSERT INTO quiz2 (option_selected, " . 
                   implode(', ', $scoreColumns) . ", " . implode(', ', $totalColumns) . ") VALUES ('$selectedOption', " . 
                   "'" . implode("', '", $quizScores) . "', '" . implode("', '", $quizTotals) . "')";
        
            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            $conn->close();
        
            break;

        case 'outputPortfolio':
            $numWorksArray = [];
            $scoreArray = [];
        
            for ($i = 1; $i <= 10; $i++) {
                $numWorksArray[] = $_POST["outputPortfolioNumWorks$i"] ?? '';
                $scoreArray[] = $_POST["outputPortfolioScore$i"] ?? '';
            }
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            // Initialize $columnNames array
            $columnNames = [];
            for ($i = 1; $i <= 10; $i++) {
                $columnNames[] = "num_of_works_$i, score_$i";
            }
        
            // Include 'option_selected' in the VALUES clause
            $sql = "INSERT INTO output_portfolio2 (option_selected, " . implode(', ', $columnNames) . ") 
                    VALUES ('$selectedOption', " . implode(', ', $numWorksArray) . ", " . implode(', ', $scoreArray) . ")";
        
            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            $conn->close();
        
            break;

            case 'finalsExam':
                $finalsExamScore = $_POST['finalsExamScore'] ?? '';
                $finalsExamTotalQuestions = $_POST['finalsExamTotalQuestions'] ?? '';
    
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
    
                $sql = "INSERT INTO finals_exam (option_selected, finals_exam_score, finals_exam_total) 
                        VALUES ('$selectedOption', '$finalsExamScore', '$finalsExamTotalQuestions')";
    
                if ($conn->query($sql) === TRUE) {
                    echo "Record inserted successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
    
                $conn->close();
    
                break;

        default:
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="theme" rel="stylesheet" href="../css/midtermgrading.css">
    <title>Dynamic Form</title>
</head>
<body>

<form id="dynamicForm" class="responsive-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="options">Select an option:</label>
    <select id="options" name="options" onchange="showInput()">
        <option value="attendance">ATTENDANCE</option>
        <option value="classParticipation">CLASS PARTICIPATION</option>
        <option value="quizzesExams">QUIZZES / LONG EXAMINATIONS</option>
        <option value="outputPortfolio">OUTPUT / PORTFOLIO</option>
        <option value="finalsExam">FINALS EXAM</option>
    </select>

    <div id="classParticipationForm" class="hidden">
        <label for="classParticipationOverallTotal">Total Class Participation after Midterm:</label>
        <input type="text" id="classParticipationOverallTotal" name="classParticipationOverallTotal" class="hidden">

        <label for="classParticipationNumberOfParticipants">Number of Participants:</label>
        <input type="text" id="classParticipationNumberOfParticipants" name="classParticipationNumberOfParticipants" class="hidden">
    </div>

    <div id="quizzesExamsForm" class="hidden">
        <div id="quizFieldsContainer">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<label for='quizScore$i'>Quiz $i Score:</label>";
                echo "<input type='text' id='quizScore$i' name='quizScore$i'>";
                echo "<label for='quizTotal$i'>Quiz $i Total:</label>";
                echo "<input type='text' id='quizTotal$i' name='quizTotal$i'>";
                echo "<br>";
            }
            ?>
        </div>
    </div>

    <div id="outputPortfolioForm" class="hidden">
        <div id="outputPortfolioFieldsContainer">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<label for='outputPortfolioNumWorks$i'>Number of Works $i:</label>";
                echo "<input type='text' id='outputPortfolioNumWorks$i' name='outputPortfolioNumWorks$i'>";
                echo "<label for='outputPortfolioScore$i'>Score $i:</label>";
                echo "<input type='text' id='outputPortfolioScore$i' name='outputPortfolioScore$i'>";
                echo "<br>";
            }
            ?>
        </div>
    </div>

    <div id="finalsExamForm" class="hidden">
        <label for="finalsExamScore">Finals Exam Score:</label>
        <input type="text" id="finalsExamScore" name="finalsExamScore" class="hidden">

        <label for="finalsExamTotalQuestions">Total Questions:</label>
        <input type="text" id="finalsExamTotalQuestions" name="finalsExamTotalQuestions" class="hidden">
    </div>

    <input type="submit" value="Submit">
</form>

<script>
    function showInput() {
        var selectedOption = document.getElementById("options").value;
        var classParticipationForm = document.getElementById("classParticipationForm");
        var quizzesExamsForm = document.getElementById("quizzesExamsForm");
        var outputPortfolioForm = document.getElementById("outputPortfolioForm");
        var finalsExamForm = document.getElementById("finalsExamForm");
        var quizFieldsContainer = document.getElementById("quizFieldsContainer");
        var outputPortfolioFieldsContainer = document.getElementById("outputPortfolioFieldsContainer");

        var allInputContainers = document.querySelectorAll('.hidden');
        allInputContainers.forEach(function (element) {
            element.style.display = 'none';
        });

        if (selectedOption === "classParticipation") {
            classParticipationForm.style.display = 'block';
            document.getElementById("classParticipationOverallTotal").style.display = 'block';
            document.getElementById("classParticipationNumberOfParticipants").style.display = 'block';
        } else if (selectedOption === "quizzesExams") {
            quizzesExamsForm.style.display = 'block';
        } else if (selectedOption === "outputPortfolio") {
            outputPortfolioForm.style.display = 'block';

            while (outputPortfolioFieldsContainer.firstChild) {
                outputPortfolioFieldsContainer.removeChild(outputPortfolioFieldsContainer.firstChild);
            }

            for (var i = 1; i <= 10; i++) {
                var numWorksLabel = document.createElement("label");
                numWorksLabel.textContent = "Number of Works " + i + ":";
                outputPortfolioFieldsContainer.appendChild(numWorksLabel);

                var numWorksInput = document.createElement("input");
                numWorksInput.type = "text";
                numWorksInput.id = "outputPortfolioNumWorks" + i;
                numWorksInput.name = "outputPortfolioNumWorks" + i;
                outputPortfolioFieldsContainer.appendChild(numWorksInput);

                var scoreLabel = document.createElement("label");
                scoreLabel.textContent = "Score " + i + ":";
                outputPortfolioFieldsContainer.appendChild(scoreLabel);

                var scoreInput = document.createElement("input");
                scoreInput.type = "text";
                scoreInput.id = "outputPortfolioScore" + i;
                scoreInput.name = "outputPortfolioScore" + i;
                outputPortfolioFieldsContainer.appendChild(scoreInput);

                outputPortfolioFieldsContainer.appendChild(document.createElement("br"));
            }
        } else if (selectedOption === "finalsExam") {
            finalsExamForm.style.display = 'block';
            document.getElementById("finalsExamScore").style.display = 'block';
            document.getElementById("finalsExamTotalQuestions").style.display = 'block';
        }
    }
</script>

</body>
</html>
