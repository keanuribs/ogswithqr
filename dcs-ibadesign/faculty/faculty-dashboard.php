<?php

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

    $queryStudentCount = mysqli_query($conn, "SELECT COUNT(*) AS studentCount FROM tblstudents");

    if ($queryStudentCount) {
        $rowStudentCount = mysqli_fetch_assoc($queryStudentCount);
        $studentCount = $rowStudentCount['studentCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); 
    }

    $queryCourseCount = mysqli_query($conn, "SELECT COUNT(*) AS courseCount FROM course");

    if ($queryCourseCount) {
        $rowCourseCount = mysqli_fetch_assoc($queryCourseCount);
        $courseCount = $rowCourseCount['courseCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); 
    }

    $queryYearLevelCount = mysqli_query($conn, "SELECT COUNT(*) AS yearlevelCount FROM student_year");

    if ($queryCourseCount) {
        $rowYearLevelCount = mysqli_fetch_assoc($queryYearLevelCount);
        $yearlevelCount = $rowYearLevelCount['yearlevelCount'];
    } else {
        die("Query failed: " . mysqli_error($conn));
    }

    $querySectionCount = mysqli_query($conn, "SELECT COUNT(*) AS sectionCount FROM student_section");

    if ($queryCourseCount) {
        $rowSectionCount = mysqli_fetch_assoc($querySectionCount);
        $sectionCount = $rowSectionCount['sectionCount'];
    } else {
        die("Query failed: " . mysqli_error($conn));
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | Faculty Dashboard</title>
    <link rel="shortcut icon" href="assets/img/dcslogo.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
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
                                <h3 class="page-title">Welcome Faculty!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Faculty</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Students</h6>
                                        <h3><?php echo $studentCount; ?></h3>
                                    </div>
                                    <div class="db-icon" style="background-color: red;">
                                    <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Courses</h6>
                                        <h3><?php echo $courseCount; ?></h3>
                                    </div>
                                    <div class="db-icon" style="background-color: green;">
                                     <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Year Level</h6>
                                        <h3><?php echo $yearlevelCount; ?></h3>
                                    </div>
                                    <div class="db-icon" style="background-color: rgb(181, 30, 189);">
                                    <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Section</h6>
                                        <h3><?php echo $sectionCount; ?></h3>
                                    </div>
                                    <div class="db-icon" style="background-color: gray;">
                                    <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../assets/plugins/apexchart/chart-data.js"></script>
    <script src="../assets/js/dashboardscript.js"></script>
</body>

</html>