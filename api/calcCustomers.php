<?php 
include('dbase.php');

extract($_POST);
$query = "SELECT COUNT(*) as total FROM booking_complete WHERE book_date = '$date' AND owner_matric = '$matric_no'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$data = mysqli_fetch_assoc($result);
echo $data['total'];


?>