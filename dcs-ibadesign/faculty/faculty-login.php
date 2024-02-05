<?php
session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: faculty-dashboard.php");
  die();
}

      // Check if a verification message is set
    if (isset($_SESSION['verification_msg'])) {
      $verificationMsg = $_SESSION['verification_msg'];
      unset($_SESSION['verification_msg']);
    } else {
      $verificationMsg = "";
    }


    include '../db/config.php';

    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: faculty-login.php");
        }
    }

    if (isset($_SESSION['RESET_SUCCESS'])) {
      $msg = "<div class='alert alert-success'>{$_SESSION['RESET_SUCCESS']}</div>";
      // Unset the session variable to prevent it from showing on subsequent visits
      unset($_SESSION['RESET_SUCCESS']);
  }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

      if (!$result) {
          die("Query failed: " . mysqli_error($conn));
      }
      
      if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
      
          if (empty($row['code'])) {
              session_start();
              $_SESSION['SESSION_EMAIL'] = $email;
              $_SESSION['ROLES'] = $row['roles'];
              header("Location: faculty-dashboard.php");
              exit();
          } else {
              $msg = "<div class='alert alert-danger'>First verify your account and try again.</div>";
          }
      } else {
          $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
      }
      
      // Close the database connection after use
    mysqli_close($conn);
    }
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DCS | Faculty Login </title> 
    <link rel="stylesheet" href="../assets/css/logregstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="icon" href="../assets/images/dcss.png" type="image" />
   </head>
<body>
<div class="wrapper">
    <h2>Faculty Login</h2>
    <?php echo $verificationMsg ?>
    <?php echo $msg ?>
    <form action="faculty-login.php" method="post">
      <div class="input-box">
        <input type="email" placeholder="Enter your email" name="email" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Enter your password" name="password" required>
        <i class="uil uil-eye-slash pw_hide"></i>
      </div>
      <div class="textpass">
        <h3><a href="forgot-password.php">Forgot password?</a></h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Login" name="submit">
      </div>
      <div class="text">
        <h3>Not yet registered? Register <a href="faculty-register.php">here</a></h3>
      </div>
    </form>
  </div>

  <script src="../assets/js/logregscript.js"></script>
</body>
</html>