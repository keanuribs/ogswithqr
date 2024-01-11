<!DOCTYPE html>
<html>

<head>
    <style>
        .table-container {
            display: flex;
            justify-content: space-between;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 48%; /* Adjusted width for two tables side by side */
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
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        #result {
            margin-top: 10px;
        }

        .label {
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
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
            <th colspan="3">Class Participation</th>
            <!-- Add columns dynamically for each quiz -->
            <th colspan="21">Quizzes</th>
            <!-- Add columns dynamically for each portfolio -->
            <th colspan="21">Output / Portfolios</th>
            <!-- Midterm -->
            <th colspan="3">Midterm</th>
        </tr>
        <tr>
            <td class="label" rowspan="2">Total & Score:</td>
            <td><input type="number" id="participationTotal" name="participationTotal" placeholder="Total" required></td>
            <th>Weighted</th>
            <!-- Midterm -->
            <td class="label" rowspan="2">Quiz #1</td>
            <td><input type="number" id="Quiz1Total" name="Quiz1Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #2</td>
            <td><input type="number" id="Quiz2Total" name="Quiz2Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #3</td>
            <td><input type="number" id="Quiz3Total" name="Quiz3Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #4</td>
            <td><input type="number" id="Quiz4Total" name="Quiz4Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #5</td>
            <td><input type="number" id="Quiz5Total" name="Quiz5Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #6</td>
            <td><input type="number" id="Quiz6Total" name="Quiz6Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #7</td>
            <td><input type="number" id="Quiz7Total" name="Quiz7Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #8</td>
            <td><input type="number" id="Quiz8Total" name="Quiz8Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #9</td>
            <td><input type="number" id="Quiz9Total" name="Quiz9Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #10</td>
            <td><input type="number" id="Quiz10Total" name="Quiz10Total" placeholder="Total" required></td>
            <th>Weighted</th>
            <!-- Add columns for portfolios -->
            <td class="label" rowspan="2">Portfolio 1</td>
            <td><input type="number" id="Portfolio1Total" name="Portfolio1Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 2</td>
            <td><input type="number" id="Portfolio2Total" name="Portfolio2Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 3</td>
            <td><input type="number" id="Portfolio3Total" name="Portfolio3Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 4</td>
            <td><input type="number" id="Portfolio4Total" name="Portfolio4Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 5</td>
            <td><input type="number" id="Portfolio5Total" name="Portfolio5Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 6</td>
            <td><input type="number" id="Portfolio6Total" name="Portfolio6Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 7</td>
            <td><input type="number" id="Portfolio7Total" name="Portfolio7Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 8</td>
            <td><input type="number" id="Portfolio8Total" name="Portfolio8Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 9</td>
            <td><input type="number" id="Portfolio9Total" name="Portfolio9Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 10</td>
            <td><input type="number" id="Portfolio10Total" name="Portfolio10Total" placeholder="Total" required></td>
            <th>Weighted</th>
            <td class="label" rowspan="2">Total & Score:</td>
            <td><input type="number" id="midtermTotal" name="midtermTotal" placeholder="Total" required></td>
            <th>Weighted</th>

            <!-- Repeat for Portfolio 5 to Portfolio 10 -->
        </tr>
        <tr>
            <td>Forteza, Jollyvher</td>
            <td>202010320</td>
            <td>20/25</td>
            <td><input type="number" id="participationScore" name="participationScore" placeholder="Score" required></td>
            <td>10%</td>
            <td><input type="number" id="Quiz1Score" name="Quiz1Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz2Score" name="Quiz2Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz3Score" name="Quiz3core" placeholder="Score" required></td>
            <td><input type="number" id="Quiz4Score" name="Quiz4Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz5Score" name="Quiz5Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz6Score" name="Quiz6Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz7Score" name="Quiz7Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz8Score" name="Quiz8Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz9Score" name="Quiz9Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz10Score" name="Quiz10Score" placeholder="Score" required></td>
            <td>15%</td>
            <!-- Add input fields for each portfolio -->
            <td><input type="number" id="Portfolio1Score" name="Portfolio1Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio2Score" name="Portfolio2Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio3Score" name="Portfolio3Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio4Score" name="Portfolio4Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio5Score" name="Portfolio5Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio6Score" name="Portfolio6Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio7Score" name="Portfolio7Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio8Score" name="Portfolio8Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio9Score" name="Portfolio8Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio10Score" name="Portfolio10Score" placeholder="Score" required></td>
            <td>15%</td>
            <td><input type="number" id="midtermScore" name="midtermScore" placeholder="Score" required></td>
            <td>20%</td>
        </tr>
    </table>

    <!-- Second Table -->
    <h2>Class Participation and Quiz Input (Table 2)</h2>
    <table>
        <tr>
            <th rowspan="2">Student</th>
            <th rowspan="2">Student Number</th>
            <th rowspan="2">Attendance</th>
            <th colspan="3">Class Participation</th>
            <!-- Add columns dynamically for each quiz -->
            <th colspan="21">Quizzes</th>
            <!-- Add columns dynamically for each portfolio -->
            <th colspan="21">Output / Portfolios</th>
            <!-- Midterm -->
            <th colspan="3">Midterm</th>
        </tr>
        <tr>
            <td class="label" rowspan="2">Total & Score:</td>
            <td><input type="number" id="participationTotal" name="participationTotal" placeholder="Total" required></td>
            <th>Weighted</th>
            <!-- Midterm -->
            <td class="label" rowspan="2">Quiz #1</td>
            <td><input type="number" id="Quiz1Total" name="Quiz1Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #2</td>
            <td><input type="number" id="Quiz2Total" name="Quiz2Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #3</td>
            <td><input type="number" id="Quiz3Total" name="Quiz3Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #4</td>
            <td><input type="number" id="Quiz4Total" name="Quiz4Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #5</td>
            <td><input type="number" id="Quiz5Total" name="Quiz5Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #6</td>
            <td><input type="number" id="Quiz6Total" name="Quiz6Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #7</td>
            <td><input type="number" id="Quiz7Total" name="Quiz7Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #8</td>
            <td><input type="number" id="Quiz8Total" name="Quiz8Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #9</td>
            <td><input type="number" id="Quiz9Total" name="Quiz9Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Quiz #10</td>
            <td><input type="number" id="Quiz10Total" name="Quiz10Total" placeholder="Total" required></td>
            <th>Weighted</th>
            <!-- Add columns for portfolios -->
            <td class="label" rowspan="2">Portfolio 1</td>
            <td><input type="number" id="Portfolio1Total" name="Portfolio1Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 2</td>
            <td><input type="number" id="Portfolio2Total" name="Portfolio2Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 3</td>
            <td><input type="number" id="Portfolio3Total" name="Portfolio3Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 4</td>
            <td><input type="number" id="Portfolio4Total" name="Portfolio4Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 5</td>
            <td><input type="number" id="Portfolio5Total" name="Portfolio5Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 6</td>
            <td><input type="number" id="Portfolio6Total" name="Portfolio6Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 7</td>
            <td><input type="number" id="Portfolio7Total" name="Portfolio7Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 8</td>
            <td><input type="number" id="Portfolio8Total" name="Portfolio8Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 9</td>
            <td><input type="number" id="Portfolio9Total" name="Portfolio9Total" placeholder="Total" required></td>
            <td class="label" rowspan="2">Portfolio 10</td>
            <td><input type="number" id="Portfolio10Total" name="Portfolio10Total" placeholder="Total" required></td>
            <th>Weighted</th>
            <td class="label" rowspan="2">Total & Score:</td>
            <td><input type="number" id="midtermTotal" name="midtermTotal" placeholder="Total" required></td>
            <th>Weighted</th>

            <!-- Repeat for Portfolio 5 to Portfolio 10 -->
        </tr>
        <tr>
            <td>Forteza, Jollyvher</td>
            <td>202010320</td>
            <td>20/25</td>
            <td><input type="number" id="participationScore" name="participationScore" placeholder="Score" required></td>
            <td>10%</td>
            <td><input type="number" id="Quiz1Score" name="Quiz1Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz2Score" name="Quiz2Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz3Score" name="Quiz3core" placeholder="Score" required></td>
            <td><input type="number" id="Quiz4Score" name="Quiz4Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz5Score" name="Quiz5Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz6Score" name="Quiz6Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz7Score" name="Quiz7Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz8Score" name="Quiz8Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz9Score" name="Quiz9Score" placeholder="Score" required></td>
            <td><input type="number" id="Quiz10Score" name="Quiz10Score" placeholder="Score" required></td>
            <td>15%</td>
            <!-- Add input fields for each portfolio -->
            <td><input type="number" id="Portfolio1Score" name="Portfolio1Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio2Score" name="Portfolio2Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio3Score" name="Portfolio3Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio4Score" name="Portfolio4Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio5Score" name="Portfolio5Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio6Score" name="Portfolio6Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio7Score" name="Portfolio7Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio8Score" name="Portfolio8Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio9Score" name="Portfolio8Score" placeholder="Score" required></td>
            <td><input type="number" id="Portfolio10Score" name="Portfolio10Score" placeholder="Score" required></td>
            <td>15%</td>
            <td><input type="number" id="midtermScore" name="midtermScore" placeholder="Score" required></td>
            <td>20%</td>
        </tr>
    </table>

    </div>

<!-- Submit button for the first table -->
<button type="button" onclick="submitForm()">Submit</button>

<div id="result">
    <!-- Result will be displayed here -->
</div>

<script>
    function submitForm() {
        // Add your form submission logic here
        console.log('Form submitted!');
    }
</script>

</body>

</html>