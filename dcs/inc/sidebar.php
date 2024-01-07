<section class="sidebar">
      <a href="#" class="logo">
        <img src="dcss.png"alt="Your Image Description">
        <span class="text">Department of Computer Studies</span>
      </a>
    <ul class="nav-links">
      <li <?php echo ($currentPage === 'welcome.php') ? 'class="active"' : ''; ?>>
        <a href="welcome.php">
        <i class="fas fa-border-all"></i>
          <span class="link_name">Dashboard</span>
        </a>
      </li>
      <li>
      <div class="iocn-link">
        <a href="#">
        <i class="fa-solid fa-square-poll-vertical"></i>
          <span class="link_name">Grading</span>
        </a>
        <i class="fa-solid fa-angle-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Grading</a></li>
          <li <?php echo ($currentPage === '../../../mementomori v2.4/dcs/grading/lecture/midterm.html') ? 'class="active"' : ''; ?>><a href="../../../mementomori v2.4/dcs/grading/lecture/midterm.html">Midterm [Lecture]</a></li>
          <li <?php echo ($currentPage === '../../../mementomori v2.4/dcs/grading/lecture/performanceAfterMidterm.html') ? 'class="active"' : ''; ?>><a href="../../../mementomori v2.4/dcs/grading/lecture/performanceAfterMidterm.html">Performance After Midterm</a></li>
          <li <?php echo ($currentPage === '../../../mementomori v2.4/dcs/grading/lecture/performanceAfterMidterm.html') ? 'class="active"' : ''; ?>><a href="../../../mementomori v2.4/dcs/grading/lecturewithlab/laboratory.html">Laboratory</a></li>
          <li <?php echo ($currentPage === '../../../mementomori v2.4/dcs/grading/lecture/performanceAfterMidterm.html') ? 'class="active"' : ''; ?>><a href="../../../mementomori v2.4/dcs/grading/lecturewithlab/lecture.html">Lecture</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class="fa-solid fa-square-poll-vertical"></i>
            <span class="link_name">Attendance</span>
          </a>
          <i class="fa-solid fa-angle-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Attendance</a></li>
          <li <?php echo ($currentPage === 'create-class-attendance.php') ? 'class="active"' : ''; ?>><a href="create-class-attendance.php">Create Attendance</a></li>
          <li <?php echo ($currentPage === 'view-attendance.php') ? 'class="active"' : ''; ?>><a href="view-attendance.php">View Attendance</a></li>
          <li <?php echo ($currentPage === 'mark_attendance.php') ? 'class="active"' : ''; ?>><a href="mark_attendance.php">Mark Attendance</a></li>
        </ul>
      </li>
      <li <?php echo ($currentPage === 'students2.php') ? 'class="active"' : ''; ?>>
        <a href="students2.php">
        <i class="fas fa-border-all"></i>
          <span class="link_name">Students</span>
        </a>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
          <i class="fa-solid fa-school"></i>
            <span class="link_name">Student Details</span>
          </a>
          <i class="fa-solid fa-angle-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Student Details/a></li>
          <li <?php echo ($currentPage === 'course.php') ? 'class="active"' : ''; ?>><a href="course.php">Course</a></li>
          <li <?php echo ($currentPage === 'yrlvl.php') ? 'class="active"' : ''; ?>><a href="yrlvl.php">Year Level</a></li>
          <li <?php echo ($currentPage === 'section.php') ? 'class="active"' : ''; ?>><a href="section.php">Section</a></li>
        </ul>
      </li>
      <li <?php echo ($currentPage === 'professor.php') ? 'class="active"' : ''; ?>>
        <a href="professor.php">
        <i class="fa-solid fa-users"></i>
          <span class="link_name">Professors/Instructors</span>
        </a>
      </li>
      <li style="margin-top: 30px;">
        <a href="logout.php" class="logout">
        <i class="fas fa-right-from-bracket" style="color: red;"></i>
          <span class="link_name">Logout</span>
        </a>
      </li>

</ul>
</section>