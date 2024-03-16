<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="dash.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <title>Dashboard </title>
</head>
<body>
    <!--======== Php Portion======== -->
    <?php
        session_start();
        @include_once 'config.php';
        class DashBoard{
            private $conn;
            public function __construct($conn) {
                $this->conn =$conn->getConnection();
            }
            public function UsernameProcess($sql){
                $result1=$this->conn->query($sql);
                if($result1){
                    $row6=$result1->fetch_assoc();
                }
                return $row6;
            }
            public function queryProcess($sql){
              $result2=$this->conn->query($sql);
              $reviews=array();
              if($result2){
                  while($row9=$result2->fetch_assoc()){
                      $reviews[]=$row9;
                  }
              }
              return $reviews;
          }
          public function executeQuery($sql){
            return $this->conn->query($sql);
          }
        }
        $dashboard=new DashBoard($db);

        $email=$_SESSION['email'];
        $sql19="SELECT `username` FROM `signup_table` WHERE `email`='$email';";
        $result19=$dashboard->UsernameProcess($sql19);
        $Username=$result19['username'];

        $appliedQuery="SELECT COUNT(*) AS row_count FROM `application_table` WHERE `username`='$Username';";
        $appliedResult=$dashboard->UsernameProcess($appliedQuery);
        $reviewQuery="SELECT count(*) AS review_count FROM `review_table` WHERE `username`='$Username';";
        $reviewResult=$dashboard->UsernameProcess($reviewQuery);
        $approvedQuery="SELECT COUNT(*) AS approved_count FROM `application_table` WHERE `username`='$Username' AND `Project_status`='Approved';";
        $approvedResult=$dashboard->UsernameProcess($approvedQuery);
        
        $projectQuery="SELECT `Project_Name` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC LIMIT 3;";
        $projectResult=$dashboard->queryProcess($projectQuery);
        $companyQuery="SELECT `Company_Name` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC LIMIT 3;";
        $companyResult=$dashboard->queryProcess($companyQuery);
        $Project_status="SELECT `Project_status` FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC LIMIT 3;";
        $statusResult=$dashboard->queryProcess($Project_status);
        $dateQuery="SELECT DATE(`dt`) AS date_only FROM `application_table` WHERE `username`='$Username' ORDER BY `dt` DESC LIMIT 3;";
        $dateResult=$dashboard->queryProcess($dateQuery);
    ?>
   <!----======== nav ======== -->
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <img src="logo.png" alt="">
            </div>

            <span class="logo_name">Free<span>Lancia</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="profile_Udashboard/Profile.php">
                    <i class="uil uil-user-circle"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <li><a href="application_Udashboard/all_application.php">
                    <i class="uil uil-tag-alt"></i>
                    <span class="link-name">All Applications</span>
                </a></li>
                <li><a href="Parthib_Copy/user_find_job.php">
                    <i class="uil uil-atom"></i>
                    <span class="link-name">Apply Job</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Reviews</span>
                </a></li>
                <li><a href="Parthib_Copy/shortlist.php">
                    <i class="uil uil-bookmark-full"></i>
                    <span class="link-name">Shortlisted</span>
                </a></li>
           
             
            
            <ul class="logout-mode">
              <li class="dlt"><a href="#" id="dl">
                <i class="uil uil-trash-alt"></i>
                <span class="link-name">Delete Profile</span>
            </a></li>
                <li><a href="#" id="lg">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

         
            </ul>
        </div>
    </nav>
<!----======== dashboard ======== -->
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!----======== aspply btn======== -->
            <div class="search-box">
                
                <input type="button" value="Apply Job" id="btn-apply" />
                

            </div>
           
            <img src="https://pbs.twimg.com/media/FetBNVcXEAERu3y?format=jpg&name=large" alt="">
        </div>
<!----======== applications statistics ======== -->
<?php

      echo'  <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart"></i>
                    <span class="text">Applications Statistics</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-paperclip"></i>
                        <span class="text">Applications</span>
                        <span class="number">'. $appliedResult['row_count'] .'</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Reviews</span>
                        <span class="number">'. $reviewResult['review_count'] .'</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-bookmark"></i>
                        <span class="text">Approved</span>
                        <span class="number">'. $approvedResult['approved_count'] .'</span>
                    </div>
                </div>
            </div>';
