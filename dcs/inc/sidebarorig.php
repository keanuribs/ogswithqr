<section class="sidebar">
      <a href="#" class="logo">
        <img src="dcss.png"alt="Your Image Description">
        <span class="text">Department of Computer Studies</span>
      </a>

      <ul class="side-menu top">
      <li <?php echo ($currentPage === 'welcome.php') ? 'class="active"' : ''; ?>>
          <a href="welcome.php" class="nav-link">
            <i class="fas fa-border-all"></i>
            <span class="text">Dashboard</span>
          </a>
        </li>
        <li <?php echo ($currentPage === 'professor.php') ? 'class="active"' : ''; ?>>
          <a href="professor.php" class="nav-link">
            <i class="fa-solid fa-users"></i>
            <span class="text">Professors</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fa-solid fa-square-poll-vertical"></i>
            <span class="text">Attendance</span>
          </a>
      </li>
        <li <?php echo ($currentPage === 'students2.php') ? 'class="active"' : ''; ?>>
          <a href="students2.php" class="nav-link">
            <i class="fa-solid fa-users"></i>
            <span class="text">Students</span>
          </a>
        </li>
        <li <?php echo ($currentPage === 'course.php') ? 'class="active"' : ''; ?>>
          <a href="course.php" class="nav-link">
            <i class="fa-solid fa-school"></i>
            <span class="text">Course</span>
          </a>
        </li>
        <li <?php echo ($currentPage === 'yrlvl.php') ? 'class="active"' : ''; ?>>
          <a href="yrlvl.php" class="nav-link">
            <i class="fa-solid fa-school"></i>
            <span class="text">Year Level</span>
          </a>
        </li>
        <li <?php echo ($currentPage === 'sectionphp') ? 'class="active"' : ''; ?>>
          <a href="section.php" class="nav-link">
            <i class="fa-solid fa-school"></i>
            <span class="text">Section</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fa-solid fa-square-poll-vertical"></i>
            <span class="text">Grading</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span class="text">Users</span>
          </a>
        </li>
      </ul>

      <ul class="side-menu">
        <li>
          <a href="#">
            <i class="fas fa-cog"></i>
            <span class="text">Settings</span>
          </a>
        </li>
        <li>
          <a href="logout.php" class="logout">
            <i class="fas fa-right-from-bracket"></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </section>
    