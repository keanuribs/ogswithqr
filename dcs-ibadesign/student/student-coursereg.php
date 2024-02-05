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
    $user_id = isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : null;

    //fetching academic year
    $query_academic = mysqli_query($conn, "SELECT * FROM academic_list WHERE status = 1");
    $row_academic = mysqli_fetch_assoc($query_academic);

    $default_year = $row_academic['year'];
    $default_semester = $row_academic['semester'];


    $query = "SELECT course_id, courses FROM course";
    $resultCourse = $conn->query($query);
    $optionsCourse = '';
    if ($resultCourse->num_rows > 0) {
        while ($rowCourse = $resultCourse->fetch_assoc()) {
            $course_id = $rowCourse['course_id'];
            $courses = $rowCourse['courses'];
            $optionsCourse .= "<option value='$course_id'>$courses</option>";
        }
    } else {
        $optionsCourse .= "<option value=''>No data found</option>";
    }

   
    $query = "SELECT year_id, year FROM student_year";
    $resultYear = $conn->query($query);
    $optionsYear = '';
    if ($resultYear->num_rows > 0) {
        while ($rowYear = $resultYear->fetch_assoc()) {
            $year_id = $rowYear['year_id'];
            $year_name = $rowYear['year'];
            $optionsYear .= "<option value='$year_id'>$year_name</option>";
        }
    } else {
        $optionsYear .= "<option value=''>No data found</option>";
    }


    $query = "SELECT status_id, stud_status FROM student_status";
    $result = $conn->query($query);
    $options = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $status_id = $row['status_id'];
            $stud_status = $row['stud_status'];
            $options .= "<option value='$status_id'>$stud_status</option>";
        }
    } else {
        $options .= "<option value=''>No data found</option>";
    }

   

    
    $query = "SELECT section_id, section FROM student_section";
    $resultSection = $conn->query($query);
    $optionsSection = '';
    
    if ($resultSection->num_rows > 0) {
        while ($rowSection = $resultSection->fetch_assoc()) {
            $section_id = $rowSection['section_id'];
            $section_name = $rowSection['section'];
            $optionsSection .= "<option value='$section_id'>$section_name</option>";
        }
    } else {
        $optionsSection .= "<option value=''>No data found</option>";
    }


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
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
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
            <div class="row align-items-center">
              <div class="col-sm-12">
                <div class="page-sub-header">
                  <h3 class="page-title">Add Subjects</h3>
                  <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="students.html">Student</a>
                    </li>
                    <li class="breadcrumb-item active">Add Subjects</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

<div class="row">
    <div class="col-sm-12">
        <div class="card comman-shadow">
            <div class="card-body">
                <form id="additionalRegForm" method="post" action="process_registration.php">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title student-info">
                                Personal Information
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            </h5>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="studentNumber">Student Number
                                </label>
                                <input id="studentNumber" class="form-control" type="text" name="studentNumber" placeholder="Enter Student Number">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="semester">Semester</label>
                                <input id="semester" class="form-control" type="text" name="semester" value="<?php echo $default_semester; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="schoolYear">School Year</label>
                                <input id="schoolYear" class="form-control" type="text" name="schoolYear" value="<?php echo $default_year; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                          <label>Last Name</label>
                          <input class="form-control" type="text" value="<?php echo $lname; ?>" readonly>
                        </div>
                      </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="middleName">Middle Name</label>
                                <input id="middleName" class="form-control" type="text" name="middleName" placeholder="Enter Middle Name">
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="firstName">First Name</label>
                                <input id="firstName" class="form-control" type="text" name="firstName" value="<?php echo $fname; ?>" readonly>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="course">Course</label>
                                <select id="courseSelector" class="form-control select" name="course" required>
                                    <?php echo $optionsCourse; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="year">Year</label>
                                <select class="form-control select" id="yearDropdown" name="year" required>
                                    <?php echo $optionsYear; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="status">Student Status</label>
                                <select class="form-control select" id="statusDropdown" name="status" required>
                                    <?php echo $options; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="section">Section
                                    <span class="login-danger">leave N/A if irregular</span>
                                </label>
                                <select class="form-control select" id="sectionDropdown" name="section" required>
                                    <?php echo $optionsSection; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="major">Major</label>
                                <input id="major" class="form-control" type="text" name="major" value="N/A" readonly>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="address">Address</label>
                                <input id="address" class="form-control" type="text" name="address" placeholder="Enter Address">
                            </div>
                        </div>
                        <!-- Add more fields as needed -->

                        <div class="col-12">
                            <h5 class="form-title student-info">
                                Subject Registration
                            </h5>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="subjectCount">How many subjects do you have?</label>
                                <select id="subjectCountSelector" class="form-control select" name="subjectCount">
                                    <option value="0">I have...</option>
                                    <?php
                                    for ($i = 1; $i <= 20; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12" id="subjectFieldsContainer">
                            <!-- Subject registration fields will be added dynamically using JavaScript -->
                        </div>

                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 12px 20px; display: block; margin: 0 auto;">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </div> 

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../assets/plugins/apexchart/chart-data.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/moment/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/js/dashboardscript.js"></script>
</body>

</html>