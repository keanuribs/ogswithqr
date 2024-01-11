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
            width: 48%;
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
            width: 98%;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <script>
        var rowCountTable1 = 1; // Initialize row count for Table 1
        var rowCountTable2 = 1; // Initialize row count for Table 2

        function addRowTable1() {
            var table = document.getElementById("midtermTable1");
            var row = table.insertRow(-1); // Insert new row at the end
            var rowId = "rowTable1_" + rowCountTable1; // Unique ID for the row

            // Set ID for the new row
            row.id = rowId;

            // Insert cells for the new row
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            // Set content for the cells
            cell1.innerHTML = "<input type='text' id='StudentNameTable1_" + rowCountTable1 + "' name='StudentNameTable1_" + rowCountTable1 + "' placeholder='Name' required>";
            cell2.innerHTML = "<input type='number' id='StudentNumberTable1_" + rowCountTable1 + "' name='StudentNumberTable1_" + rowCountTable1 + "' placeholder='Student number' required>";
            cell3.innerHTML = "<input type='number' id='AttendanceTable1_" + rowCountTable1 + "' name='AttendanceTable1_" + rowCountTable1 + "' placeholder='Score' required>";
            cell4.innerHTML = "<input type='number' id='ParticipationScoreTable1_" + rowCountTable1 + "' name='ParticipationScoreTable1_" + rowCountTable1 + "' placeholder='Score' required>";
            cell5.innerHTML = "Score";

            // Loop for quizzes
            for (var i = 1; i <= 10; i++) {
                var quizScoreCell = row.insertCell(-1);
                var quizInputId = "QuizTable1_" + i + "Score" + rowCountTable1;
                quizScoreCell.innerHTML = "<input type='number' id='" + quizInputId + "' name='" + quizInputId + "' placeholder='Score' required>";
            }

            // Loop for portfolios
            for (var i = 1; i <= 10; i++) {
                var portfolioScoreCell = row.insertCell(-1);
                var portfolioInputId = "PortfolioTable1_" + i + "Score" + rowCountTable1;
                portfolioScoreCell.innerHTML = "<input type='number' id='" + portfolioInputId + "' name='" + portfolioInputId + "' placeholder='Score' required>";
                var portfolioLabelCell = row.insertCell(-1);
                portfolioLabelCell.innerHTML = "Score";
            }

            // Midterm
            var midtermLabelCell = row.insertCell(-1);
            midtermLabelCell.innerHTML = "Score";
            var midtermScoreCell = row.insertCell(-1);
            var midtermInputId = "MidtermTable1_Score" + rowCountTable1;
            midtermScoreCell.innerHTML = "<input type='number' id='" + midtermInputId + "' name='" + midtermInputId + "' placeholder='Score' required>";

            // Increment row count for Table 1
            rowCountTable1++;
        }

        function addRowTable2() {
            var table = document.getElementById("midtermTable2");
            var row = table.insertRow(-1); // Insert new row at the end
            var rowId = "rowTable2_" + rowCountTable2; // Unique ID for the row

            // Set ID for the new row
            row.id = rowId;

            // Insert cells for the new row
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            // Set content for the cells
            cell1.innerHTML = "<input type='text' id='StudentNameTable2_" + rowCountTable2 + "' name='StudentNameTable2_" + rowCountTable2 + "' placeholder='Name' required>";
            cell2.innerHTML = "<input type='number' id='StudentNumberTable2_" + rowCountTable2 + "' name='StudentNumberTable2_" + rowCountTable2 + "' placeholder='Student number' required>";
            cell3.innerHTML = "<input type='number' id='AttendanceTable2_" + rowCountTable2 + "' name='AttendanceTable2_" + rowCountTable2 + "' placeholder='Score' required>";
            cell4.innerHTML = "<input type='number' id='ParticipationScoreTable2_" + rowCountTable2 + "' name='ParticipationScoreTable2_" + rowCountTable2 + "' placeholder='Score' required>";
            cell5.innerHTML = "Score";

            // Loop for quizzes
            for (var i = 1; i <= 10; i++) {
                var quizScoreCell = row.insertCell(-1);
                var quizInputId = "QuizTable2_" + i + "Score" + rowCountTable2;
                quizScoreCell.innerHTML = "<input type='number' id='" + quizInputId + "' name='" + quizInputId + "' placeholder='Score' required>";
            }

            // Loop for portfolios
            for (var i = 1; i <= 10; i++) {
                var portfolioScoreCell = row.insertCell(-1);
                var portfolioInputId = "PortfolioTable2_" + i + "Score" + rowCountTable2;
                portfolioScoreCell.innerHTML = "<input type='number' id='" + portfolioInputId + "' name='" + portfolioInputId + "' placeholder='Score' required>";
                var portfolioLabelCell = row.insertCell(-1);
                portfolioLabelCell.innerHTML = "Score";
            }

            // Midterm
            var midtermLabelCell = row.insertCell(-1);
            midtermLabelCell.innerHTML = "Score";
            var midtermScoreCell = row.insertCell(-1);
            var midtermInputId = "MidtermTable2_Score" + rowCountTable2;
            midtermScoreCell.innerHTML = "<input type='number' id='" + midtermInputId + "' name='" + midtermInputId + "' placeholder='Score' required>";

            // Increment row count for Table 2
            rowCountTable2++;
        }

        function addRows() {
            addRowTable1();
            addRowTable2();
        }
            // Function to add rows on page load
            function addDefaultRows() {
            addRows();
        }

        // Call the function on page load
        window.onload = addDefaultRows;
    </script>
    </script>
