<!DOCTYPE html>
<html>

<head>
    <style>
        .table-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 48%;
            text-align: center;
            padding: 8px;
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


            // Set content for the cells
            cell1.innerHTML = "<input type='text' id='StudentNameTable1_" + rowCountTable1 + "' name='StudentNameTable1_" + rowCountTable1 + "' placeholder='Name' required>";
            cell2.innerHTML = "<input type='number' id='StudentNumberTable1_" + rowCountTable1 + "' name='StudentNumberTable1_" + rowCountTable1 + "' placeholder='Student number' required>";
            cell3.innerHTML = "<input type='number' id='AttendanceTable1_" + rowCountTable1 + "' name='AttendanceTable1_" + rowCountTable1 + "' placeholder='Score' required>";
            cell4.innerHTML = "Score";

            // Loop for lab activities
            for (var i = 1; i <= 10; i++) {
                var labActivityScoreCell = row.insertCell(-1);
                var labActivityInputId = "LabActivityTable1_" + i + "Score" + rowCountTable1;
                labActivityScoreCell.innerHTML = "<input type='number' id='" + labActivityInputId + "' name='" + labActivityInputId + "' placeholder='Score' required>";
            }

            // Loop for practical exams
            for (var i = 1; i <= 5; i++) {
                var practicalExamScoreCell = row.insertCell(-1);
                var practicalExamInputId = "PracticalExamTable1_" + i + "Score" + rowCountTable1;
                practicalExamScoreCell.innerHTML = "<input type='number' id='" + practicalExamInputId + "' name='" + practicalExamInputId + "' placeholder='Score' required>";
                var practicalExamLabelCell = row.insertCell(-1);
                practicalExamLabelCell.innerHTML = "Score";
            }

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

            // Set content for the cells
            cell1.innerHTML = "<input type='text' id='StudentNameTable2_" + rowCountTable2 + "' name='StudentNameTable2_" + rowCountTable2 + "' placeholder='Name' required>";
            cell2.innerHTML = "<input type='number' id='StudentNumberTable2_" + rowCountTable2 + "' name='StudentNumberTable2_" + rowCountTable2 + "' placeholder='Student number' required>";
            cell3.innerHTML = "<input type='number' id='AttendanceTable2_" + rowCountTable2 + "' name='AttendanceTable2_" + rowCountTable2 + "' placeholder='Score' required>";
            cell4.innerHTML = "Score";

            // Loop for lab activities
            for (var i = 1; i <= 10; i++) {
                var labActivityScoreCell = row.insertCell(-1);
                var labActivityInputId = "LabActivityTable2_" + i + "Score" + rowCountTable2;
                labActivityScoreCell.innerHTML = "<input type='number' id='" + labActivityInputId + "' name='" + labActivityInputId + "' placeholder='Score' required>";
            }

            // Loop for practical exams
            for (var i = 1; i <= 5; i++) {
                var practicalExamScoreCell = row.insertCell(-1);
                var practicalExamInputId = "PracticalExamTable2_" + i + "Score" + rowCountTable2;
                practicalExamScoreCell.innerHTML = "<input type='number' id='" + practicalExamInputId + "' name='" + practicalExamInputId + "' placeholder='Score' required>";
                var practicalExamLabelCell = row.insertCell(-1);
                practicalExamLabelCell.innerHTML = "Score";
            }

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
                <th colspan="1">Total and score</th>

                <?php
                // Loop for lab activities
                for ($i_table1 = 1; $i_table1 <= 10; $i_table1++) {
                    echo "<th colspan='1'>Lab Activity #{$i_table1} Total & Score:</th>";
                }

                // Loop for practical exams
                for ($i_table1 = 1; $i_table1 <= 5; $i_table1++) {
                    echo "<th colspan='2'>Practical Exam #{$i_table1} Total & Score:</th>";
                }
                ?>
            </tr>
            <tr>
                <th>Total</th>

                <?php
                // Loop for lab activities
                for ($i_table1 = 1; $i_table1 <= 10; $i_table1++) {
                    echo "<td><input type='number' id='LabActivityTable1{$i_table1}Total' name='LabActivityTable1{$i_table1}Total' placeholder='Total' required></td>";
                }

                // Loop for practical exams
                for ($i_table1 = 1; $i_table1 <= 5; $i_table1++) {
                    echo "<td><input type='number' id='PracticalExamTable1{$i_table1}Total' name='PracticalExamTable1{$i_table1}Total' placeholder='Total' required></td>";
                    echo "<td>Total</td>";
                }
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
                <th colspan="1">Total & Score</th>

                <?php
                // Loop for lab activities
                for ($i_table2 = 1; $i_table2 <= 10; $i_table2++) {
                    echo "<th colspan='1'>Lab Activity #{$i_table2} Total & Score:</th>";
                }

                // Loop for practical exams
                for ($i_table2 = 1; $i_table2 <= 5; $i_table2++) {
                    echo "<th colspan='2'>Practical Exam #{$i_table2} Total & Score:</th>";
                }
                ?>
            </tr>
            <tr>
                <th>Total</th>

                <?php
                // Loop for lab activities
                for ($i_table2 = 1; $i_table2 <= 10; $i_table2++) {
                    echo "<td><input type='number' id='LabActivityTable2{$i_table2}Total' name='LabActivityTable2{$i_table2}Total' placeholder='Total' required></td>";
                }

                // Loop for practical exams
                for ($i_table2 = 1; $i_table2 <= 5; $i_table2++) {
                    echo "<td><input type='number' id='PracticalExamTable2{$i_table2}Total' name='PracticalExamTable2{$i_table2}Total' placeholder='Total' required></td>";
                    echo "<td>Total</td>";
                }
                ?>
            </tr>
        </table>
    </div>

    <button onclick="addRows()">Add Row</button>

</body>

</html>
