<?php
session_start();
@include 'config.php';
if(isset($_POST['submit'])){

    $mail = $_SESSION['user_email'];

    $query = "SELECT * from signup_table WHERE email= '$mail' ";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //assign value to separate variable
            $Username = $row['username'];
        }
    }
    $Company_Name = $_POST['Company_Name'];
    $Project_Name = $_POST['Project_Name'];
    $Project_description = $_POST['Project_description'];
    $duration = $_POST['duration'];
    // $qualification = $_POST['qualification'];
    $skills = $_POST['skills'];
    $deadline = $_POST['deadline'];
    //$demo_project = $_POST['demo_project'];
    //$Project_photo = $_POST['Project_photo'];

    //Image checking
    if($_FILES['demo_project']['error'] === 4){
    ?>
    <script>
     alert('Image Does Not Exist');
    </script>
    <?php
    }
    else{
    // Demo project
    $demoname = $_FILES['demo_project']['name'];
    $demosize = $_FILES['demo_project']['size'];
    $tmpdemo = $_FILES['demo_project']['tmp_name'];

    //Project_photo
    // $topicphoto = $_FILES['Project_photo']['name'];
    // $topic_photo_size = $_FILES['Project_photo']['size'];
    // $tmp_topic_photo = $_FILES['Project_photo']['tmp_name'];

    //valid extension
    $validExtension = ['jpg', 'jpeg', 'png'];
    
    //demo project photo validation
    
    $demoImageExtension = explode('.', $demoname);
    $demoImageExtension = strtolower(end($demoImageExtension));

    // topic photo validation
    // $topic_photo_extension = explode('.', $topicphoto);
    // $topic_photo_extension = strtolower(end($topic_photo_extension));
    
    //demo image extension checking
    if ( !in_array($demoImageExtension, $validExtension)){
        ?>
        <script>
          alert('Invalid Image Extension');
        </script>
      <?php
      }
      //demo image size validation
      else if($demosize > 1000000){  
      ?>
    <script>
    alert('Demo Project Size Is Too Large');
    </script>
    <?php
    }
    else{
    //demo project
    $imgex = pathinfo($demoname,PATHINFO_EXTENSION);
    $imgex_loc = strtolower($imgex);
    
    $mail = $_SESSION['user_email'];
    $query = "SELECT * from subscription_table WHERE email= '$mail' ";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //assign value to separate variable
            $status = $row['status'];


    //project photo
    // $projectimg = pathinfo($topicphoto,PATHINFO_EXTENSION);
    // $projectimg_loc = strtolower($projectimg);

    if((in_array($imgex_loc,$validExtension))){
    //demo project saving in database
    $newImageName = uniqid("DEMO_PROJECT-", true).'.'.$imgex_loc;

    //project photo store in database
    // $projectImage_name = uniqid("Topic_Image-", true).'.'.$projectimg_loc;

    //Upload demo project to folder
    $imageUpload = 'UploadImageFile/' . $newImageName;

    //Upload demo project to folder
    // $project_image_Upload = 'UploadImageFile/' . $projectImage_name;

    //uploading to folder
    move_uploaded_file($tmpdemo, $imageUpload);
    // move_uploaded_file($tmp_topic_photo, $project_image_Upload);
    
    //data insert to database
    $sql = "INSERT INTO `job_post_table` (`username`, `Company_Name`, `Project_Name`, `demo_project`,`Project_description`, `duration`, `skills`, `deadline`) VALUES ('$Username','$Company_Name', '$Project_Name','$newImageName','$Project_description','$duration','$skills','$deadline');";
    mysqli_query($connection,$sql);
    ?>
    <script>
        alert("Successfully Posted");
        document.location.href = 'project_details.php';
    </script>
    <?php
     }
    else{
       ?>
        <script>
        alert("Something error!");
        document.location.href = 'index.php';
    </script>
    <?php 
    }
    }
    }else{
        ?>
        <script>
        alert("Not Posted Buy subscription first");
        document.location.href = 'index.php';
    </script>
    <?php
    }

    }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeLancia</title>
    <link rel="stylesheet" href="style.css">
   
</head>

<script>
     function  validateForm(){
        let x= document.forms["project_post"]["Company_Name"].value;
        if(x == "" || x == null){
            alert("Comapany name must be filled out");
            return false;
        }
        let y= document.forms["project_post"]["Project_Name"].value;
        if(y == "" || y == null){
            alert("Project name must be filled out.");
            return false;
        }
        let z= document.forms["project_post"]["Project_description"].value;
        if(z == ""){
            alert("Project_description must be filled out.");
            return false;
        }
        let a= document.forms["project_post"]["duration"].value;
        if(a == ""){
            alert("duration must be filled out.");
            return false;
        }
        let b= document.forms["project_post"]["qualification"].value;
        if(b == ""){
            alert("Qualification name must be filled out.");
            return false;
        }
        let c= document.forms["project_post"]["skills"].value;
        if(c == ""){
            alert("skills Section must be filled out.");
            return false;
        }
        let d= document.forms["project_post"]["deadline"].value;
        if(d == ""){
            alert("Deadline Date must be filled out.");
            return false;
        }
        let e= document.forms["project_post"]["demo_project"].value;
        if(e == ""){
            alert("demo_project Project must be uploaded.");
            return false;
        }
        let f= document.forms["project_post"]["Project_photo"].value;
        if(f == ""){
            alert("Project Based Photo must be uploaded.");
            return false;
        }else{
            alert("Successfull");
            location.href("indexx.html");
        }
        
     }

</script>


</script>
<body>
<div class="container">
        <h1>Free<span>Lancia</span></h1>
        <h2>Post Your Job</h2>
        <form id="project_post" action="" onsubmit="return validateForm()" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="inputBox">
                <div class="inputBox1" >
                <input type="text" name="Company_Name">
                <span>Company Name</span>
                </div>
                <div class="inputBox2">
               <input type="text" name="Project_Name">
               <span>Project Name</span>
                </div>
                <div class="inputBox3">
               <input type="text" name="Project_description">
               <span>Project Project_description</span>
                </div>
                <div class="inputBox4">
               <input type="text" name="duration">
               <span>Project duration</span>
                </div>
                <!-- <div class="inputBox5">
                <input type="text" name="qualification">
                <span>Qualification</span>
                </div> -->
                <div class="inputBox6">
               <input type="text" name="skills">
               <span>skillss Required</span>
                </div>
                <div class="inputBox7">
                <input type="text" name="deadline">
                <span>Deadline Date</span>
                </div>
            </div>
            <div class="DemoProject">
                <span>Demo Project:- </span>
                <input type="file" name="demo_project" id="demo_project" accept=".jpg, .jpeg, .png">
            </div>
            <!-- <div class="ProjectPhoto">
                <span>Project based Photo:- </span>
                <input type="file" name="Project_photo" accept=".jpg, .jpeg, .png">
            </div> -->
            <input class="Submit" type="submit" name="submit" value="Submit" onclick="Redirect()">
        </form>
</div>
</body>
</html>