<?php
@include 'config.php';
// Add your actual logout logic here
session_start();
session_destroy();

// Redirect to signup.php
header("Location: ../../signup.php");
exit();
?>