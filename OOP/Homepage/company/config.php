<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "freelanciaaa";
$connection = mysqli_connect("$server","$username","$password","$database");
// $select_db = mysqli_select_db($connection, $database);
if(!$connection)
{
	echo("connection terminated");
}
?>