<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "freelanciaaa";
$conn = mysqli_connect("$server","$username","$password","$database");
// $select_db = mysqli_select_db($connection, $database);
if(!$conn)
{
	echo("connection terminated");
}
?>