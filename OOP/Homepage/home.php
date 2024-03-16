<?php
session_start();
@include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = $_SESSION['user_email'];

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: signup.php");
    exit();
}

    
$query = "SELECT user_type FROM signup_table WHERE email = '$mail'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Assign values to separate variables
        $Usertype = $row['user_type'];

        if (isset($_POST['dashboard'])) {

            // Redirect to different dashboards based on user type
            if ($Usertype == 'Freelancer') {
                header("Location: userdashboard/dash.php");
                exit();
            } elseif ($Usertype == 'Client') {
                header("Location: company/dash.php");
                exit();
            }
        }

    }
}
    // Check if the dashboard button is clicked
   
    
   if(isset($_POST['submit'])){
    $name = $_POST['FullName'];
    $usertype = $_POST['Usertype'];
    $email = $_POST['Email'];
    $Subject = $_POST['Subject'];
    $question = $_POST['question'];
    $maill = 'contactfreelancia@gmail.com';

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
     $mail->addAddress($email,$maill);
     $mail->isHTML(true);
     $mail->Subject = 'Contact Form';
      
     $mail->Body = "Thank you for contacting.<br><br>Full Name - $name <br> Usertype - $usertype <br> Email - $email <br> Phone Number - $phone <br> Query - $question ";
     if (!$mail->send()) {
         echo "Successful but email not sent!";
     } else {          
       echo "Thanks for Contact Us.We are back to you soon.";
     }
   }
  $connection->close();

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <title>home page</title>
    <link rel="stylesheet" href="home.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    

  </head>
  <body>
    <!-- Move to up button -->
    <div class="container-fluid">
    <!-- navgaition menu -->
    <nav>
      <div class="navbar">
        <div class="logo"><a href="#"><h4>Free<span>Lancia</h4></span></a></div>
        <ul class="menu">
          <li><a href="#home">Home</a></li>
          <li><a href="#services">Services</a></li>
          
          <li><a href="#team">Team</a></li>
          <li><a href="#about">About</a></li>

          <li><a href="#contact">Contact Us</a></li>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <button class="button-dashboard" type="submit" name="dashboard" style="width:110px; height:30px; border:1px solid #fff; border-radius:12px; background:transparent; color:#fff">Dashboard</button>
          </form>
          <div class="cancel-btn">
            <i class="img"><img src="icons8-cross-23.png" alt=""></i>
          </div>
        </ul>
        
      </div>
      <div class="menu-btn">
      <i class="img"><img src="icons8-menu-27.png" alt=""></i>
      </div>
    </nav>
    
<div class="hm">
    <section class="home" id="home">
      <div class="home-content">
       <div class="lek">
          <div class="text">
            <div class="text-one">Empower your dreams <span>, Hire the best!<br>Discover your perfect match </span>on our Freelancing Platform.<br>Join now...</div>
            <div class="text-two"><h2>FreeLancia</h2></div>
          </div>
          <div class="media-icons">
            <a href="https://www.facebook.com/profile.php?id=61551897375261&mibextid=2JQ9oc"><i class='bx bxl-facebook' ></i></a>
            <a href="#"><i class='bx bxl-instagram' ></i></a>
            <a href="#"><i class='bx bxl-github' ></i></a>
            <a href="https://www.linkedin.com/in/free-lancia-8aa144295?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class='bx bxl-linkedin' ></i></a>
        </div>
      </div>

    
        <div class="cn">
          <img src="hero.png" alt="heroImg" class="home_img" />
        </div>
      </div>

      
 
    </section>

  </div>
    <!-- Hero End-->
  



    <!-- My Services Section Start -->
    <section class="services" id="services">
      <div class="content">
        <div class="title"><span>Our Services</span></div>
        <div class="boxes">
          <div class="box">
            <div class="icon">
        <i class="img"><img src="job-seeking_6214024.png" alt=""></i>
            </div>
            <div class="topic">Find Your Job</div>
            <p>You can find your job in our plartform as a Freelancer.</p>
          </div>
          <div class="box">
            <div class="icon">
              <i class="img"><img src="journalist_3890752.png" alt=""></i>
            </div>
            <div class="topic">Post Your Job</div>
            <p>You can Post your job in our plartform as a Client.</p>
          </div>
          <div class="box">
            <div class="icon">
              <i class="img"><img src="customer-service_3956610.png" alt=""></i>
            </div>
            <div class="topic">Headache Free Service</div>
            <p> You will get 24/7 support</p>
          </div>
        </div>
      </div>
      
    </section>
    <!--team-->
    
    <div class="block outer-container" id ="team">
      <div class="block inner-container">
        <div class="block wk-tab-12 wk-mobile-12 wk-desk-4 wk-ipadp-4 headings-container">
          <p class="text-blk heading-text">
            Meet Our Team
          </p>
        </div>
        <div class="block wk-desk-8 wk-ipadp-8 wk-tab-12 wk-mobile-12 team-members-container">
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="raj.jpg">
              <p class="text-blk name">
                Raj Nath
              </p>
              <p class="text-blk position">
               
              </p>
            </div>
          </div>
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="nilay2.jpeg">
              <p class="text-blk name">
               Nilay Bhattacharjee
              </p>
              <p class="text-blk position">
            
              </p>
            </div>
          </div>
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="kola.jpg">
              <p class="text-blk name">
            Sagar Das
              </p>
              <p class="text-blk position">
               
              </p>
            </div>
          </div>
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="pal.png">
              <p class="text-blk name">
               Raj Pal
              </p>
              <p class="text-blk position">
               
              </p>
            </div>
          </div>
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="parthib.jpg">
              <p class="text-blk name">
                Parthib Mondal
              </p>
              <p class="text-blk position">
               
              </p>
            </div>
          </div>
          <div class="block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 card-container">
            <div class="card">
              <img class="card-img" src="rahul.png">
              <p class="text-blk name">
           Rahul Ghosh
              </p>
              <p class="text-blk position">
               
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- About Section Start -->
    <div class="responsive-container-block bigContainer" id ="about">
      <div class="responsive-container-block Container bottomContainer">
        <div class="ultimateImg">
          <video autoplay muted loop id="mainImg">
            <source src="WhatsApp Video 2023-08-20 at 10.05.06 PM.mp4" type="video/mp4">
          </video>
        </div>
        <div class="allText bottomText">
          <p class="text-blk headingText">
           <span>About Us</span> 
          </p>
          <p class="text-blk subHeadingText">
            Free<span>Lancia</span>
          </p>
          <p class="text-blk description">
            A Freelancing Software connect individuals or businesses seeking services with skilled freelancers. These platforms facilitate a range of work, from writing and design to coding and marketing. Popular sites include Upwork, Freelancer, and Fiverr, where freelancers create profiles showcasing their expertise and clients post project listings. Freelancers bid on projects, negotiate terms, and deliver completed work through FreeLancia. These platforms offer flexibility and access to a global talent pool, benefiting both freelancers looking for projects and clients in need of specialized skills on a project basis. Ratings and reviews help maintain quality and trust within the FreeLancia community.
          </p>
        </div>


      </div>
    </div>
    <div class="tm">
    <img class="team-img" src="rmh.png">
  </div>
