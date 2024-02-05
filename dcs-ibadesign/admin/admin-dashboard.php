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

    $queryStudentCount = mysqli_query($conn, "SELECT COUNT(*) AS studentCount FROM students");

    if ($queryStudentCount) {
        $rowStudentCount = mysqli_fetch_assoc($queryStudentCount);
        $studentCount = $rowStudentCount['studentCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); 
    }
    $roles = isset($_SESSION['ROLES']) ? $_SESSION['ROLES'] : "Role Not Found";

    $queryStudentCount = mysqli_query($conn, "SELECT COUNT(*) AS studentCount FROM students");

    if ($queryStudentCount) {
        $rowStudentCount = mysqli_fetch_assoc($queryStudentCount);
        $studentCount = $rowStudentCount['studentCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); 
    }

    // Additional variable definitions
    $queryCourseCount = mysqli_query($conn, "SELECT COUNT(*) AS courseCount FROM course");
    $queryYearLevelCount = mysqli_query($conn, "SELECT COUNT(*) AS yearlevelCount FROM tblyearlvl");
    $querySectionCount = mysqli_query($conn, "SELECT COUNT(*) AS sectionCount FROM tblsection");
    $queryProfessorCount = mysqli_query($conn, "SELECT COUNT(*) AS professorCount FROM tblprofessors");

    if ($queryCourseCount && $queryYearLevelCount && $querySectionCount && $queryProfessorCount) {
        $rowCourseCount = mysqli_fetch_assoc($queryCourseCount);
        $courseCount = $rowCourseCount['courseCount'];

        $rowYearLevelCount = mysqli_fetch_assoc($queryYearLevelCount);
        $yearlevelCount = $rowYearLevelCount['yearlevelCount'];

        $rowSectionCount = mysqli_fetch_assoc($querySectionCount);
        $sectionCount = $rowSectionCount['sectionCount'];

        $rowProfessorCount = mysqli_fetch_assoc($queryProfessorCount);
        $professorCount = $rowProfessorCount['professorCount'];
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | Admin Dashboard</title>
    <link rel="shortcut icon" href="../assets/images/dcss.png">
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

        <div class="header">

            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="../assets/images/dcs-logo-with-text.png" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="../assets/images/dcss.png" alt="Logo" width="90" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">


                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <div class="user-text">
                                <h6><?php echo $fname; ?> <?php echo $lname; ?></h6>
                                <p class="text-muted mb-0"><?php echo $roles; ?></p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="user-text">
                                <h6><?php echo $fname; ?> <?php echo $lname; ?></h6>
                                <p class="text-muted mb-0"><?php echo $roles; ?></p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="../db/logout.php">Logout</a>
                    </div>
                </li>

            </ul>

        </div>



        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Dashboard</span>
                        </li>
                        <li class="active">
                            <a href="admin-dashboard.php"><i class="feather-grid"></i> <span>Admin Dashboard</span></a>
                        </li>
                        <li class="menu-title">
                            <span>Student Details</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-book-reader"></i> <span>Students</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="students2.php">Student List</a></li>
                                <li><a href="course.php">Course</a></li>
                                <li><a href="yrlvl.php">Year Level</a></li>
                                <li><a href="section.php">Section</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>Instructor Details</span>
                        </li>
                        <li class="">
                            <a href="professor.php"><i class="fa fa-user" aria-hidden="true"></i><span>Instructors List</span></a>
                        </li>
                        <li class="menu-title">
                <span>Grading</span>
            </li>
            <li class="submenu">
                <a href="#"><i class="fa fa-edit"></i><span>Grading</span> <span
                        class="menu-arrow"></span></a>
                <ul>
                    <li><a href="../grading/lecuture/lecture.php">Lecture Only</a></li>
                    <li><a href="../grading/lecturewithlab/lecturewithlab.php">Lecture with Laboratory</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#"><i class="fas fa-graduation-cap"></i> <span>Attendance</span> <span
                        class="menu-arrow"></span></a>
                <ul>
                    <li><a href="create-class-attendance.php">Create Attendance</a></li>
                    <li><a href="view-attendance.php">View Attendance</a></li>
                </ul>
            </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Welcome Admin!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
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
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Professors</h6>
                                        <h3><?php echo $professorCount; ?></h3>
                                    </div>
                                    <div class="db-icon" style="background-color: gray;">
                                    <i class="fa fa-user-plus"></i>
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