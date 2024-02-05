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

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | Courses</title>
    <link rel="shortcut icon" href="../assets/images/dcss.png">
       <!-- Font Awesome icons for additional styling and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Bootstrap CSS for styling and layout components -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css">
    <!-- JavaScript module for application logic -->
    <script src="../assets/js/course.js" type="module"></script>
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

            <!-- <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div> -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">


                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <!-- <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31"
                                alt="Soeng Souy"> -->
                            <div class="user-text">
                                <h6><?php echo $fname; ?> <?php echo $lname; ?></h6>
                                <p class="text-muted mb-0"><?php echo $roles; ?></p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <!-- <div class="avatar avatar-sm">
                                <img src="assets/img/profiles/avatar-01.jpg" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div> -->
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
                            <span>Management</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-graduation-cap"></i> <span>Grading</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="../grading/">Grading Students</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span>Attendance</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="#">Create Attendance</a></li>
                                <li><a href="#">View Attendance</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-building"></i> <span>Reports</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="#">Grading Reports</a></li>
                                <li><a href="#">Attendence Reports</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="main-wrapper">

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
                <th>Year</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userAddEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userModalLabel">Add New Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="userDataFrm" id="userDataFrm">
            <div class="modal-body">
                <div class="frm-status"></div>
                <div class="row mb-2">
                <div class="col">
                    <label for="studentLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="studentLastName" placeholder="Enter Last Name" required>
                </div>
                <div class="col">
                    <label for="studentFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="studentFirstName" placeholder="Enter First Name" required>
                </div>
                <div class="col">
                    <label for="studentMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="studentMiddleName" placeholder="Enter Middle Name" required>
                </div>
                </div>
                <div class="mb-3">
                    <label for="studentNumber" class="form-label">Student Number</label>
                    <input type="text" class="form-control" id="studentNumber" placeholder="Enter student number" required>
                </div>
                <div class="row mb-2">
                <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                    <input type="text" class="form-control" id="course" placeholder="Enter course" required>
                </div>
                <div class="row mb-2">
                <div class="mb-3">
                    <label for="yearsec" class="form-label">Year and Section</label>
                    <input type="text" class="form-control" id="yearsec" placeholder="Enter Yr&Sec" required>
                </div>
            <div class="modal-footer">
                <input type="hidden" id="studentID" value="0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitStudentBtn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
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