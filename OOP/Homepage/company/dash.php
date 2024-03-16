<?php
    session_start();
@include 'config.php';

     $mail = $_SESSION['user_email'];
    //  $jobPost =  $_SESSION['job_post'];
    $query = "SELECT username,Company_name from company_profile_table WHERE email= '$mail' ";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //assign value to separate variable
            $Username = $row['username'];
            $name = $row['Company_name'];
          // Query to get the total job posts for the user
          $query1 = "SELECT COUNT(*) as totalJobPosts FROM job_post_table WHERE username= '$Username' AND Company_name = '$name'";
          $result2 = mysqli_query($connection, $query1);

      if ($result2 && mysqli_num_rows($result2) > 0) {
      $row1 = mysqli_fetch_assoc($result2);
      $totalJobPosts = $row1['totalJobPosts'];
      } else {
        $totalJobPosts = 0;
        }   
        }
    }

    $sql32 = "SELECT ap.Company_name,ap.Project_status FROM application_table ap
    INNER JOIN company_profile_table cp ON cp.Company_name = ap.Company_name WHERE email = '$mail'";
    $show = mysqli_query($connection, $sql32);

    if ($show && mysqli_num_rows($show) > 0) {
        while ($row2 = mysqli_fetch_assoc($show)) {
            //assign value to separate variable
            // $User = $row2['username'];
            // $Applicant_name = $row2['Applicant_name'];
            // $Project_Name = $row2['Project_Name'];
            $Name = $row2['Company_name'];
            // $Estimated_Charge = $row2['Estimated_Charge'];
            $Project_status = $row2['Project_status'];

          $query3 = "SELECT COUNT(*) as totalCandidateHired FROM application_table WHERE Company_name = '$name' AND Project_status='$Project_status'";
          $result4 = mysqli_query($connection, $query3);

          if ($result4 && mysqli_num_rows($result4) > 0) {
          $row3 = mysqli_fetch_assoc($result4);
          $totalCandidateHired = $row3['totalCandidateHired'];
          } else {
            $totalCandidateHired = 0;
            }  
          }
        } 

          $query4 = "SELECT COUNT(*) as totalAppliedCandidate FROM application_table WHERE Company_name = '$Name'";
          $result5 = mysqli_query($connection, $query4);

          if ($result5 && mysqli_num_rows($result5) > 0) {
          $row4 = mysqli_fetch_assoc($result5);
          $totalAppliedCandidate = $row4['totalAppliedCandidate'];
          } else {
            $totalAppliedCandidate = 0;
            }   
      
?>



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
      href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@200;400;500;700&display=swap"
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
   <!----======== nav ======== -->
    <nav>
        <div class="logo-name">
          

            <span class="logo_name"><?php echo $name; ?>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="profile/Company_Profile.php">
                    <i class="uil uil-user-circle"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <li><a href="my_project/job.php">
                    <i class="uil uil-tag-alt"></i>
                    <span class="link-name">My Projects</span>
                </a></li>
             
                <li><a href="JobPost/index.php">
                    <i class="uil uil-pen"></i>
                    <span class="link-name">Post Project</span>
                </a></li>

                <li><a href="subcription/subcription.php">
                  <i class="uil uil-rupee-sign"></i>
                  <span class="link-name">Subcription</span>
              </a></li>
            
                <li><a href="approve/Approve.php">
                    <i class="uil uil-check-circle"></i>
                    <span class="link-name">Approved</span>
                </a></li>

                <li><a href="All Applicant/All_applicant.php">
                  <i class="uil uil-package"></i>
                  <span class="link-name">All Applicant's</span>
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
            <!-- <div class="search-box">
                
                <input type="button" value="Post Project" id="btn-apply" />
                

            </div> -->
           
            <img class="dashboard-profile-image" src="default-profile-image.jpg" alt="Profile Image">

        </div>
<!----======== applications statistics ======== -->
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart"></i>
                    <span class="text">Applications Statistics</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-pen"></i>
                        <span class="text">My Jobs</span>
                        <span class="number"><?php echo $totalJobPosts; ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Candidate Hired</span>
                        <span class="number"><?php echo $totalCandidateHired; ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-bookmark"></i>
                        <span class="text">Applied Candidate</span>
                        <span class="number"><?php echo $totalAppliedCandidate; ?></span>
                    </div>
                </div>
            </div>
