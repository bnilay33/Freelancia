<?php
session_start();
if(isset($_SESSION['ac'])){
$i= $_SESSION['ac'];
echo $i;
}
?>