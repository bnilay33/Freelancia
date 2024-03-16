<?php session_start() ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag -------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="verification.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



    
<style>
  body{
background-image:url(mountain.jpg);
background-repeat:no-repeat;
background-size: cover; 
}
.alert {
  background-color:red;
  width:30%;
  display: flex;
  align-items: center;
  justify-content: center;
margin-left:535px;
border: 1px solid red;
border-radius: 20px;
height:35px;

}
.alert-danger{
  color:#fff;

}
.otp-field {
  flex-direction: row;
  column-gap: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
#resend{
  color: blue;
  cursor: pointer;
background:#fff;
  font-size:12px;
  font-weight: 400;
  line-height: 30px;
  margin: 0 0 2em;
  max-width: 100px; 
  position: relative;
  text-decoration: none;
  border:1px solid #fff;
  border-radius: 35px;

  width: 100%;
}
.login-form{
  position: relative;
  top:90px;

}




.otp-field input {
  height: 45px;
  width: 50%;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.otp-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
  border: 1px solid;
}
.otp-field input::-webkit-inner-spin-button,
.otp-field input::-webkit-outer-spin-button {
  display: none;
}

.resend {
  font-size: 12px;
}
@media only screen and (max-width: 500px) {
    .card{
        
        margin-left:20px;
    }
}
@media only screen and (max-width: 450px) {
    .card{
        
        margin-left:70px;
    }
}
@media only screen and (max-width: 350px) {
    .card{
        
        margin-left:100px;
    }
}

</style>
    <title>Verification</title>



</head>
<body>
<!-- 
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Verification Account</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav> -->


<main class="login-form">
<div class="container-fluid bg-body-tertiary d-block">
  <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
        <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02) ; border:1px solid black;
  border-radius: 25px;  ">
        <div class="bord">
          <div class="card-body p-5 text-center">
            <h4>Verify</h4>
            <p>Your code was sent to you via Email</p>
          <form action="#" method="POST">
            <div class="otp-field mb-4">
              <input type="number" id="otp" class="form-control" name="otp_code" autofocus />
         
            
            </div>

            <input type="submit" class="btn btn-primary mb-3" name="verify">

            <p class="resend text-muted mb-0">
              Didn't receive code? <button  type="submit" name="resend" id="resend" disabled>Resend</button>
              <div class="otp" style="background:#e6e8e6  ; height:40px; border:1px solid #e6e8e6;
  border-radius: 20px;"><p style="color:red;font-size:13px; position:relative; top:10px">Your otp will expire with in one minute.</p></div>
            </p>
        </form>
          </div>
        </div>
      </div>
    </div>
</div>
</main>


</body>
<script>
function updatecount(min,sec){
  document.getElementById('resend').innerHTML="Resend("+min+":"+sec+")";
}
function showbutton(){
  document.getElementById('resend').innerHTML="Resend";
  var button=document.getElementById('resend');
  button.disabled=false;
}
var count=90;
var countInterval=setInterval(function(){
  var min=Math.floor(count/60);
  var sec=count%60;
  updatecount(min,sec);
  count--;

  if(count<0){
    clearInterval(countInterval);
    showbutton();
  }
},1000);
</script>
</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailVerification
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli("localhost","root", "", "freelanciaaa");
    }

    public function verify()
    {
        if (isset($_POST['verify'])) {
            $validTime = $_SESSION['otp_request_time'] + 90;
            $currentTime = time();

            if (isset($_POST['otp_code']) && isset($_SESSION['otp'])) {
                if (($validTime >= $currentTime) && ($_POST['otp_code'] == $_SESSION['otp'])) {
                    $verify = $_POST['verify'];

                    if ($verify) {
                        $username = $_SESSION['name'];
                        $email = $_SESSION['mail'];
                        $pwd = $_SESSION['password'];
                        $user_type = $_SESSION['user_type'];
                        $user = $this->getUserIdentifier($username, $user_type);

                        $mail = $this->initializeMailer();
                        $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
                        $mail->addAddress($_SESSION['mail'], $_SESSION['name']);
                        $mail->isHTML(true);
                        $mail->Subject = 'Registration Successful !';
                        $mail->Body = $this->getEmailBody($username);
                        $mail->AddEmbeddedImage(dirname(__FILE__) . '/freelancia.gif', 'freelancia');

                        if (!$mail->send()) {
                            echo "Successful but mail not sent!";
                        } else {
                            $hash = password_hash($pwd, PASSWORD_DEFAULT);
                            $insert = "INSERT INTO signup_table(username , email, password,user_type) VALUES ('$user', '$email', '$hash','$user_type')";
                            mysqli_query($this->connection, $insert);
                            $insert2 = "INSERT INTO company_profile_table(username ,Company_name, email,Address,phone,company_website) VALUES ('$user','', '$email','','','')";
                            mysqli_query($this->connection, $insert2);
                            ?>
                            <script>
                              alert("Registration Successfull!Create your profile and enjoy FreeLancia!");
                              document.location.href = 'signup.php';
                            </script>
                            <?php
                            exit();
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">FAILED TRY AGAIN!!</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">YOU ENTERED AN INVALID OTP !!</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">YOUR OTP HAS EXPIRED !!</div>';
            }
        }
    }

    public function resendOTP()
    {
        if (isset($_POST['resend'])) {
            $_SESSION['otp_request_time'] = $_SERVER['REQUEST_TIME'];
            $generated_otp = rand(100000, 999999);
            $_SESSION['otp'] = $generated_otp;

            $mail = $this->initializeMailer();
            $mail->setFrom('freelanciateam@gmail.com', 'FreeLancia');
            $mail->addAddress($_SESSION['mail']);
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = "YOUR OTP IS $generated_otp,<br>Your One-Time Password will expire within 1 min 30 sec.<br>Thank you for joining us.";

            if (!$mail->send()) {
                echo "Resend Failed";
            } else {
                echo "Resend Successfully";
            }
        }
    }

    private function initializeMailer()
    {
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

        return $mail;
    }

    private function getUserIdentifier($username, $user_type)
    {
        return ($user_type === 'Freelancer') ? "F_" . $username : "C_" . $username;
    }

    private function getEmailBody($username)
    {
        return "<div style='background:rgb(19,84,78);color:white;'><h2 style='margin-left:20px;color:#21FD16;'>Free<span style='color:white;'>Lancia</span><br><center><span style='color:white;'>Welcome to FreeLancia !</span></center></h2>
        <span style='background:black;color:white;'> Hi  $username,<br> 
        Thank you for registering yourself on FreeLancia.<br><br>
        Complete your profile to apply for projects.<br></span></div>
        <img src='cid:freelancia'>";
    }
}

$emailVerification = new EmailVerification();

if (isset($_POST['verify'])) {
    $emailVerification->verify();
}

if (isset($_POST['resend'])) {
    $emailVerification->resendOTP();
}
?>
