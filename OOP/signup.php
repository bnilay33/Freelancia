<?php
session_start();

// include 'config.php';
include 'Email_validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli("localhost","root", "", "freelanciaaa");
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

class UserRegistration
{
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    public function registerUser($username, $email, $pwd, $cpass, $user_type, $captcha, $captcharandom,$ebool,$bool)
    {
        if ($captcha === $captcharandom) {
            $user = ($user_type === 'Freelancer') ? "F_" . $username : "C_" . $username;

            $query = "SELECT * FROM `signup_table` WHERE `email`='$email' || `username`='$user';";
            // $result = mysqli_query($this->connection, $query);
            $result=$this->connection->query($query);
            $count = $result->num_rows;
            
            if ($count > 0) {
                return "User already exists.";
            }

            if ($pwd === $cpass && $ebool===1 && $bool===1) {
                $_SESSION['otp_request_time'] = $_SERVER['REQUEST_TIME'];
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                $_SESSION['name'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['password'] = $pwd;

                return "success";
            } else {
                return "Password not match";
            }
        } else {
            return "Captcha not match!";
        }
    }
}

class EmailSender
{
    public function sendVerificationEmail($email, $username, $otp)
    {
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

        $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Verification code";
        $mail->Body = "<p>Dear $username, </p> <h3>Your verify OTP code is $otp <br></h3>
      <br><br>
      <p>With regards,</p>
      <b>FreeLancia Team</b>";

        if (!$mail->send()) {
            return "Register Failed, Invalid Email";
        } else {
            return "Register Successfully, OTP sent to $email";
        }
    }
}

$rand = rand(9999,1000);
if (isset($_POST['submit'])) {
    $dbConnection = new DatabaseConnection();
    $userRegistration = new UserRegistration($dbConnection->getConnection());
    $signupvalidator=new SignupValidator(
      mysqli_real_escape_string($dbConnection->getConnection(), $_POST['email']),
      $pass=$_POST['password']
    );
    $values=$signupvalidator->validate();
    $Ebool=$values[0];
    $Bool=$values[1];
    $result = $userRegistration->registerUser(
        mysqli_real_escape_string($dbConnection->getConnection(), $_POST['username']),
        mysqli_real_escape_string($dbConnection->getConnection(), $_POST['email']),
        $pass =$_POST['password'],
        $cpass=$_POST['cpassword'],
        $user_type=$_POST['user_type'],
        $captcha=$_POST['captcha'],
        $captcharandom=$_POST['captcha-rand'],
        $Ebool,
        $Bool
    );

    if ($result === "success") {
        $emailSender = new EmailSender();
        $emailResult = $emailSender->sendVerificationEmail($_POST["email"], $_POST['username'], $_SESSION['otp']);

        echo '<script>alert("' . $emailResult . '")</script>';
        if ($emailResult === "Register Successfully, OTP sent to " . $_POST["email"]) {
            header('Location: verification.php');
        }
    } else {
        echo '<script>alert("' . $result . '")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login and signup Form</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <video autoplay muted loop id="myVideo">
        <source src="pexels_videos_2324166 (2160p).mp4" type="video/mp4">
      </video> 
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<body>
  <!-- <div class="error">
    <div class="lengthErr"><?php echo $lengthErr; ?></div>
  </div> -->
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="view-3d-woman-using-laptop.jpg" alt="">
  
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title" style="margin-left:16px;">Login</div>
          <form id="login_form" action="login.php" method="POST">
            <div class="input-boxes" style="margin-left:16px;">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
              </div>
              <div class="remember">
                <input type="checkbox"> Remember me
                <a href="forgot.php"><p>Forgot password?</p></a>
                
            </div>
              <div class="button input-box">
                <input type="submit" name="login" value="Login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form id="signup_form" name="signup_form" action="" method="POST">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="User Name" required>
              <div class="error"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Email Address" required>
                <div class="error"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Crete Password" required>
                <div class="error"></div>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                <div class="error"></div>
              </div>
              <div class="user-type">
                How do you want to join 
                <select name="user_type" class="select-type" required>
                    <option value="Freelancer">Freelancer</option>
                    <option value="Client">Client</option>
                 </select>
                 <div class="error"></div>
              </div>
              <div class="input-box">
                                      <label for="captcha" style="text-decoration:none; color:darkblue">Captcha</label>
                                      <input type="text" name="captcha" id="captcha" placeholder="Enter Captcha" style="width:35%; margin-left:10px" required class="captcha"/>
                                      <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">
                                    </div>
                                    <div class="captcha-code">
                                          <label for="captcha-code" style="text-decoration:none; color:darkblue; position:relative;bottom:-15px;">Captcha Code </label> 
                                          <div class="captcha" style="  background:url(https://www.codeproject.com/KB/scripting/CreateCaptcha/1.JPG); width:15% ; position:relative; left:130px;top:-7px;"><div class="print" style="color:black;margin-left:25px;"><?php echo $rand; ?></div></div>
                                         
                                    </div>
                                
              <div class="remember">
                <input type="checkbox" required> 
                I read carefully and accept all the<span><a href=""> terms & conditions </a> </span> of FreeLancia.
            </div>
              <div class="button input-box">
                <input type="submit" name="submit" value="Signup Now">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>

 <!-- <script>
const form = document.getElementById('signup_form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');
/*const usertype = document.getElementById('user_type');*/

form.addEventListener('submit',e => {
    e.preventDefault();

    validateInputs();
});
    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('submit');
    }
    const setSubmit = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = '';
        inputControl.classList.add('submit');
        inputControl.classList.remove('error');
    };
    const isValidEmail = email => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const cpasswordValue = cpassword.value.trim();
    /*const usertypeValue = usertype.value.trim();*/

    if(usernameValue === '') {
        setError(username, 'Username is required.');
    }else{
        setSubmit(username);
    }


    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSubmit(email);
    }

    if(passwordValue === '') {
        setError(password, 'Password is required');
    } else if (passwordValue.length < 8 ) {
        setError(password, 'Password must be at least 8 character.')
    } else {
        setSubmit(password);
    }


    if(cpasswordValue === '') {
        setError(cpassword, 'Please confirm your password');
    } else if (cpasswordValue !== passwordValue) {
        setError(cpassword, "Passwords doesn't match");
    } else {
        setSubmit(cpassword);
    }
};
    </script>
-->
</body>
</html>