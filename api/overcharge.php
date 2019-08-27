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
isset($_POST['new_price']) && isset($_POST['end_time']) && isset($_POST['type'])) {
    $booking_id = $_POST['booking_id'];
    $overcharge = $_POST['overcharge'];
    $add_duration = $_POST['add_duration'];
    $add_price = $_POST['add_price'];
    $new_price = $_POST['new_price'];
    $end_time = $_POST['end_time'];

    if (strcmp($_POST['type'],'add') == 0) {
       
        $query = "INSERT INTO overcharge(booking_id,add_duration,add_price,new_price,end_time) VALUES('$booking_id','$add_duration','$add_price','$new_price','$end_time')";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    } else {
       echo 'failed-2';
    }
    
} elseif (isset($_POST['booking_id']) && isset($_POST['type'])) {
    
    $booking_id = $_POST['booking_id'];

    if (strcmp($_POST['type'],'delete') == 0) {
        $query = "DELETE FROM overcharge WHERE booking_id = '$booking_id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    } elseif (strcmp($_POST['type'],'get') == 0) {

        $query = "SELECT * FROM overcharge WHERE booking_id = '$booking_id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        if (isset($result)) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                $overchargeJSON = json_encode($member);
                print_r($overchargeJSON);
            } else {
                echo "not found";
            }
        } else {
            die('Query failed');
        }
    }

} else {
    echo 'failed';
}



?>