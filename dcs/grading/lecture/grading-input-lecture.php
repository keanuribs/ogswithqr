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
            width: 80px; /* Adjusted width for better readability */
            text-align: center;
            padding: 5px; /* Added padding for better appearance */
            -moz-appearance: textfield; /* Firefox */
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Webkit browsers like Chrome and Safari */
            margin: 0; /* Removes the inner spin button */
        }

        button {
            width: 100%;
            padding: 10px;
        }

        #result {
            margin-top: 10px;
        }

        .table-container {
            margin-top: 20px;
            display: flex;
        }

        .table-container table {
            width: 48%; /* Adjusted width to leave some space */
        }

        .table-container table:last-child {
            margin-left: 4%; /* Margin between the two tables */
        }
    </style>
</head>

<body>

    <h2>Class Participation and Quiz Input</h2>

    <div class="table-container">
        <table>
            <tr>
                <th rowspan="2">Student</th>
                <th rowspan="2">Student Number</th>
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

        <table>
            <!-- Copy the structure of the first table without Student and Student Number -->
            <tr>
                <th colspan="2">Class Participation</th>
                <!-- Add columns dynamically for each quiz -->
                <th colspan="20">Quizzes</th>
                <!-- Add columns dynamically for each portfolio -->
                <th colspan="20">Output / Portfolios</th>
                <!-- Finals -->
                <th colspan="2">Finals</th>
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
                <!-- Finals -->
                <th>Score</th>
                <th>Total</th>
            </tr>
            <tr>
                <!-- Add input fields for each quiz -->
                <script>
                    for (let i = 1; i <= 10; i++) {
                        document.write(`<td><input type="number" id="quizScore${i}Finals" name="quizScore${i}Finals" placeholder="Score" required></td>
                        <td><input type="number" id="quizTotal${i}Finals" name="quizTotal${i}Finals" placeholder="Total" required></td>`);
                    }
                </script>
                <!-- Add input fields for each portfolio -->
                <script>
                    for (let i = 1; i <= 10; i++) {
                        document.write(`<td><input type="number" id="portfolioScore${i}Finals" name="portfolioScore${i}Finals" placeholder="Score" required></td>
                        <td><input type="number" id="portfolioTotal${i}Finals" name="portfolioTotal${i}Finals" placeholder="Total" required></td>`);
                    }
                </script>
                <!-- Add input fields for Finals -->
                <td><input type="number" id="finalsScore" name="finalsScore" placeholder="Score" required></td>
                <td><input type="number" id="finalsTotal" name="finalsTotal" placeholder="Total" required></td>
            </tr>
        </table>
    </div>

    <button type="button" onclick="calculateGrades()">Calculate</button>

    <div id="result">
        <!-- Result will be displayed here -->
    </div>

    <script>
        function calculateGrades() {
            // Get values from the form
            var participationScore = parseFloat(document.getElementById('participationScore').value);
            var participationTotal = parseFloat(document.getElementById('participationTotal').value);

            // Initialize variables for quiz scores and totals
            var quizScores = [];
            var quizTotals = [];

            // Loop to get values for each quiz
            for (let i = 1; i <= 10; i++) {
                var score = parseFloat(document.getElementById(`quizScore${i}`).value);
                var total = parseFloat(document.getElementById(`quizTotal${i}`).value);

                // Push values to arrays
                quizScores.push(score);
                quizTotals.push(total);
            }

            // Initialize variables for portfolio scores and totals
            var portfolioScores = [];
            var portfolioTotals = [];

            // Loop to get values for each portfolio
            for (let i = 1; i <= 10; i++) {
                var portfolioScore = parseFloat(document.getElementById(`portfolioScore${i}`).value);
                var portfolioTotal = parseFloat(document.getElementById(`portfolioTotal${i}`).value);

                // Push values to arrays
                portfolioScores.push(portfolioScore);
                portfolioTotals.push(portfolioTotal);
            }

            // Get values for Midterm
            var midtermScore = parseFloat(document.getElementById('midtermScore').value);
            var midtermTotal = parseFloat(document.getElementById('midtermTotal').value);

            // Get values for Finals
            var finalsScore = parseFloat(document.getElementById('finalsScore').value);
            var finalsTotal = parseFloat(document.getElementById('finalsTotal').value);

            // Check if all values are valid numbers
            if (!isNaN(participationScore) && !isNaN(participationTotal) && !quizScores.includes(NaN) && !quizTotals.includes(NaN) &&
                !isNaN(portfolioScores[0]) && !isNaN(portfolioTotals[0]) && !isNaN(midtermScore) && !isNaN(midtermTotal) &&
                !isNaN(finalsScore) && !isNaN(finalsTotal)) {

                // Calculate participation percentage
                var participationPercentage = (participationScore / participationTotal) * 100;

                // Calculate quiz percentages
                var quizPercentages = [];
                for (let i = 0; i < 10; i++) {
                    quizPercentages.push((quizScores[i] / quizTotals[i]) * 100);
                }

                // Calculate portfolio percentages
                var portfolioPercentages = [];
                for (let i = 0; i < 10; i++) {
                    portfolioPercentages.push((portfolioScores[i] / portfolioTotals[i]) * 100);
                }

                // Calculate Midterm percentage
                var midtermPercentage = (midtermScore / midtermTotal) * 100;

                // Calculate Finals percentage
                var finalsPercentage = (finalsScore / finalsTotal) * 100;

                // Display the result
                document.getElementById('result').innerHTML = "Participation Percentage: " + participationPercentage.toFixed(2) + "%<br>";

                for (let i = 0; i < 10; i++) {
                    document.getElementById('result').innerHTML += `Quiz ${i + 1} Percentage: ${quizPercentages[i].toFixed(2)}%<br>`;
                }

                for (let i = 0; i < 10; i++) {
                    document.getElementById('result').innerHTML += `Portfolio ${i + 1} Percentage: ${portfolioPercentages[i].toFixed(2)}%<br>`;
                }

                document.getElementById('result').innerHTML += `Midterm Percentage: ${midtermPercentage.toFixed(2)}%<br>`;
                document.getElementById('result').innerHTML += `Finals Percentage: ${finalsPercentage.toFixed(2)}%<br>`;

            } else {
                // Display an error message if input is not valid
                document.getElementById('result').innerHTML = "Please enter valid numbers.";
            }
        }
    </script>

</body>

</html>
