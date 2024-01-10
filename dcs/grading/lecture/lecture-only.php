<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 50%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }

        .table-container {
            display: flex;
            margin-bottom: 20px;
            /* Removed justify-content to make tables flow horizontally */
        }

        .table-container table {
            margin-right: 20px;
            /* Added margin to create space between tables */
        }
    </style>
</head>

<body>

    <h2>Grading Sheet</h2>

    <div class="table-container">
        <table>
            <tr>
                <th colspan="2">Students</th>
                <th colspan="3">Attendance</th>
                <th colspan="2">Class Participation</th>
                <th colspan="12">Quiz</th>
                <th colspan="12">Output / Portfolio</th>
                <th colspan="2">Midterm</th>
                <th colspan="2">Midterm Grade</th>
            </tr>
            <tr>
                <!--STUDENT INFO -->
                <td>Name</td>
                <td>Student Number</td>
                <td>Present</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Quiz 1</td>
                <td>Quiz 2</td>
                <td>Quiz 3</td>
                <td>Quiz 4</td>
                <td>Quiz 5</td>
                <td>Quiz 6</td>
                <td>Quiz 7</td>
                <td>Quiz 8</td>
                <td>Quiz 9</td>
                <td>Quiz 10</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Output 1</td>
                <td>Output 2</td>
                <td>Output 3</td>
                <td>Output 4</td>
                <td>Output 5</td>
                <td>Output 6</td>
                <td>Output 7</td>
                <td>Output 8</td>
                <td>Output 9</td>
                <td>Output 10</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Remark</td>
            </tr>
            <tr>
                <!--STUDENT INFO -->
                <td>Forteza, Jollyvher A</td>
                <td>202010320</td>
                <!--attendance info -->
                <td>10</td>
                <td>20</td>
                <td>9.5</td>
                <!--Class participation info -->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>9.5</td>
                <!--Quiz info-->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>14.25</td>
                <!--Output / Portfolio info-->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>23.75</td>
                <!--Midterm info -->
                <td><sup>100</sup>/<sub>150</sub></td>
                <td>13.33</td>
                <!--Midterm grade Info -->
                <td>70.33</td>
                <td>Passing</td>
            </tr>
            <!-- Add more rows as needed -->
        </table>

        <table>
            <tr>
                <th colspan="3">Attendance</th>
                <th colspan="2">Class Participation</th>
                <th colspan="12">Quiz</th>
                <th colspan="12">Output / Portfolio</th>
                <th colspan="2">Finals</th>
                <th colspan="2">Transmutated Grade</th>
            </tr>
            <tr>
                <!--STUDENT INFO -->
                <td>Present</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Quiz 1</td>
                <td>Quiz 2</td>
                <td>Quiz 3</td>
                <td>Quiz 4</td>
                <td>Quiz 5</td>
                <td>Quiz 6</td>
                <td>Quiz 7</td>
                <td>Quiz 8</td>
                <td>Quiz 9</td>
                <td>Quiz 10</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Output 1</td>
                <td>Output 2</td>
                <td>Output 3</td>
                <td>Output 4</td>
                <td>Output 5</td>
                <td>Output 6</td>
                <td>Output 7</td>
                <td>Output 8</td>
                <td>Output 9</td>
                <td>Output 10</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Weight</td>
                <td>Total</td>
                <td>Remark</td>
            </tr>
            <tr>

                <!--attendance info -->
                <td>10</td>
                <td>20</td>
                <td>9.5</td>
                <!--Class participation info -->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>9.5</td>
                <!--Quiz info-->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>14.25</td>
                <!--Output / Portfolio info-->
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td><sup>19</sup>/<sub>20</sub></td>
                <td>23.75</td>
                <!--Midterm info -->
                <td><sup>100</sup>/<sub>150</sub></td>
                <td>13.33</td>
                <td>83.67</td>
                <td>2.0</td>
            </tr>
            <!-- Add more rows as needed -->
        </table>
    </div>

</body>

</html>
