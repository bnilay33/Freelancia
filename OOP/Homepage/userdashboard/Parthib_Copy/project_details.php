<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="css/project_details.css">
    
    <script src="js/project_details.js"></script>
</head>

<body background="images/32993994_840843081452.jpg">
    <div class="container">
        <h1 class="logo" style="font-weight: bold;">FreeLancia</h1>
<?php
session_start();
@include_once 'config.php';
class viewpage{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn->getConnection();
    }
    public function getData($id) {
        // $id = $this->conn->real_escape_string($id);

        $nameQuery = "SELECT `Project_Name` FROM `job_post_table` WHERE `Postid`='$id'";
        $descriptionQuery = "SELECT `Project_description` FROM `job_post_table` WHERE `Postid`='$id'";
        $skillQuery="SELECT `skills` FROM `job_post_table` WHERE `Postid`='$id'";
        $companyQuery="SELECT `Company_Name` FROM `job_post_table` WHERE `Postid`='$id'";
        $nameResult = $this->conn->query($nameQuery);
        $descriptionResult = $this->conn->query($descriptionQuery);
        $skillResult=$this->conn->query($skillQuery);
        $companyResult=$this->conn->query($companyQuery);
        if (!$nameResult || !$descriptionResult) {
            die("Query Failed: " . $this->conn->error);
        }

        if ($nameResult->num_rows > 0 && $descriptionResult->num_rows > 0) {
            $row1 = $nameResult->fetch_assoc();
            $row2 = $descriptionResult->fetch_assoc();
            $row3 = $skillResult->fetch_assoc();
            $row4 = $companyResult->fetch_assoc();
            $_SESSION['projectName']=$row1['Project_Name'];
            $_SESSION['companyName']=$row4['Company_Name'];
            echo '<div class="para">
            <h1>'. $row1['Project_Name'] .'</h1>
            <img src="images/templete.png" alt="">
            <p>'. $row2['Project_description'] .'</p>
            <P>Skills:  '. $row3['skills'].'</P>
            <p>Deadline Date: 10/11/2023</p>';
        } else {
            return null;
        }
    }
}

$dbConnection = new viewpage($db);

// Assuming you have the session variable set earlier
if(isset($_SESSION['action'])){
$Id = $_SESSION['action'];
}
$data = $dbConnection->getData($Id);

?>
            
        <div class="btn">
             <button class="open-button">Apply</button>
            <a href="user_find_job.php"><button class="open-button">Back</button></a>
        </div>
    </div>
    <!-- The form 
<div class="form-popup" id="myForm">
    <form action="/action_page.php" class="form-container">
      <h1>FreeLancia</h1>
  
      <label for="bid" class="bid"><b>Bid</b></label>
      <input type="text" placeholder="Place your bid..." name="number" required style="border-radius: 15px; border: 1px solid #000;" >
  
      
  
      <a href="apply_job.html"><button type="submit" class="btn">Bid</button></a>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>-->

    <div class="center modal-box">
        <div class="fas fa-times"></div>
        <div class="icon1">
            <img src="images/IMG_20230901_171316-removebg-preview (1).png" style="height: 100px; text-align: center; " alt="">
        </div>
        <header style="font-family: sans-serif; font-weight: bold; text-shadow: 2px 2px 5px rgb(150, 143, 143); color: #21fd16; font-size: 40px;">Free<span style="color: white;">Lancia</span></header>
        
        <form action="" method="post">
            <span class="material-symbols-outlined icon2">
                gavel
                </span>
            <input type="number" name="bid" style="border-radius: 20px;" required placeholder="Place your bid...">
            <button name="applybid">Apply</button>
            <button class="closeForm" style="background-color: red;">Close</button>
        </form>
    </div>
    <?php
    // session_start();
    @include_once 'config.php';
    class Bidding{
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn->getConnection();
        }
        public function insertBid($username,$name,$project,$company,$estimatedCharge){
            $sql8="INSERT INTO `application_table` (`aid`, `username`, `Applicant_name`, `Project_Name`, `Company_Name`, `Estimated_Charge`, `Project_status`, `dt`) VALUES (NULL, '$username', '$name', '$project', '$company', $estimatedCharge, '', current_timestamp());";
            $result=$this->conn->query($sql8);
            if($result){
                return 1;
            }else{
                return 0;
            }
        
        }
        public function queryProcess($sql){
            $result1=$this->conn->query($sql);
            if($result1){
                $row6=$result1->fetch_assoc();
            }
            return $row6;
        }
    }

    $bidding=new Bidding($db);
    $Project_name=$_SESSION['projectName'];
    $Company_name=$_SESSION['companyName'];
    $email=$_SESSION['email'];
    $sql19="SELECT `username` FROM `signup_table` WHERE `email`='$email';";
    $result19=$bidding->queryProcess($sql19);
    $Username=$result19['username'];
    $sql20="SELECT `Name` FROM `user_profile_table` WHERE `username`='$Username';";
    $result20=$bidding->queryProcess($sql20);
    $name=$result20['Name'];
    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['applybid'])){
        if(isset($_POST['bid'])){
            $bid=$_POST['bid'];
            $success=$bidding->insertBid($Username,$name,$Project_name,$Company_name,$bid);
            if($success===1){
                echo "<script>alert('Your Estimated Charge is Successfully Bidded');</script>";
            }
        }
    }

    ?>

</body>

</html>



<!-- INSERT INTO `application_table` (`aid`, `username`, `Applicant_name`, `Project_Name`, `Company_Name`, `Estimated_Charge`, `Project_status`, `dt`) VALUES ('1', 'F_Lucifer69', 'Raj Pal', 'Django Project', 'Microsoft', '573.68', '', current_timestamp()); -->