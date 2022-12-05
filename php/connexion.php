<?php

$servername="localhost";
$username="root";
$password="";
$db_name="GEST_PARKING";
$con=mysqli_connect($servername,$username,$password,$db_name);

if(!$con){
	die("Connexion �choue!".mysqli_connect_error($con));
}
?>