<?php
include('dbase.php');
extract($_POST);
$query = "UPDATE owner_profit SET current_profit = '$profit' WHERE matric_no = '$matric_no'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
?>