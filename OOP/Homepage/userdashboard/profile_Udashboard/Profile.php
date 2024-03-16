<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Glass morphism Profile Card</title>
    <link rel="stylesheet" href="Profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    
    <script src="Profile.js"></script>
</head>

<body>
    <?php
    session_start();
    @include_once 'config.php';
    class UserProfile{
        private $conn;
        public function __construct($conn) {
            $this->conn =$conn->getConnection();
        }
        public function queryProcess($sql){
            $result1=$this->conn->query($sql);
            if($result1){
                $row6=$result1->fetch_assoc();
            }
            return $row6;
        }
        public function photoProcess($sql){
            $photoResult=$this->conn->query($sql);
            if($photoResult){
                $photorow=$photoResult->fetch_assoc();
                $photoData=base64_encode($photorow['user_photo']);
            }
            return $photoData;
        }
        public function UpdateProcess($sql){
            $updateResult=$this->conn->query($sql);
        }
    }
    $userprofile= new UserProfile($db);
    
    $email=$_SESSION['email'];
    $sql15="SELECT `username` FROM `signup_table` WHERE `email`='$email';";
    $result15=$userprofile->queryProcess($sql15);
    $Username=$result15['username'];
    // $username=$_SESSION['username'];
    // $email=$_SESSION['email'];


    $sql10="SELECT `Name`,`specialization`,`phone`,`address`,`10th_result`,`12th_result`,`ug`,`pg`,`skills`,`experience` FROM `user_profile_table` WHERE `username`='$Username';";
    $Result10=$userprofile->queryProcess($sql10);
    $userphotoSql="SELECT `user_photo`  FROM `user_profile_table` WHERE `username`='F_Raj69';";
    $userphotoresult=$userprofile->photoProcess($userphotoSql);
    $imageType='image/jpeg';
    // echo result
    echo '    <section>
    <div class="card1">
        <div class="card">
            <div class="left-container">
                <a href="#"><i class="fa-regular fa-pen-to-square edit"></i></a>
                
                <img src="data:' . $imageType . ';base64,' . $userphotoresult . '"/>
                <a href="#"><i class="fa-solid fa-camera"></i></a>
                <h2 class="gradienttext">'. $Result10['Name'] .'</h2>
                <p class="kind" style="margin-left: -35px; color: bisque;">'. $Result10['specialization'] .'</p>
            </div>
            <div class="right-container">
                <h3 class="gradienttext1">Freelancer Profile Details</h3>
                <table>
                    <tr>
                        <td class="comp">Email :</td>
                        <td class="comp">'. $email .'</td>
                    </tr>
                    <tr>
                        <td class="comp">Phone No. :</td>
                        <td class="comp">'. $Result10['phone'] .'</td>
                    </tr>
                    <tr>
                        <td class="comp">Address :</td>
                        <td class="comp">'. $Result10['address'] .'</td>
                    </tr>
                    <tr>
                        <td class="comp">10th Standard : </td>
                        <td class="comp">'. $Result10['10th_result'] .' %</td>
                    </tr>
                    <tr>
                        <td class="comp">12th Standard :</td>
                        <td class="comp">'. $Result10['12th_result'] .' %</td>
                    </tr>
                    <tr>
                        <td class="comp">Under Graduation:</td>
                        <td class="comp">'. $Result10['ug'] .'</td>
                    </tr>
                    <tr>
                        <td class="comp">Post Graduation :</td>
                        <td class="comp">'. $Result10['pg'] .'</td>
                    </tr>
                    <tr>
                        <td class="comp">skills :</td>
                        <td class="comp">'. $Result10['skills'] .'</td>
                    </tr>
                    <tr>
                        <td class="comp">Job Experience :</td>
                        <td class="comp">'.$Result10['experience'].'</td>
                    </tr>
                    
                </table>

            </div>
            
        </div>
    </div>
    <button id="reload">Reload</button>
