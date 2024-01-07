<?php

    $currentPage = basename($_SERVER['PHP_SELF']);
    
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    include '../config.php';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
  

    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $name = $row['name'];
        } else {
            $name = "User Not Found"; // Set a default name for this case
        }
    } else {
        die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
    }

    $queryStudentCount = mysqli_query($conn, "SELECT COUNT(*) AS studentCount FROM tblstudents");

    if ($queryStudentCount) {
        $rowStudentCount = mysqli_fetch_assoc($queryStudentCount);
        $studentCount = $rowStudentCount['studentCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
    }

        $querySectionCount = mysqli_query($conn, "SELECT COUNT(*) AS sectionCount FROM tblsection");

    if ($querySectionCount) {
        $rowSectionCount = mysqli_fetch_assoc($querySectionCount);
        $sectionCount = $rowSectionCount['sectionCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
    }

    $queryProfessorCount = mysqli_query($conn, "SELECT COUNT(*) AS professorCount FROM tblprofessors");

    if ($queryProfessorCount) {
        $rowProfessorCount = mysqli_fetch_assoc($queryProfessorCount);
        $professorCount = $rowProfessorCount['professorCount'];
    } else {
        die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
    }

    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DCS | Dashboard</title>

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="icon" href="image/dcss.png" type="image" />
    <!--css file-->
    <link rel="stylesheet" href="combicss.css" />
    
    <script src="combijs.js" type="module"></script>
  </head>
  <body>
   <?php include '../inc/sidebar2.php';?>

    <section class="content">
    <?php include '../inc/navbar2.php';?>
      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
              <!-- <li>
                <a href="#">Dashboard</a>
              </li> -->
              <!-- <i class="fas fa-chevron-right"></i>
              <li>
                <a href="#" class="active">Home</a>
              </li> -->
            </ul>
          </div>

          <!-- <a href="#" class="download-btn">
            <i class="fas fa-cloud-download-alt"></i>
            <span class="text">Download Report</span>
          </a> -->
        </div>

        <div class="box-info">
          <li>
            <i class="fas fa-calendar-check"></i>
            <span class="text">
              <h3>1</h3>
              <p>Semester</p>
            </span>
          </li>
          <li>
            <i class="fas fa-people-group"></i>
              <span class="text">
              <h3><?php echo $studentCount; ?></h3>
              <p>Students</p>
            </span>
          </li>
          <li>
            <i class="fa-solid fa-book-bookmark"></i>
            <span class="text">
              <h3><?php echo $sectionCount; ?></h3>
              <p>Sections</p>
            </span>
          </li>
          <li>
            <i class="fa-solid fa-magnifying-glass"></i>
            <span class="text">
              <h3>9</h3>
              <p>Result</p>
            </span>
          </li>
            <li>
              <i class="fa-solid fa-person-chalkboard"></i>
                <span class="text">
                  <h3><?php echo $professorCount; ?></h3>
                  <p>Professors</p>
                </span>
            </li>
        </div>
 
          
       
        <!-- <div class="table-data">
          <div class="order">
            <div class="head">
              <h3>Recent Orders</h3>
              <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i>
            </div>

            <table>
              <thead>
                <tr>
                  <th>User</th>
                  <th>Order Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status process">Process</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status process">Process</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status complete">Complete</span></td>
                </tr>
              </tbody>
            </table>
          </div> -->

          <!-- <div class="todo">
            <div class="head">
              <h3>Todos</h3>
              <i class="fas fa-plus"></i>
              <i class="fas fa-filter"></i>
            </div>

            <ul class="todo-list">
              <li class="not-completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="not-completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
            </ul>
          </div> -->
        </div>
      </main>
    </section>
  </body>
</html>
