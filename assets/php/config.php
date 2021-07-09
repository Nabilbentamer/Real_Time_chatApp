<?php

//create a connection 

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "messagerie";

$conn = mysqli_connect($servername,$username,$password,$database_name);

if(!$conn){
	die(" Failed to connect to database" .mysqli_connect_error());
 }

?>