<?php
define("DATABASE_HOST", "localhost");
define("DATABASE_USER", "root");

$conn = mysqli_connect(DATABASE_HOST, DATABASE_USER);

if (mysqli_connect_errno()) {
 	echo "Failed to connect to Mysql: "	. mysqli_connect_error();
 } 

 mysqli_select_db($conn, "umpcarrental") or die("Could not open database");

 
 ?>