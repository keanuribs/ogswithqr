
<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'dcsimusdept@gmail.com';                     //SMTP username
                $mail->Password   = 'nxfi vvlv cofu wzse';                              //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('dcsimusdept@gmail.com', 'Department of Computer Studies - Imus Campus');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset Verification [DO NOT REPLY] ';
                $mail->Body    = '
                <p>Hello '.$name.',</p>
                <p>We received a request to reset the password for your account. If you did not make this request, you can ignore this email. No changes will be made to your account.</p>
                <p>To reset your password, please click on the following link:</p>
                <br><b><a href="http://localhost/mementomori/dcs/change-password.php?reset='.$code.'">Reset Password</a></b>
                <br><br><p>Best regards,<br><b>Department of Computer Studies - Imus Campus</b></p>';
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-success'>A link for reset verification has been sent to your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email address not found</div>";
    }
}

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DCS Forgot Password </title> 
    <link rel="stylesheet" href="css/logregstyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="icon" href="image/dcss.png" type="image" />
   </head>
<body>
<div class="wrapper">
    <h2>Forgot Password</h2>
    <?php echo $msg ?>
    <form action="" method="post">
      <div class="input-box">
        <input type="email" placeholder="Enter your email" name="email" required>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Send Reset Link" name="submit">
      </div>
      <div class="text">
        <h3>Back to <a href="login.php">Login</a></h3>
      </div>
    </form>
  </div>

  <script src="js/logregscript.js"></script>
</body>
</html>