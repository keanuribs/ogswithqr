<?php
session_start();

if (isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: faculty-dashboard.php");
  die();
}

if (isset($_SESSION['success_msg'])) {
  $successMsg = $_SESSION['success_msg'];
  // Clear the session variable to avoid displaying the message again on page reload
  unset($_SESSION['success_msg']);
} else {
  $successMsg = "";
}

if (isset($_SESSION['resend_success_msg'])) {
  $resendSuccessMsg = $_SESSION['resend_success_msg'];
  // Clear the session variable to avoid displaying the message again on page reload
  unset($_SESSION['resend_success_msg']);
} else {
  $resendSuccessMsg = "";
}

// Load Composer's autoloader
require 'vendor/autoload.php';
include '../db/config.php';
$msg = "";

if (isset($_POST['submit'])) {
  $code = mysqli_real_escape_string($conn, $_POST['otp']);
  $userEnteredOTP = mysqli_real_escape_string($conn, $_POST['otp']);

  if ($userEnteredOTP == $_SESSION['otp']) {
    $otpCreationTime = $_SESSION['otp_creation_time'];
    $currentTime = time();
    $otpValidityDuration = 5 * 60; // 5 minutes in seconds

    if (($currentTime - $otpCreationTime) <= $otpValidityDuration) {
      // Valid OTP, proceed with account verification
      $email = $_SESSION['REGISTER_EMAIL'];
      $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}' AND code='{$code}'");

      if (mysqli_num_rows($query) > 0) {
        $updateQuery = mysqli_query($conn, "UPDATE users SET code='' WHERE email='{$email}' AND code='{$code}'");

        if ($updateQuery) {
          $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
          $_SESSION['verification_msg'] = $msg;
          header("Location: faculty-login.php");
          exit();
        } else {
          $msg = "<div class='alert alert-danger'>Something went wrong with updating the database.</div>";
        }
      } else {
        $msg = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'>The OTP has expired. Please request a new one. <a href='resend-otp.php' class='custom-link'>Resend OTP</a></div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'>Invalid OTP. Please try again.</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> DCS Faculty </title>
  <link rel="stylesheet" href="../assets/css/logregstyle.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="icon" href="../assets/images/dcss.png" type="image" />
</head>

<body>
  <div class="wrapper">
    <h2>Verify OTP</h2>
    <?php echo $successMsg ?>
    <?php echo $msg ?>
    <form action="" method="post">
      <div class="input-box">
        <input type="text" placeholder="Enter OTP" name="otp" maxlength="6" required>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Verify OTP" name="submit">
      </div>
      <div class="text">
        <h3>Back to <a href="faculty-login.php">Login</a></h3>
      </div>

    </form>

  </div>

  <script src="../assets/js/logregscript.js"></script>
  
  
</body>

</html>