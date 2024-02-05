<?php
date_default_timezone_set('Asia/Manila');

include '../phpqrcode/qrlib.php';
include '../db/config.php';

$currentPage = basename($_SERVER['PHP_SELF']);

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
    die();
}

include '../db/config.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $fname = $row['fname'];
        $lname = $row['lname'];
    } else {
        $fname = "User Not Found";
        $lname = "User Not Found";
    }
} else {
    die("Query failed: " . mysqli_error($conn));
}
$roles = isset($_SESSION['ROLES']) ? $_SESSION['ROLES'] : "Role Not Found";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | Students</title>
    <link rel="shortcut icon" href="assets/img/dcslogo.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
            <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>

    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css">
</head>

<body>

    <div class="main-wrapper">

    <?php include 'inc/facultyheader-sidebar.php';?>
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Students</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Student Details</a></li>
                                    <li class="breadcrumb-item active">Students</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


<main>
<div class="datatable-container">

    <div class="top-panel">
        <a href="#" class="btn btn-success" id="addStudentBtn"><i class="fas fa-plus"></i></a>
    </div>
    <table id="studentList" class="table table-striped border" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Student Number</th>
                <th>Course</th>
                <th>Year Section</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
</main>
</div>
</div> 

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../assets/plugins/apexchart/chart-data.js"></script>
    <script src="app2.js" type="module"></script>
    <script src="../assets/js/dashboardscript.js"></script>
   
</body>
</html>