<!----======== recent applications======== -->
            <!-- <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Applications</span>
                </div>
                <div class="container">
                  
                    <ul class="responsive-table">
                      
                      <li class="table-header">
                        <div class="col col-1">Candidate Name</div>
                        <div class="col col-2">Work</div>
                        <div class="col col-3">Applied Date</div>

                        <div class="col col-4">Action</div>
                      </li>
                   
                      <li class="table-row">
                        <div class="col col-1" data-label="Candidate Name"><a href="">Sagar Das</a></div>
                        <div class="col col-2" data-label="Work"><a href="">Data Entry</a></div>
                        <div class="col col-3" data-label="Applied Date">DD / MM / YY</div>
                        
                        <div class="col col-4" data-label="Action"><i class="fa-solid fa-plus-square"  style="font-size: 20px; color: blue; cursor: pointer; "></i><i class="fa-solid fa-check-square" style="font-size: 20px; color: #21fd16 ; margin-left: 15px; cursor: pointer;"></i><i class="fa-solid fa-xmark-square " style="font-size: 20px; color: red; padding: 0px 15px; cursor: pointer;"></i></div>
                      </li>
                      <li class="table-row">
                        <div class="col col-1" data-label="Candidate Name"><a href="">Sagar Das</a></div>
                        <div class="col col-2" data-label="Work"><a href="">Data Entry</a></div>
                        <div class="col col-3" data-label="Applied Date">DD / MM / YY</div>
                        
                        <div class="col col-4" data-label="Action"><i class="fa-solid fa-plus-square"  style="font-size: 20px; color: blue; cursor: pointer; "></i><i class="fa-solid fa-check-square" style="font-size: 20px; color: #21fd16 ; margin-left: 15px; cursor: pointer;"></i><i class="fa-solid fa-xmark-square " style="font-size: 20px; color: red; padding: 0px 15px; cursor: pointer;"></i></div>
                      </li>
                      <li class="table-row">
                        <div class="col col-1" data-label="Candidate Name"><a href="">Sagar Das</a></div>
                        <div class="col col-2" data-label="Work"><a href="">Data Entry</a></div>
                        <div class="col col-3" data-label="Applied Date">DD / MM / YY</div>
                        
                        <div class="col col-4" data-label="Action"><i class="fa-solid fa-plus-square"  style="font-size: 20px; color: blue; cursor: pointer; "></i><i class="fa-solid fa-check-square" style="font-size: 20px; color: #21fd16 ; margin-left: 15px; cursor: pointer;"></i><i class="fa-solid fa-xmark-square " style="font-size: 20px; color: red; padding: 0px 15px; cursor: pointer;"></i></div>
                      </li>
                      <li class="table-row">
                        <div class="col col-1" data-label="Candidate Name"><a href="">Sagar Das</a></div>
                        <div class="col col-2" data-label="Work"><a href="">Data Entry</a></div>
                        <div class="col col-3" data-label="Applied Date">DD / MM / YY</div>
                        
                        <div class="col col-4" data-label="Action"><i class="fa-solid fa-plus-square"  style="font-size: 20px; color: blue; cursor: pointer; "></i><i class="fa-solid fa-check-square" style="font-size: 20px; color: #21fd16 ; margin-left: 15px; cursor: pointer;"></i><i class="fa-solid fa-xmark-square " style="font-size: 20px; color: red; padding: 0px 15px; cursor: pointer;"></i></div>
                      </li>
                      
                    </ul>
                  </div>
            </div>
        </div>
    </section> -->

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
                  
                    <div class="delet-confirm-wrapper">
                      <button class="btn btn-confirm" onclick="confirmLogout()">
                        <i class="fa-solid fa-sad-tear"></i>
                  Confirm
                      </button>
                    </div>
                    <div class="btn-container">
                        <div class="cancel-wrapper">
                          <button class="btn btn-cancel" onclick="cancelLogout()">
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
            $deleteQuery="DELETE FROM signup_table WHERE signup_table.email='$mail';";
            $deleteResult=$connection->query($deleteQuery);
            if($deleteResult){
              echo "<script>alert('Profile Deleted Successfully!!!');</script>";
              echo "<script>window.location.replace('../../signup.php');</script>";
              
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if there is a selected photo in localStorage
    const storedPhotoUrl = localStorage.getItem('selectedPhoto');

    if (storedPhotoUrl) {
        // Update the profile image in the dashboard
        document.querySelector('.dashboard-profile-image').src = storedPhotoUrl;
    }
});

//logout js
function confirmLogout() {
  // Add your logout logic here
  // For example, redirect to the PHP script that handles logout
  window.location.href = "logout.php";
}

function cancelLogout() {
  // Add any specific behavior for canceling logout
  // For example, close the modal
  document.getElementById('myModal').style.display = 'none';
}


</script>

</body>
</html>