</head>

<body>

    <h2>Midterm Table 1</h2>

    <!-- Table 1 -->
    <div class="table-container">
        <table id="midtermTable1">

            <tr>
                <th rowspan="2">Student Name</th>
                <th rowspan="2">Student Number</th>
                <th rowspan="2">Attendance</th>
                <th colspan="2">Class Participation Total & Score:</th>

                <?php
                // Loop for quizzes
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th colspan='1'>Quiz #{$i} Total & Score:</th>";
                }

                // Loop for portfolios
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th colspan='2'>Output / Portfolio #{$i} Total & Score:</th>";
                }

                // Midterm
                echo "<th colspan='2'>Midterm Total & Score:</th>";
                ?>
            </tr>
            <tr>
                <td><input type="number" id="participationTotalTable1" name="participationTotalTable1" placeholder="Total" required></td>
                <th>Total</th>

                <?php
                // Loop for quizzes
                for ($i = 1; $i <= 10; $i++) {
                    echo "<td><input type='number' id='QuizTable1{$i}Total' name='QuizTable1{$i}Total' placeholder='Total' required></td>";
                }

                // Loop for portfolios
                for ($i = 1; $i <= 10; $i++) {
                    echo "<td><input type='number' id='PortfolioTable1{$i}Total' name='PortfolioTable1{$i}Total' placeholder='Total' required></td>";
                    echo "<td>Total</td>";
                }

                // Midterm
                echo "<th>Total</th>";
                echo "<td><input type='number' id='midtermTotalTable1' name='midtermTotalTable1' placeholder='Total' required></td>";
                ?>
            </tr>
        </table>
    </div>

    <h2>Midterm Table 2</h2>

    <!-- Table 2 -->
    <div class="table-container">
        <table id="midtermTable2">

        <tr>
                <th rowspan="2">Student Name</th>
                <th rowspan="2">Student Number</th>
                <th rowspan="2">Attendance</th>
                <th colspan="2">Class Participation Total & Score:</th>

                <?php
                // Loop for quizzes
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th colspan='1'>Quiz #{$i} Total & Score:</th>";
                }

                // Loop for portfolios
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th colspan='2'>Output / Portfolio #{$i} Total & Score:</th>";
                }

                // Midterm
                echo "<th colspan='2'>Finals Total & Score:</th>";
                ?>
            </tr>
            <tr>
                <td><input type="number" id="participationTotalTable2" name="participationTotalTable2" placeholder="Total" required></td>
                <th>Total</th>

                <?php
                // Loop for quizzes
                for ($i = 1; $i <= 10; $i++) {
                    echo "<td><input type='number' id='QuizTable2{$i}Total' name='QuizTable2{$i}Total' placeholder='Total' required></td>";
                }

                // Loop for portfolios
                for ($i = 1; $i <= 10; $i++) {
                    echo "<td><input type='number' id='PortfolioTable2{$i}Total' name='PortfolioTable2{$i}Total' placeholder='Total' required></td>";
                    echo "<td>Total</td>";
                }

                // Midterm
                echo "<th>Total</th>";
                echo "<td><input type='number' id='FnalsTable2' name='FnalsTable2' placeholder='Total' required></td>";
                ?>
            </tr>
        </table>
    </div>

    <button onclick="addRows()">Add Row</button>

</body>

</html>
