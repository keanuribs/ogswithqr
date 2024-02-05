<div class="header">

<div class="header-left">
    <a href="faculty-dashboard.php" class="logo">
        <img src="../assets/images/dcs-logo-with-text.png" alt="Logo">
    </a>
    <a href="faculty-dashboard.php" class="logo logo-small">
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
    <!-- <li class="nav-item dropdown noti-dropdown language-drop me-2">
        <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
            <img src="assets/img/icons/header-icon-01.svg" alt="">
        </a>
        <div class="dropdown-menu ">
            <div class="noti-content">
                <div>
                    <a class="dropdown-item" href="javascript:;"><i
                            class="flag flag-lr me-2"></i>English</a>
                    <a class="dropdown-item" href="javascript:;"><i
                            class="flag flag-bl me-2"></i>Francais</a>
                    <a class="dropdown-item" href="javascript:;"><i class="flag flag-cn me-2"></i>Turkce</a>
                </div>
            </div>
        </div>
    </li> -->

    <!-- <li class="nav-item dropdown noti-dropdown me-2">
        <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
            <img src="assets/img/icons/header-icon-05.svg" alt="">
        </a>
        <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
                <ul class="notification-list">
                    <li class="notification-message">
                        <a href="#">
                            <div class="media d-flex">
                                <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="User Image"
                                        src="assets/img/profiles/avatar-02.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                        approved <span class="noti-title">your estimate</span></p>
                                    <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media d-flex">
                                <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="User Image"
                                        src="assets/img/profiles/avatar-11.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">International Software
                                            Inc</span> has sent you a invoice in the amount of <span
                                            class="noti-title">$218</span></p>
                                    <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media d-flex">
                                <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="User Image"
                                        src="assets/img/profiles/avatar-17.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">John Hendry</span> sent
                                        a cancellation request <span class="noti-title">Apple iPhone
                                            XR</span></p>
                                    <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media d-flex">
                                <span class="avatar avatar-sm flex-shrink-0">
                                    <img class="avatar-img rounded-circle" alt="User Image"
                                        src="assets/img/profiles/avatar-13.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Mercury Software
                                            Inc</span> added a new product <span class="noti-title">Apple
                                            MacBook Pro</span></p>
                                    <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="topnav-dropdown-footer">
                <a href="#">View all Notifications</a>
            </div>
        </div>
    </li> -->
<!-- 
    <li class="nav-item zoom-screen me-2">
        <a href="#" class="nav-link header-nav-list win-maximize">
            <img src="assets/img/icons/header-icon-04.svg" alt="">
        </a>
    </li> -->

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
                <div class="avatar avatar-sm">
                    <img src="assets/img/profiles/avatar-01.jpg" alt="User Image"
                        class="avatar-img rounded-circle">
                </div>
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
                <a href="faculty-dashboard.php"><i class="feather-grid"></i> <span>Faculty Dashboard</span></a>
            </li>
            <li class="menu-title">
                <span>Student Details</span>
            </li>
            <li class="submenu">
                <a href="#"><i class="fas fa-book-reader"></i> <span>Students</span> <span
                        class="menu-arrow"></span></a>
                <ul>
                    <li><a href="student-list.php">Student List</a></li>
                    <li><a href="course.php">Course</a></li>
                    <li><a href="yrlvl.php">Year Level</a></li>
                    <li><a href="section.php">Section</a></li>
                </ul>
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
            <!-- <li class="menu-title">
                <span>Management</span>
            </li>
            <li class="submenu">
                <a href="#"><i class="fas fa-building"></i> <span>Reports</span> <span
                        class="menu-arrow"></span></a>
                <ul>
                    <li><a href="#">Grading Reports</a></li>
                    <li><a href="#">Attendence Reports</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
</div>