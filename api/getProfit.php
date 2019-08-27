<?php
include('dbase.php');
extract($_POST);
$owner = new stdClass();
$query = "SELECT current_profit FROM owner_profit WHERE matric_no = '$matric_no'";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

if (isset($result)) {
    if (mysqli_num_rows($result) == 1) {
        $member = mysqli_fetch_assoc($result);
        $owner->profit=$member['current_profit'];
        $owner = json_encode($owner);
        print_r($owner);
    } else {
        echo "not found";
    }
    
} else {
    die('Query failed');
}
?>