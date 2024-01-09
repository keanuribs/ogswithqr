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

            $sql = "INSERT INTO lecture (option_selected, overall_total, number_of_participants, weighted_total) 
                    VALUES ('$selectedOption', '$overallTotal', '$numberOfParticipants', '$weightedOverallTotal')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
            break;

        case 'quizzesExams':
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $quizScores = array();
            $quizTotals = array();

            for ($i = 1; $i <= 10; $i++) {
                $quizScores[] = $_POST['quiz' . $i . 'Score'] ?? '';
                $quizTotals[] = $_POST['quiz' . $i . 'Total'] ?? '';
            }

            $totalQuizScore = array_sum($quizScores);
            $totalQuizTotal = array_sum($quizTotals);
            $totalWeight = sprintf("%.2f", ($totalQuizScore / $totalQuizTotal) * 15);

            $sql = "INSERT INTO quiz (option_selected, " . implode(', ', array_map(function ($i) {
                return "quiz{$i}_score, quiz{$i}_total";
            }, range(1, 10))) . ", total_quiz_score, total_quiz_total, total_weight) 
            VALUES ('$selectedOption', " . implode(', ', $quizScores) . ", " . implode(', ', $quizTotals) . ", '$totalQuizScore', '$totalQuizTotal', '$totalWeight')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
            break;

        case 'outputPortfolio':
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $numWorksArray = array();
            $scoreArray = array();

            for ($i = 1; $i <= 10; $i++) {
                $numWorksArray[] = $_POST['outputPortfolioNumWorks' . $i] ?? '';
                $scoreArray[] = $_POST['outputPortfolioScore' . $i] ?? '';
            }

            $placeholdersNumWorks = implode(', ', array_fill(0, 10, '?'));
            $placeholdersScores = implode(', ', array_fill(0, 10, '?'));
            $bindParams = str_repeat('ss', 10);

            $stmt = $conn->prepare("INSERT INTO output_portfolio (option_selected, " . implode(', ', array_map(function ($i) {
                    return "num_of_works_$i, score_$i";
                }, range(1, 10))) . ") VALUES ('$selectedOption', $placeholdersNumWorks, $placeholdersScores)");

            $bindParamsArray = array_merge([$bindParams], $numWorksArray, $scoreArray);
            $stmt->bind_param(...$bindParamsArray);

            if ($stmt->execute()) {
                echo "Record inserted successfully";
                $overallTotalScore = array_sum($scoreArray);
                $overallNumWorks = array_sum($numWorksArray);
                $weight = sprintf("%.2f", ($overallTotalScore / $overallNumWorks) * 25);
                echo "<br>Overall Total Score: $overallTotalScore";
                echo "<br>Overall Number of Works: $overallNumWorks";
                echo "<br>Weight: $weight";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            break;

        case 'midtermExam':
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $midtermExamScore = $_POST['midtermExamScore'] ?? '';
            $midtermExamTotalQuestions = $_POST['midtermExamTotalQuestions'] ?? '';

            $sql = "INSERT INTO midterm (option_selected, midterm_exam_score, midterm_exam_total) 
                    VALUES ('$selectedOption', '$midtermExamScore', '$midtermExamTotalQuestions')";

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
        <option value="midtermExam">MIDTERM EXAM</option>
    </select>

    <div id="classParticipationForm" class="hidden">
        <label for="classParticipationOverallTotal">Overall Total:</label>
        <input type="text" id="classParticipationOverallTotal" name="classParticipationOverallTotal" class="hidden">

        <label for="classParticipationNumberOfParticipants">Number of Participants:</label>
        <input type="text" id="classParticipationNumberOfParticipants" name="classParticipationNumberOfParticipants" class="hidden">
    </div>

    <div id="quizzesExamsForm" class="hidden">
        <div id="quizFieldsContainer">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<label for="quiz' . $i . 'Score">Quiz ' . $i . ' Score:</label>';
                echo '<input type="text" id="quiz' . $i . 'Score" name="quiz' . $i . 'Score">';

                echo '<label for="quiz' . $i . 'Total">Quiz ' . $i . ' Total:</label>';
                echo '<input type="text" id="quiz' . $i . 'Total" name="quiz' . $i . 'Total">';
                echo '<br>';
            }
            ?>
        </div>
    </div>

    <div id="outputPortfolioForm" class="hidden">
        <div id="outputPortfolioFieldsContainer"></div>
    </div>

    <div id="midtermExamForm" class="hidden">
        <label for="midtermExamScore">Midterm Exam Score:</label>
        <input type="text" id="midtermExamScore" name="midtermExamScore" class="hidden">

        <label for="midtermExamTotalQuestions">Total Number of Questions:</label>
        <input type="text" id="midtermExamTotalQuestions" name="midtermExamTotalQuestions" class="hidden">
    </div>

    <input type="submit" value="Submit">
</form>

<script>
    function showInput() {
        var selectedOption = document.getElementById("options").value;
        var classParticipationForm = document.getElementById("classParticipationForm");
        var quizzesExamsForm = document.getElementById("quizzesExamsForm");
        var outputPortfolioForm = document.getElementById("outputPortfolioForm");
        var midtermExamForm = document.getElementById("midtermExamForm");
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
            while (quizFieldsContainer.firstChild) {
                quizFieldsContainer.removeChild(quizFieldsContainer.firstChild);
            }
            for (var i = 1; i <= 10; i++) {
                var quizScoreLabel = document.createElement("label");
                quizScoreLabel.textContent = "Quiz " + i + " Score:";
                quizFieldsContainer.appendChild(quizScoreLabel);

                var quizScoreInput = document.createElement("input");
                quizScoreInput.type = "text";
                quizScoreInput.id = "quiz" + i + "Score";
                quizScoreInput.name = "quiz" + i + "Score";
                quizFieldsContainer.appendChild(quizScoreInput);

                var quizTotalLabel = document.createElement("label");
                quizTotalLabel.textContent = "Quiz " + i + " Total:";
                quizFieldsContainer.appendChild(quizTotalLabel);

                var quizTotalInput = document.createElement("input");
                quizTotalInput.type = "text";
                quizTotalInput.id = "quiz" + i + "Total";
                quizTotalInput.name = "quiz" + i + "Total";
                quizFieldsContainer.appendChild(quizTotalInput);

                quizFieldsContainer.appendChild(document.createElement("br"));
            }
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
        } else if (selectedOption === "midtermExam") {
            midtermExamForm.style.display = 'block';
            document.getElementById("midtermExamScore").style.display = 'block';
            document.getElementById("midtermExamTotalQuestions").style.display = 'block';
        }
    }
</script>

</body>
</html>
