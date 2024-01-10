<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            padding: 8px;
            margin-top: 20px;
        }

        input {
            width: 80px;
            text-align: center;
            padding: 5px;
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        button {
            width: 20%; /* Adjusted width for two buttons in a row */
            padding: 10px;
            margin-top: 10px; /* Added margin for better spacing */
        }

        #result {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h2>Class Participation and Quiz Input</h2>

    <!-- First Table -->
    <table>
        <tr>
            <th rowspan="2">Student</th>
            <th rowspan="2">Student Number</th>
            <th rowspan="2">Attendance</th>
            <th colspan="2">Class Participation</th>
            <!-- Add columns dynamically for each quiz -->
            <th colspan="20">Quizzes</th>
            <!-- Add columns dynamically for each portfolio -->
            <th colspan="20">Output / Portfolios</th>
            <!-- Midterm -->
            <th colspan="2">Midterm</th>
        </tr>
        <tr>
            <th>Score</th>
            <th>Total</th>
            <!-- Generate columns for quizzes -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<th>Quiz ${i} Score</th><th>Quiz ${i} Total</th>`);
                }
            </script>
            <!-- Generate columns for portfolios -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<th>Portfolio ${i} Score</th><th>Portfolio ${i} Total</th>`);
                }
            </script>
            <!-- Midterm -->
            <th>Score</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Forteza, Jollyvher</td>
            <td>202010320</td>
            <td>20/25</td>
            <td><input type="number" id="participationScore" name="participationScore" placeholder="Score"
                    required></td>
            <td><input type="number" id="participationTotal" name="participationTotal" placeholder="Total"
                    required></td>
            <!-- Add input fields for each quiz -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<td><input type="number" id="quizScore${i}" name="quizScore${i}" placeholder="Score" required></td>
                    <td><input type="number" id="quizTotal${i}" name="quizTotal${i}" placeholder="Total" required></td>`);
                }
            </script>
            <!-- Add input fields for each portfolio -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<td><input type="number" id="portfolioScore${i}" name="portfolioScore${i}" placeholder="Score" required></td>
                    <td><input type="number" id="portfolioTotal${i}" name="portfolioTotal${i}" placeholder="Total" required></td>`);
                }
            </script>
            <!-- Add input fields for Midterm -->
            <td><input type="number" id="midtermScore" name="midtermScore" placeholder="Score" required></td>
            <td><input type="number" id="midtermTotal" name="midtermTotal" placeholder="Total" required></td>
        </tr>
    </table>

    <!-- Second Table -->
    <h2>Class Participation and Quiz Input (Table 2)</h2>
    <table>
        <tr>
            <th rowspan="2">Student</th>
            <th rowspan="2">Student Number</th>
            <th rowspan="2">Attendance</th>
            <th colspan="2">Class Participation</th>
            <!-- Add columns dynamically for each quiz -->
            <th colspan="20">Quizzes</th>
            <!-- Add columns dynamically for each portfolio -->
            <th colspan="20">Output / Portfolios</th>
            <!-- Midterm -->
            <th colspan="2">Midterm</th>
        </tr>
        <tr>
            <th>Score</th>
            <th>Total</th>
            <!-- Generate columns for quizzes -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<th>Quiz ${i} Score</th><th>Quiz ${i} Total</th>`);
                }
            </script>
            <!-- Generate columns for portfolios -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<th>Portfolio ${i} Score</th><th>Portfolio ${i} Total</th>`);
                }
            </script>
            <!-- Midterm -->
            <th>Score</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Forteza Jollyvher A</td>
            <td>2020103230</td>
            <td>22/25</td>
            <td><input type="number" id="participationScore2" name="participationScore2" placeholder="Score" required></td>
            <td><input type="number" id="participationTotal2" name="participationTotal2" placeholder="Total" required></td>
            <!-- Add input fields for each quiz -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<td><input type="number" id="quizScore${i}2" name="quizScore${i}2" placeholder="Score" required></td>
                    <td><input type="number" id="quizTotal${i}2" name="quizTotal${i}2" placeholder="Total" required></td>`);
                }
            </script>
            <!-- Add input fields for each portfolio -->
            <script>
                for (let i = 1; i <= 10; i++) {
                    document.write(`<td><input type="number" id="portfolioScore${i}2" name="portfolioScore${i}2" placeholder="Score" required></td>
                    <td><input type="number" id="portfolioTotal${i}2" name="portfolioTotal${i}2" placeholder="Total" required></td>`);
                }
            </script>
            <!-- Add input fields for Midterm -->
            <td><input type="number" id="midtermScore2" name="midtermScore2" placeholder="Score" required></td>
            <td><input type="number" id="midtermTotal2" name="midtermTotal2" placeholder="Total" required></td>
        </tr>
    </table>

    <button type="button" onclick="calculateGrades()">Calculate</button>
    <button type="button" onclick="saveGrades()">Save</button>

    <div id="result">
        <!-- Result will be displayed here -->
    </div>

    <script>
        function calculateGrades() {
            // Get values from the form (First Table)
            var participationScore = parseFloat(document.getElementById('participationScore').value);
            var participationTotal = parseFloat(document.getElementById('participationTotal').value);
            var quizScores = [];
            var quizTotals = [];
            var portfolioScores = [];
            var portfolioTotals = [];
            var midtermScore = parseFloat(document.getElementById('midtermScore').value);
            var midtermTotal = parseFloat(document.getElementById('midtermTotal').value);

            // Same code as before for the first table

            // Get values for Second Table
            var participationScore2 = parseFloat(document.getElementById('participationScore2').value);
            var participationTotal2 = parseFloat(document.getElementById('participationTotal2').value);
            var quizScores2 = [];
            var quizTotals2 = [];
            var portfolioScores2 = [];
            var portfolioTotals2 = [];
            var midtermScore2 = parseFloat(document.getElementById('midtermScore2').value);
            var midtermTotal2 = parseFloat(document.getElementById('midtermTotal2').value);

            // Same code as before with variable names adjusted for the second table

            // Display results for both tables
            // ...

            // Example: Displaying total scores
            var totalScore = participationScore + midtermScore + finalsScore2;
            var totalTotal = participationTotal + midtermTotal + finalsTotal2;

            document.getElementById('result').innerHTML = `Total Score: ${totalScore} / Total Possible: ${totalTotal}`;
        }

        function saveGrades() {
            // Add your code here to save the grades
            alert("Grades saved successfully!");
        }
    </script>

</body>

</html>
