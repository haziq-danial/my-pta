<?php
include('dbase.php');
// echo $_POST['booking_id'];
// echo " ";
// echo $_POST['overcharge'];
// echo " ";
// echo $_POST['add_duration'];
// echo " ";
// echo $_POST['add_price'];
// echo " ";
// echo $_POST['new_price'];
// echo " ";
// echo $_POST['end_time'];
// echo " ";
// echo $_POST['type'];
// echo " ";

if (isset($_POST['booking_id']) && isset($_POST['overcharge']) && 
isset($_POST['add_duration']) && isset($_POST['add_price']) && 
isset($_POST['new_price']) && isset($_POST['end_time'])) {
    $booking_id = $_POST['booking_id'];
    $overcharge = $_POST['overcharge'];
    $add_duration = $_POST['add_duration'];
    $add_price = $_POST['add_price'];
    $new_price = $_POST['new_price'];
    $end_time = $_POST['end_time'];

    $query = "UPDATE overcharge SET add_duration = '$add_duration',add_price = '$add_price',new_price = '$new_price',end_time = '$end_time' WHERE booking_id = '$booking_id'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
}  else {
    echo 'failed';
}



?>