</section>';
?>


    <!--Popup-->
    <div class="con">
    <div class="center modal-box">
        <div class="fas fa-times"></div>

        

        
        <header style="font-family: sans-serif; font-weight: bold; text-shadow: 2px 2px 5px rgb(150, 143, 143); color: #21fd16; font-size: 40px;">Free<span style="color: white;">Lancia</span></header>
        <?php
        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
            if(!empty($_POST['fullname'])){
                // header("Location". $_SERVER['PHP_SELF']);
                $fullname=$_POST['fullname'];
                $nameupdate="UPDATE `user_profile_table` SET `Name` = '$fullname' WHERE `user_profile_table`.`username` = '$Username';";
                $result13=$userprofile->UpdateProcess($nameupdate);
                // echo '<script></script>';
            }
            if(!empty($_POST['specialization'])){
                $special=$_POST['specialization'];
                $specialupdate="UPDATE `user_profile_table` SET `specialization` = '$special' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($specialupdate);
            }
            if(!empty($_POST['phone'])){
                $phone=$_POST['phone'];
                $phoneupdate="UPDATE `user_profile_table` SET `phone` = '$phone' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($phoneupdate);
            }
            if(!empty($_POST['skills'])){
                $skills=$_POST['skills'];
                $skillsupdate="UPDATE `user_profile_table` SET `skills` = '$skills' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($skillsupdate);
            }
            if(!empty($_POST['address'])){
                $address=$_POST['address'];
                $addressupdate="UPDATE `user_profile_table` SET `address` = '$address' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($addressupdate);
            }
            if(!empty($_POST['tenth_number'])){
                $tenthnumber=$_POST['tenth_number'];
                $tenthupdate="UPDATE `user_profile_table` SET `10th_result` = '$tenthnumber' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($tenthupdate);
            }
            if(!empty($_POST['twelve_number'])){
                $twelvenumber=$_POST['twelve_number'];
                $twelveupdate="UPDATE `user_profile_table` SET `12th_result` = '$twelvenumber' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($twelveupdate);
            }
            if(!empty($_POST['ug'])){
                $ugnumber=$_POST['ug'];
                $ugupdate="UPDATE `user_profile_table` SET `ug` = '$ugnumber' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($ugupdate);
            }
            if(!empty($_POST['pg'])){
                $pgnumber=$_POST['pg'];
                $pgupdate="UPDATE `user_profile_table` SET `pg` = '$pgnumber' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($pgupdate);
            }
            if(!empty($_POST['experience'])){
                $experience=$_POST['experience'];
                $experienceupdate="UPDATE `user_profile_table` SET `experience` = '$experience' WHERE `user_profile_table`.`username` = '$Username';";
                $result14=$userprofile->UpdateProcess($experienceupdate);
            }
        }
    ?>
        <form action="Profile.php" method="post">
            <span class="material-symbols-outlined icon2">
                account_circle
                </span>
            <input type="text" style="border-radius: 20px; width:fit-content;" placeholder="Enter Your Full Name..." name="fullname" >

            <span class="material-symbols-outlined icon3">
                stars
                </span>
            <input type="text" class="place"style="border-radius: 20px; width: fit-content;" placeholder="Specialization..." name="specialization" >
            <span class="material-symbols-outlined icon4">
                call
                </span>
            <input type="number" style="border-radius: 20px; width: fit-content;" placeholder="Enter Your Phone No..." name="phone">
            <span class="material-symbols-outlined icon5">
                computer
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Enter Your skills..." name="skills">
            <span class="material-symbols-outlined icon6">
                location_on
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Enter Your Address..." name="address">
            <span class="material-symbols-outlined icon7">
                school
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="10th Standard (%)... " name="tenth_number">
            <span class="material-symbols-outlined icon8">
                school
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="12th Standard (%)... " name="twelve_number">
            <span class="material-symbols-outlined icon9">
                school
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Under Graduation... " name="ug">
            <span class="material-symbols-outlined icon10">
                school
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Post Graduation... " name="pg">
            <span class="material-symbols-outlined icon11">
                work
                </span>
            <input type="text"  style="border-radius: 20px; width:max-content;" placeholder="Job Experience... " name="experience">
            

            
            <button type="submit" name="update" id="autoload">Update</button>
            <button class="closeForm" style="background-color: red;">Close</button>
        </form>

    </div>

</div>
<script>
    document.getElementById("autoload").addEventListener("click", function(){
        window.location.reload();
        alert("Successfully Updated !!!");
    });
    document.getElementById("reload").addEventListener("click", function(){
        window.location.reload();
    });
</script>


</body>

</html>