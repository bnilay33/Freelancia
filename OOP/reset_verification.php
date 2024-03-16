<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="reset.css" />
    <title>reset password</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="reset_verification.php" method="POST" class="sign-in-form">
            <h2 class="title">Reset Password</h2>
            <div class="input-field">
              <i class="fas fa-globe"></i>
              <input type="Otp" name="otp_code" placeholder="Enter The OTP" />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="New Password" />
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="cpassword" placeholder="Confirm Password" />
              </div>
            <input type="submit" value="UPDATE PASSWORD" name="update" class="btn solid" />
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Reset Your Password </h3>
            <p>
              You can easily update your password .....
            </p>
           
          </div>
          <img src="reset.png" class="image" alt="" />
        </div>
        
      </div>
    </div>

    <script src="reset.js"></script>
  </body>
</html>

<?php
include('config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PasswordReset {
    private $connection;
    
    public function __construct() {
        $this->connection = new mysqli("localhost","root", "", "freelanciaaa");
    }

    public function updatePassword() {
        if (isset($_POST["update"])) {
            $otp = $_SESSION['otp'];
            $email = $_SESSION['mail'];
            $otpCode = $_POST['otp_code'];

            if ($otp != $otpCode) {
                $this->showAlert("Invalid OTP code");
            } else {
                $password = $_POST["password"];
                $confirmPassword = $_POST["cpassword"];

                if ($password === $confirmPassword) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $query = mysqli_query($this->connection, "SELECT * FROM signup_table WHERE email='$email'");
                    $rowCount = mysqli_num_rows($query);

                    if ($rowCount > 0) {
                        $newPassword = $hashedPassword;
                        $username = $_SESSION['name'];

                        $this->sendEmail($email, $username, $newPassword);
                    } else {
                        $this->showAlert("Please try again");
                    }
                } else {
                    $this->showAlert("Password and Confirm Password do not match.");
                }
            }
        }
    }

    private function showAlert($message) {
        echo "<script>alert('$message');</script>";
    }

    private function sendEmail($email, $username, $newPassword) {
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'freelanciateam@gmail.com';
        $mail->Password = 'rjbbfnguqhjokzsm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
        $mail->addAddress($email, $username);
        $mail->isHTML(true);
        $mail->Subject = 'Password Recovery Successful!';
        $mail->Body =  "<div style='background:rgb(19,84,78);color:white;'><h2 style='margin-left:20px;color:#21FD16;'>Free<span style='color:white;'>Lancia</span><br><center><span style='color:white;'>Welcome to FreeLancia !</span></center></h2>
        <p> Hi ,<br> 
        You successfully recover your password in Freelancia. Your password updated successfully.<br><br>
        You may log in now securely.<br></p>
        Don't share your OTP with anyone.
        FreeLancia never asks for OTP from its customers personally. So be careful and safe.<br><br>
        With Regards,<br>
        FreeLancia Team<br>
        If you did not reset this password, immediately reset your password. <a href='forgot.php'>Forgot Password</a> </div>";

        if (!$mail->send()) {
            echo "Successful but email not sent!";
        } else {
            mysqli_query($this->connection, "UPDATE signup_table SET password='$newPassword' WHERE email='$email'");
            echo "<script>window.location.replace('signup.php'); 
            alert('Your password has been successfully reset.');</script>";
        }
    }
}

$passwordReset = new PasswordReset();
$passwordReset->updatePassword();
?>
