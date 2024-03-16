<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get data from the AJAX request
  $companyName = $_POST['companyName'];
  $projectName = $_POST['projectName'];
  $User = $_SESSION['username'];

  // Perform the deletion in your database
  $query = "DELETE FROM job_post_table WHERE Company_Name = '$companyName' AND Project_Name = '$projectName' AND username = '$User'";
  $result = $connection->query($query);

  // You might want to handle errors and return appropriate responses
  if ($result) {
    echo 'success';
  } else {
    echo 'error';
  }
}
?>

