<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

require 'vendor/autoload.php';
include 'db/config.php';
$msg = "";

require 'SMTP_validateEmail.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $passwordRepeat = mysqli_real_escape_string($conn, md5($_POST['repeat_password']));
    $code = mysqli_real_escape_string($conn, rand(100000, 999999)); // Generate random 6-digit OTP

    $_SESSION['REGISTER_EMAIL'] = $email;
    $_SESSION['otp'] = $code;
    $timestamp = time();
    $_SESSION['otp_creation_time'] = $timestamp;

    $errors = array();

    if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "All fields are required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    } else {
        $domain = explode('@', $email)[1];
        if ($domain !== 'gmail.com') {
            $errors[] = "Only Gmail addresses are allowed for registration";
        }
    }

    if (strlen($_POST['password']) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $passwordRepeat) {
        $errors[] = "Password does not match.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            $msg .= "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>This email address has already been used.</div>";
        } else {
            $validator = new SMTP_validateEmail();
            $validator->setSenderEmail('dcsimusdept@gmail.com');
            $validation_results = $validator->validate([$email]);

            if ($validation_results[$email]) {
                $sql = "INSERT INTO users (name, email, password, code, otp_creation_time) VALUES ('{$name}', '{$email}', '{$password}', '{$code}', FROM_UNIXTIME($timestamp))";
                $result = mysqli_query($conn, $sql);

                if ($result) {
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
                        $mail->Subject = 'Account Verification [DO NOT REPLY]';
                        $mail->Body    = '
                        <p>Dear '.$name.',</p>
                        <p>Thank you for creating an account with us. To complete the registration process, please use the following OTP (One-Time Password):</p>
                        <b><span style="font-size: 200%;">'.$code.'</b>
                        <br><p>Please enter this OTP on the verification page to activate your account.<b> Note: This OTP is valid for a single use and will expire in 5 minutes.</b></p>
                        <br><p>If you did not create an account, please ignore this email.</p>
                        <p>Best regards,<br><b>Department of Computer Studies - Imus Campus</b></p>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-success'>Registration successful! An OTP (One-Time Password) has been sent to your email address.</div>";
                    $_SESSION['success_msg'] = $msg;
                    header("Location: input-otp.php");
                } else {
                    $msg = "<div class='alert alert-danger'>Something went wrong.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Invalid email address or email does not exist.</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DCS Register</title>
    <link rel="stylesheet" href="../assets/css/logregstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="icon" href="image/dcss.png" type="image" />
</head>
<body>
<div class="wrapper">
    <h2>Registration</h2>
    <?php echo $msg; ?>
    <form action="register.php" method="post">
        <div class="input-box">
            <input type="text" placeholder="Enter your name" name="name" required>
        </div>
        <div class="input-box">
            <input type="email" placeholder="Enter your email" name="email" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter your password" name="password" required>
            <i class="uil uil-eye-slash pw_hide"></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Confirm your password" name="repeat_password" required>
            <i class="uil uil-eye-slash pw_hide"></i>
        </div>
        <div class="input-box button">
            <input type="Submit" value="Register" name="submit">
        </div>
        <div class="text">
            <h3>Already have an account? <a href="login.php">Login now</a></h3>
        </div>
    </form>
</div>

<script src="../assets/js/logregscript.js"></script>
</body>
</html>
