<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Glass morphism Profile Card</title>
    <link rel="stylesheet" href="Company_Profile.css">
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


<section>
            <div class="card1">
                <div class="card">
                    <div class="left-container">
                        <a href="#"><i class="fa-regular fa-pen-to-square edit"></i></a>
                        <img src="" class="image1" alt="">
                        <a href="javascript:void(0);" onclick="openPhotoPopup()"><i class="fa-solid fa-camera"></i></a>
                       
    <?php
        session_start();
        @include_once 'config.php';
        class CompanyProfile{
            private $conn;
            public function __construct($conn) {
                $this->conn =$conn->getConnection();
            }
            public function queryProcess($sql){
                $result2=$this->conn->query($sql);
                if($result2){
                    $row7=$result2->fetch_assoc();
                }
                return $row7;
            }
            public function photoProcess($sql){
                $photoResult=$this->conn->query($sql);
                if($photoResult){
                    $photorow=$photoResult->fetch_assoc();
                    $photoData=base64_encode($photorow['company_photo']);
                }
                return $photoData;
            }
            public function UpdateProcess($sql){
                $updateResult=$this->conn->query($sql);
            }
        }
        $companyprofile=new CompanyProfile($db);
        $email=$_SESSION['user_email'];
        $sql11="SELECT `Company_name`,`Address`,`phone`,`company_website` FROM `company_profile_table` WHERE email = '$email';";
        $result12=$companyprofile->queryProcess($sql11);
        // $photosql="SELECT `company_photo` FROM `company_profile_table` WHERE `username`='C_Facebook';";
        // $photoresult=$companyprofile->photoProcess($photosql);
        // $imageType='image/jpeg';
        
       
        echo'<h2 class="gradienttext">'. $result12['Company_name'] .'</h2>  
                    </div>
                    <div class="right-container">
                        <h3 class="gradienttext1">Company Profile Details</h3>
                        <table>
                            <tr>
                                <td class="comp">Email :</td>
                                <td class="comp">'. $email .'</td>
                            </tr>
                            <tr>
                                <td class="comp">Phone No. :</td>
                                <td class="comp">'. $result12['phone'] .'</td>
                            </tr>
                            <tr>
                                <td class="comp">Address :</td>
                                <td class="comp">'. $result12['Address'] .'</td>
                            </tr>
                            <tr>
                            <td class="comp">Website :</td>
                            <td class="comp">'. $result12['company_website'] .'</td>
                        </tr>
                                
                        </table>
    
                    </div>
                </div>
            </div>
    
            <button id="reload">Reload</button>';
        
    ?>

    </section>
               <!-- photo popup  -->
        <div id="photoPopup" class="photo-popup">
        <div class="photo-popup-content">
            <span class="close-photo-popup" onclick="closePhotoPopup()">&times;</span>
            <h2 style="padding-left: 35px; color: antiquewhite;">Select a Photo</h2>
            <div class="photo-options">
                <div class="photo-option" onclick="updatePhoto('photo1.jpg')">
                    <img src="photo1.jpg" alt="Photo 1">
                </div>
                <div class="photo-option" onclick="updatePhoto('photo2.jpg')">
                    <img src="photo2.jpg" alt="Photo 2">
                </div>
                <div class="photo-option" onclick="updatePhoto('photo3.jpg')">
                    <img src="photo3.jpg" alt="Photo 3">
                </div>
                <div class="photo-option" onclick="updatePhoto('photo4.jpg')">
                    <img src="photo4.jpg" alt="Photo 4">
                </div>
            </div>
        </div>
    </div>



    <!--Popup-->
    <div class="con">
    <div class="center modal-box">
        <div class="fas fa-times"></div>

        

        
        <header style="font-family: sans-serif; font-weight: bold; text-shadow: 2px 2px 5px rgb(150, 143, 143); color: #21fd16; font-size: 40px;">Free<span style="color: white;">Lancia</span></header>
        <?php
        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
            // $mail = $_SESSION['user_email'];
            // $query = "SELECT * from company_profile_table WHERE email= '$email' ";
            // $result = mysqli_query($connection, $query);
        
            // if ($result && mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         //assign value to separate variable
            //         $Username = $row['username'];

            //     }
            // }
            $Name =  $_SESSION['username'];
            if(!empty($_POST['companyname'])){

                $companyname=$_POST['companyname'];
                $companynameUpdate="UPDATE `company_profile_table` SET `Company_name` = '$companyname' WHERE `company_profile_table`.`username` = '$Name';";
                $result14=$companyprofile->UpdateProcess($companynameUpdate);
            }
            if(!empty($_POST['phonenumber'])){
                $phonenumber=$_POST['phonenumber'];
                $phonenumberUpdate="UPDATE `company_profile_table` SET `phone` = '$phonenumber' WHERE `company_profile_table`.`username` = '$Name';";
                $result14=$companyprofile->UpdateProcess($phonenumberUpdate);
            }
            if(!empty($_POST['website'])){
                $website=$_POST['website'];
                $websiteUpdate="UPDATE `company_profile_table` SET `company_website` = '$website' WHERE `company_profile_table`.`username` = '$Name';";
                $result14=$companyprofile->UpdateProcess($websiteUpdate);
            }
            if(!empty($_POST['address'])){
                $address=$_POST['address'];
                $addressUpdate="UPDATE `company_profile_table` SET `Address` = '$address' WHERE `company_profile_table`.`username` = '$Name';";
                $result14=$companyprofile->UpdateProcess($addressUpdate);
            }
        }
        ?>
        <form action="" method="post">
            <span class="material-symbols-outlined icon2">
                account_circle
                </span>
            <input type="text" style="border-radius: 20px; width:fit-content;" placeholder="Enter Company Name..." name="companyname">
            
            <span class="material-symbols-outlined icon4">
                call
                </span>
            <input type="number" style="border-radius: 20px; width: fit-content;" placeholder="Enter Phone No..." name="phonenumber">
            <span class="material-symbols-outlined icon5">
                mail
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Enter Website..." name="website">
            <span class="material-symbols-outlined icon6">
                location_on
                </span>
            <input type="text" style="border-radius: 20px; width: fit-content;" placeholder="Enter Address..." name="address">
            
            

            
            <button type="submit" name="update" id="autoload">Update</button>
            <button class="closeForm" style="background-color: red;">Close</button>
        </form>
        
    </div>

