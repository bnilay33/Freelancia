<?php session_start(); ?>




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
</head>

<body background="images/dark-blue-product-background.jpg">

<?php
    @include 'config.php';
      $query = "SELECT Project_Name, Project_description, demo_project FROM job_post_table ORDER BY dt DESC LIMIT 1";
      $result = mysqli_query($connection, $query);
  
      if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              //assign value to separate variable
              $Name = $row['Project_Name'];
              $Project_description = $row['Project_description'];
              $demo_project = $row['demo_project'];
    
          }
      }
      ?>
    <div class="container">
        <h1 class="logo">Free<span>Lancia</span></h1>
        <?php
        echo '<div class="para">';
        echo "<h1>$Name</h1>";
        echo "<img src='UploadImageFile/$demo_project' width = 200 title='$demo_project'>";
        echo "<p>$Project_description</p>";
        echo '<div class="btn">
                <a href="index.php"><button class="open-button">Back</button></a>
            </div>
        </div>
    </div>';
    ?>
    <script src="js/project_details.js"></script>
</body>

</html>