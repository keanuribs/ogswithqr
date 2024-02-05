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