</div>
<script>
    document.getElementById("autoload").addEventListener("click", function(){
        window.location.reload();
        alert("Successfully Updated !!!");
        window.location.href = 'http://localhost/Company_dashboard%20-%20Copy/Homepage/company/dash.php';
    });
    document.getElementById("reload").addEventListener("click", function(){
        window.location.reload();
    });

    function openPhotoPopup() {
    document.getElementById("photoPopup").style.display = "block";
}

function closePhotoPopup() {
    document.getElementById("photoPopup").style.display = "none";
}

function updatePhoto(photoUrl) {
    document.querySelector('.image1').src = photoUrl;
    // Store the selected photo URL in localStorage
    localStorage.setItem('selectedPhoto', photoUrl);
    closePhotoPopup();
}

// Check if there is a selected photo in localStorage on page load
document.addEventListener('DOMContentLoaded', function() {
    const storedPhotoUrl = localStorage.getItem('selectedPhoto');
    if (storedPhotoUrl) {
        document.querySelector('.image1').src = storedPhotoUrl;
    }
});

</script>


   
</body>
<style>
        /* Add your CSS for the photo popup here */
        .photo-popup {
            display: none;
            position: fixed;
            display: flex;
            justify-content: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            
        }

        .photo-popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            
            transform: translate(-50%, -50%);
            background: linear-gradient(180deg, rgb(72, 72, 74) 20%, rgba(255,255,255,1) 100%);
            border: 2px solid #000000;
            box-shadow: 5px 5px 30px rgba(255, 255, 255, 0.2);
            
            border-radius: 30px;
            text-align: center;
            }

        .photo-options {
            display: flex;
            justify-content: center;
            width: fit-content;
            margin-left: 30px;
            margin-bottom: 50px;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 25%;
        }

        .photo-option img {
            width: 130px;
            height: 130px;
            border: 4px solid #242526;
            cursor: pointer;
            }

        .photo-option img:hover {
            border-color: #21fd16;
        }

        .close-photo-popup {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #21fd16;
        height: 50px;
        width: 55px;
        line-height: 40px;
        color: white;
        font-size: 30px;
        border-radius: 0 5px 0 50px;
        padding-left: 5px;
        cursor: pointer;
        border-top-right-radius: 30px;
        }
        .close-photo-popup:hover{
            font-size: 40px;
        }
        @media only screen and (max-width: 950px) {
            .photo-option img {
            width: 110px;
            height: 110px;
            border: 4px solid #242526;
            cursor: pointer;
            }
        }
        @media only screen and (max-width: 750px) {
            .photo-option img {
            width: 85px;
            height: 85px;
            border: 3px solid #242526;
            cursor: pointer;
            }
            .photo-popup-content h2{
            font-size: 15px;
            }
            .close-photo-popup {
            height: 40px;
            width: 35px;
            line-height: 40px;
            font-size: 25px;
            }
        }
        @media only screen and (max-width: 530px) {
            .photo-popup-content {
                left: 50%;
                width: 70%;
                
            }
            .photo-options {
                padding-left: 40px;
            }
        }
        @media only screen and (max-width: 470px) {
            .photo-options {
                padding-left: 20px;
            }
        }
        @media only screen and (max-width: 410px) {
            .photo-options {
                padding-left: 10px;
            }
        }

    </style>

</html>