<!--contact-->
    <section class="contact" id="contact">
      <div class="content">
        <div class="title"><span>Contact Us</span></div>
        <div class="text">
          <div class="topic">Have Any Quary?</div>
          
          
        </div>
      </div>
    </section>
    <!-- Contact Us section Start -->
    <div class="contact_us_2">
          <form class="form-box">
            <div class="container-block form-wrapper">
              <p class="text-blk contactus-head">
                Get in Touch
              </p>
              <p class="text-blk contactus-subhead">
          
              </p>
              <div class="responsive-container-block">
                <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6" id="i10mt">
                  <p class="text-blk input-title">
                FULL NAME
                  </p>
                  <input class="input" id="ijowk" name="FullName" placeholder="Please enter full name">
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                  <p class="text-blk input-title">
              USERTYPE
                  </p>
                  <input class="input" id="indfi" name="Usertype" placeholder="FREELANCER / CLIENT">
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                  <p class="text-blk input-title">
                    EMAIL
                  </p>
                  <input class="input" id="ipmgh" name="Email" placeholder="Please enter email">
                </div>
                <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                  <p class="text-blk input-title">
                   SUBJECT
                  </p>
                  <input class="input" id="imgis" name="Subject" placeholder="Please enter Subject">
                </div>
                <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i634i">
                  <p class="text-blk input-title">
                    WHAT DO YOU HAVE IN MIND
                  </p>
                  <textarea class="textinput" id="i5vyy" name="question" placeholder="Please enter query..."></textarea>
                </div>
              </div>
              <input type="submit" name="submit" class="submit-btn" value="Submit">
            </div>
          
          </form>
        </div>
      </div>
    </div>
    <!-- Footer Section Start -->
    <footer>
        <div class="container">
            <div class="row">
                  <div class="col" id="company">
                      <img src="logo.png" alt="" class="logo">
                      <p>
                        FreeLancia<br> Freelancia Software connect individuals or businesses seeking services with skilled freelancers.
                      </p>
                      <div class="social">
                        <a href="https://www.facebook.com/profile.php?id=61551897375261&mibextid=2JQ9oc"><i class="img" > <img src="fb3.png" alt=""></i></a>

                        <a href="#"><i class="img"><img src="git.png" alt=""></i></a>
                        <a href="https://www.linkedin.com/in/free-lancia-8aa144295?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="img"><img src="linkedin_145807.png" alt=""></i></a>
                        <a href="#"><i class="img"><img src="pinterest_3670052.png" alt=""></i></a>
                      </div>
                  </div>


                  <div class="col" id="services">
                     <h3>Services</h3>
                     <div class="links">
                        <a href="#services">Job Post</a>
                        <a href="#services">Find Job</a>
                        <a href="#services">Headache Free</a>
                        <a href="#">Live Support</a>
        
                     </div>
                  </div>

                  <div class="col" id="useful-links">
                     <h3>Links</h3>
                     <div class="links">
                        
                        <a href="#home">Home</a>
                        <a href="PrivacyPolicy/Privacy.html">Privacy Policy</a>
                        <a href="#">Refund Policy</a>
                        <a href="Terms&Condition/terms.html">Terms & Conditions</a>
                     </div>
                  </div>

                  <div class="col" id="contact">
                      <h3>Contact</h3>
                      <div class="contact-details">
                         <i class="fa fa-location"></i>
                         <p>Hooghly,West Bengal<br> India</p>
                      </div>
                      <div class="contact-details">
                       
                    <p>Email: contactfreelancia@gmail.com</p>
                      </div>
                  </div>
            </div>

          
            </div>

        </div>
     </footer>
    </div>
   
  </div> 
    <script src="home.js"></script>
  </body>
</html>