?>
<!----======== recent applications======== -->

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Applications</span>
                </div>
                <div class="container">
                  
                    <ul class="responsive-table">
                      
                      <li class="table-header">
                        <div class="col col-3">Company Name</div>
                        <div class="col col-3">Work</div>
                        <div class="col col-3">Applied Date</div>
                        <div class="col col-4">Application Status</div>
                      </li>
                    <?php
                    foreach (array_map(null,$companyResult,$projectResult,$dateResult,$statusResult) as [$item1,$item2,$item3,$item4]){
                      if($item4['Project_status']==""){
                        $status="Pending";
                      }else if($item4['Project_status']=="Approved"){
                        $status="Approved";
                      }
                      echo'  <li class="table-row">
                        <div class="col col-3" data-label="Company Name">'. $item1['Company_Name'] .'</div>
                        <div class="col col-3" data-label="Work">'. $item2['Project_Name'] .'</div>
                        <div class="col col-3" data-label="Applied Date">'. $item3['date_only'] .'</div>
                        <div class="col col-4" data-label="Application Status">'. $status .'</div>
                      </li>';
                    }
                    ?>
                    </ul>
                  </div>
            </div>
        </div>

    </section>

    <!----======== popup ======== -->
    <div class="container">
      
        
          <!-- logout -->
          <div class="modal-container" id="myModal">
            <div class="modal-wrapper">
              <div class="modal">
                <header>
                  <h2>Logout</h2>
                </header>
                <main>
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-circle-exclamation fa-bounce" style="font-size: 25px;"></i>
                  </div>
                  <div class="text-wrapper">
                    <span>Are You Want To Sure Logout</span>
                  </div>
                </main>
                <footer>
                <?php
          if(isset($_POST['logout'])){
              echo "<script>window.location.replace('../../../signup.php');</script>";
            }
          ?>
                    <div class="delet-confirm-wrapper">
                    <form method="post"> 
                      <button class="btn btn-confirm" name="logout">
                        <i class="fa-solid fa-sad-tear"></i>
                  Confirm
                      </button>
                    </form>
                    </div>
                    <div class="btn-container">
                        <div class="cancel-wrapper">
                          <button class="btn btn-cancel">
                            <i class="fa-solid fa-smile"></i>
                            Cancel
                        </button>
                        </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>

          <!-- delete profile -->
          <?php
          if(isset($_POST['confrim'])){
            $deleteQuery="DELETE FROM `signup_table` WHERE `signup_table`.`username`='$Username';";
            $deleteResult=$dashboard->executeQuery($deleteQuery);
            if($deleteResult){
              echo "<script>alert('Profile Deleted Successfully!!!');</script>";
              echo "<script>window.location.replace('../../../signup.php');</script>";
              
            }
          }
          ?>
          <div class="modal-container1" id="myModal1">
            <div class="modal-wrapper1">
              <div class="modal1">
                <header>
                  <h2>Delete Profile</h2>
                </header>
                <main>
                  <div class="icon-wrapper1">
                    <i class="fa-solid fa-trash fa-bounce" style="font-size: 25px;"></i>
                  </div>
                  <div class="text-wrapper1">
                    <span style="color: white;">Are You Want To Delete Profile</span>
                  </div>
                </main>
                <footer>
                  
                    <div class="delet-confirm-wrapper1">
                      <!-- joined portion -->
                      <form method="post"> 
                      <button class="btn1 btn-confirm1" name="confrim">
                        <i class="fa-solid fa-sad-tear"></i>
                  Confirm
                      </button>
                      </form>
                    </div>
                    <div class="btn-container1">
                        <div class="cancel-wrapper1">
                          <button class="btn1 btn-cancel1">
                            <i class="fa-solid fa-smile"></i>
                            Cancel
                        </button>
                        </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>


          
        </div>        
<script src="dash.js"></script>
</body>
</html>
