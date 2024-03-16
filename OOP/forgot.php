<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    
    <link rel="stylesheet" href="forgot.css" />
    <title>Forgot Password</title>
  </head>
  <body>
    
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="forgot.php" method="POST" class="sign-in-form" name="reset_psw">
            <h2 class="title">Forgot Password</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" name="email" placeholder="Email Address" />
            </div>
            
            <input type="submit" value="Reset Password" name="reset" class="btn solid" />
            <div class="t"><p class="social-text">Back to <a href="#">Login</a></p>
            </div>
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Forgot Your Password ?</h3>
            <p>
              Don't worry You can easily reset your password .....
            </p>
           
          </div>
          <img src="frgt-removebg-preview.png" class="image" alt="" />
        </div>
        
      </div>
    </div>

    <script src="forgot.js"></script>
  </body>
</html>
<?php
include('config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function resetPassword($email) {
        $sql = "SELECT * FROM signup_table WHERE email='" . mysqli_real_escape_string($this->connection, $email) . "'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count <= 0) {
            echo "<script>alert('Sorry, no emails exist');</script>";
        } else {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;

            require 'PHPMailer/Exception.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->Username = 'freelanciateam@gmail.com';
            $mail->Password = 'rjbbfnguqhjokzsm';

            $mail->setFrom('freelanciateam@gmail.com', 'Password Reset');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Recover your password";
            $mail->Body = "<b>Dear User,</b>
                <h3>Your OTP is $otp</h3>
                <p>Kindly verify your OTP to reset your password.</p>
                <b>If you did not request for this OTP, feel free to contact us.<b><br>
                <h4>Email:- freelanciateam@gmail.com</h4>
                <br><br>
                <p>With regards,</p>
                <b>FreeLancia Team</b>";

            if (!$mail->send()) {
                echo "<script>alert('Invalid Email');</script>";
            } else {
                echo "<script>window.location.replace('reset_verification.php');</script>";
            }
        }
    }
}

if (isset($_POST["reset"])) {
    $email = $_POST['email'];
    $emailHandler = new EmailHandler($connection);
    $emailHandler->resetPassword($email);
}
?>
