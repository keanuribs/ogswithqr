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
            $fname = "User Not Found"; // Set a default name for this case
            $lname = "User Not Found"; // Set a default name for this case
        }
    } else {
        die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
    }
    $roles = isset($_SESSION['ROLES']) ? $_SESSION['ROLES'] : "Role Not Found";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | Student Dashboard</title>
    <link rel="shortcut icon" href="../assets/img/dcslogo.ico">
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
                            <a href="student-dashboard.php"><i class="feather-grid"></i> <span>Student Dashboard</span></a>
                        </li>
                        <li class="menu-title">
                            <span>Student Details</span>
                        </li>
                        <li class="">
                            <a href="student-coursereg.php"><i class="fas fa-book-reader"></i><span>My Courses</span></a>
                        </li>
                        <!-- <li class="menu-title">
                            <span>Attendance Monitoring</span>
                        </li>
                        <li class="">
                        <a href="student-qr.php"><i class="fa fa-camera"></i><span>Scan QR</span></a>
                        </li> -->
                       
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
                                <h3 class="page-title">Welcome Student!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Student</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <img style="max-width: 100%; max-height: 100%; height: auto; width: auto;" src="../assets/images/hometest.jpg" alt="Student Dashboard">
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