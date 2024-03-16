<?php
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['button'])){
    if(isset($_POST['username']) && isset($_POST['name'])){
        $_SESSION['username']=$_POST['username'];
        $_SESSION['name']=$_POST['name'];
    }
    header("Location: user_find_job.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        USERNAME: <input type="text" name="username">
        NAME: <input type="text" name="name">
        <button name="button">Submit</button>
    </form>
</body>
</html>