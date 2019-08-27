<?php
include('dbase.php');

// echo $_GET['paid_status'];
// echo " ";
// echo $_GET['booking_id'];
// echo " ";

if (isset($_GET['paid_status']) && isset($_GET['booking_id']) && isset($_GET['std_matric']) ) {
    $paid_status = $_GET['paid_status'];
    $booking_id = $_GET['booking_id'];
    $std_matric = $_GET['std_matric'];

    $update = "UPDATE booking_complete SET paid_status = '$paid_status' WHERE std_matric='$std_matric' AND booking_id = '$booking_id'";
    $result = mysqli_query($conn,$update) or die(mysqli_error($conn));

} else {
    echo 'failed';
}


?>