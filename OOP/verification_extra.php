<?php session_start() ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Verification</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Verification Account</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verification Account</div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">OTP Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="otp" class="form-control" name="otp_code" required autofocus>
                                </div>
                                <p style="color:red;">*Your otp will expire in one minute after it will be sent  to your email.</p>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Verify OTP" name="verify">
                            </div>
                            <input type="submit" name="resend" value="Resend OTP" >

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>
<?php 
    @include 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['verify'])){
    
    $validTime=$_SESSION['otp_request_time']+90;
    $currentTime=time();
    if(isset($_POST['otp_code']) && isset($_SESSION['otp'])){
    if(($validTime >= $currentTime) && ($_POST['otp_code'] == $_SESSION['otp'])){
        $verify = $_POST['verify'];
        if($verify){
        $username = $_SESSION['name'];
        $email = $_SESSION['mail'];
        $pwd = $_SESSION['password'];
        $user_type = $_SESSION['user_type'];
        if($user_type === 'Freelancer'){
            $user = "F_" .$username;
             }
        else{
            $user = "C_" .$username;
            }

        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'freelanciateam@gmail.com';
        $mail->Password = 'avfyxkmiibfdbzjg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('freelanciateam@gmail.com','FreeLancia');
        $mail->addAddress($_SESSION['mail'],$_SESSION['name']);
        $mail->isHTML(true); 
        $mail->Subject = 'Registration Successfull !';
        $mail->Body =  "<div style='background:rgb(19,84,78);color:white;'><h2 style='margin-left:20px;color:#21FD16;'>Free<span style='color:white;'>Lancia</span><br><center><span style='color:white;'>Welcome to FreeLancia !</span></center></h2>
        <span style='background:black;color:white;'> Hi  $username,<br> 
        Thank you for register yourself in FreeLancia.<br><br>
        Complete your profile to apply on projects.<br></span></div>
        <img src='cid:freelancia'>";
        $mail->AddEmbeddedImage(dirname(__FILE__) . '/freelancia.gif','freelancia');
        if(!$mail->send()){
            echo "Successful but mail not sent!";
        }else{
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $insert = "INSERT INTO signup_table(username, email, password,user_type) VALUES ('$user', '$email', '$hash','$user_type')";
            mysqli_query($connection, $insert);
            header('Location:home.html');
            exit();
        }
        }
        else{
          echo "FAILED TRY AGAIN.";
        }
    }else{
        echo "Invalid otp";
    }
    }
    else{
        echo "OTP EXPIRED.";
    }
    }else{
        echo "not verify";
    }
?>