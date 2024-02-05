<?php

session_start();

$msg = "";

include '../db/config.php';

if (isset($_GET['reset'])) {
  
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $repeat_password = mysqli_real_escape_string($conn, md5($_POST['repeat_password']));

            $errors = array();
            if (strlen($_POST['password']) < 8) {
                $errors[] = "Password must be at least 8 characters long";
            }
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    $msg .= "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                // Check if the new password is different from the existing password
                $existingPassword = mysqli_query($conn, "SELECT password FROM users WHERE code='{$_GET['reset']}'");
                $row = mysqli_fetch_assoc($existingPassword);
                
                if ($row['password'] !== $password) {
                    $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                    if ($query) {
                        $_SESSION['RESET_SUCCESS'] = "Password changed successfully";
                        header("Location: login.php");
                        exit();
                    } else {
                        $msg = "<div class='alert alert-danger'>Error updating the password.</div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger'>The new password is the same as the existing password.</div>";
                }
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

?>
 <!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DCS Change Password </title> 
    <link rel="stylesheet" href="../assets/css/logregstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="icon" href="image/dcss.png" type="image" />
   </head>
<body>
  <div class="wrapper">
    <h2>Change Password</h2>
    <?php echo $msg; ?>
    <form action="" method="post">
      <div class="input-box">
        <input type="password" placeholder="Enter your password" name="password" required>
        <i class="uil uil-eye-slash pw_hide"></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm your password" name="repeat_password" required>
         <i class="uil uil-eye-slash pw_hide"></i>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Change Password" name="submit">
      </div>
      <div class="text">
        <h3>Back to <a href="login.php">Login</a></h3>
      </div>
    </form>
  </div>
  <script src="../assets/js/logregscript.js"></script>
</body>
</html>