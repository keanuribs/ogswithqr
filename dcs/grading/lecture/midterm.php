<?php
include __DIR__ . '/../../config.php';

// Assuming your database connection is in $conn variable
// Replace 'lecture' with the actual table name in your database
// Adjust the database fields accordingly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST['options'] ?? '';

    switch ($selectedOption) {
        case 'classParticipation':
            $overallTotal = $_POST['classParticipationOverallTotal'] ?? '';
            $numberOfParticipants = $_POST['classParticipationNumberOfParticipants'] ?? '';

            // Weight percentage for class participation
            $weightPercentage = 0.10;

            // Calculate weighted values
            $weightedOverallTotal = sprintf("%.2f", $numberOfParticipants / $overallTotal * 10);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert data into the 'lecture' table
            $sql = "INSERT INTO lecture (option_selected, overall_total, number_of_participants, weighted_total) 
                    VALUES ('$selectedOption', '$overallTotal', '$numberOfParticipants', '$weightedOverallTotal')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();

            break;

        case 'quizzesExams':
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $quizScores = array();
            $quizTotals = array();

            // Loop through quiz data and collect scores and totals
            for ($i = 1; $i <= 10; $i++) {
                $quizScores[] = $_POST['quiz' . $i . 'Score'] ?? '';
                $quizTotals[] = $_POST['quiz' . $i . 'Total'] ?? '';
            }

            // Insert data into the 'quiz' table for quizzes
            $sql = "INSERT INTO quiz (option_selected, " . implode(', ', array_map(function ($i) {
                    return "quiz{$i}_score, quiz{$i}_total";
                }, range(1, 10))) . ") VALUES ('$selectedOption', " . implode(', ', $quizScores) . ", " . implode(', ', $quizTotals) . ")";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();

            break;

        case 'outputPortfolio':
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Arrays to store the data
            $numWorksArray = array();
            $scoreArray = array();

            // Loop through outputPortfolio data and collect Number of Works and Scores
            for ($i = 1; $i <= 10; $i++) {
                $numWorksArray[] = $_POST['outputPortfolioNumWorks' . $i] ?? '';
                $scoreArray[] = $_POST['outputPortfolioScore' . $i] ?? '';
            }

            // Create placeholders for prepared statement
            $placeholdersNumWorks = implode(', ', array_fill(0, 10, '?'));
            $placeholdersScores = implode(', ', array_fill(0, 10, '?'));

            // Create placeholders for binding
            $bindParams = str_repeat('ss', 10);  // Assuming both Number of Works and Score are strings

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO output_portfolio (option_selected, " . implode(', ', array_map(function ($i) {
                    return "num_of_works_$i, score_$i";
                }, range(1, 10))) . ") VALUES ('$selectedOption', $placeholdersNumWorks, $placeholdersScores)");

            // Bind parameters
            $bindParamsArray = array_merge([$bindParams], $numWorksArray, $scoreArray);
            $stmt->bind_param(...$bindParamsArray);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the database connection
            $stmt->close();

            break;

        case 'midtermExam':
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get Midterm Exam Score and Total Questions from the form
            $midtermExamScore = $_POST['midtermExamScore'] ?? '';
            $midtermExamTotalQuestions = $_POST['midtermExamTotalQuestions'] ?? '';

            // Insert data into the 'lecture' table for Midterm Exam
            $sql = "INSERT INTO midterm (option_selected, midterm_exam_score, midterm_exam_total) 
                    VALUES ('$selectedOption', '$midtermExamScore', '$midtermExamTotalQuestions')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();

            break;

        default:
            // Handle other cases or show an error message
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

    <!-- CLASS PARTICIPATION FORM -->
    <div id="classParticipationForm" class="hidden">
        <label for="classParticipationOverallTotal">Overall Total:</label>
        <input type="text" id="classParticipationOverallTotal" name="classParticipationOverallTotal" class="hidden">

        <label for="classParticipationNumberOfParticipants">Number of Participants:</label>
        <input type="text" id="classParticipationNumberOfParticipants" name="classParticipationNumberOfParticipants" class="hidden">
    </div>

    <!-- QUIZZES / LONG EXAMINATIONS FORM -->
    <div id="quizzesExamsForm" class="hidden">
        <div id="quizFieldsContainer">
            <?php
            // Create input fields for quiz scores and totals
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

    <!-- OUTPUT / PORTFOLIO FORM -->
    <div id="outputPortfolioForm" class="hidden">
        <div id="outputPortfolioFieldsContainer"></div>
    </div>

    <!-- MIDTERM EXAM FORM -->
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
