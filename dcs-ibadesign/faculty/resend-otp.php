<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

// Load Composer's autoloader
require 'vendor/autoload.php';
include '../db/config.php';
$msg = "";
require 'SMTP_validateEmail.php';

if (isset($_POST['resend'])) {
    $email = $_SESSION['REGISTER_EMAIL']; // Retrieve the email from the session

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a new OTP and update creation time
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_creation_time'] = time();

        // Update the database with the new OTP and creation time
        $updateQuery = mysqli_query($conn, "UPDATE users SET code='{$otp}', otp_creation_time=NOW() WHERE email='{$email}'");

        if ($updateQuery) {
            echo "<div style='display: none;'>";
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dcsimusdept@gmail.com';
                $mail->Password   = 'nxfi vvlv cofu wzse';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('dcsimusdept@gmail.com', 'Department of Computer Studies - Imus Campus');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'RESEND OTP VERIFICATION [DO NOT REPLY]';
                $mail->Body    = '
                    <p>Dear User,</p>
                    <p>Your new OTP is: </p>
                    <b><span style="font-size: 200%;">'.$otp.'</span></b>
                    <p>Please enter this OTP on the verification page to activate your account. Note: This OTP is valid for a single use only.</p>
                    <p>If you did not request a new OTP, please ignore this email.</p>
                    <p>Best regards,<br><b>Department of Computer Studies - Imus Campus</b></p>';

                $mail->send();
                $msg = "<div class='alert alert-success'>A new OTP has been sent to your email address.</div>";
                $_SESSION['success_msg'] = $msg;
                header("Location: input-otp.php");
            } catch (Exception $e) {
                $msg = "<div class='alert alert-danger'>Error sending the new OTP. Please try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Error updating the database. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Invalid email address or email does not exist.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resend OTP</title>
    <link rel="stylesheet" href="../assets/css/logregstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="icon" href="image/dcss.png" type="image" />
</head>
<body>
<div class="wrapper">
    <h2>Resend OTP?</h2>
    <?php echo $msg ?>
    <form action="resend-otp.php" method="post"> <!-- Update the form action -->
        <div class="input-box button">
            <input type="submit" value="Resend OTP" name="resend">
        </div>
        <!-- <div class="text">
            <h3>Back to <a href="login.php">Login</a></h3>
        </div> -->
    </form>
</div>
<script src="../assets/js/logregscript.js"></script>
</body>
</html>
