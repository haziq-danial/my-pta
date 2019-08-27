<?php
include('dbase.php');

if (isset($_GET['owner_matric']) && isset($_GET['booking_id'])) {
    
    $owner_matric = $_GET['owner_matric'];
    $booking_id = $_GET['booking_id'];

    $query = "SELECT rating FROM booking_complete WHERE owner_matric = '$owner_matric' AND booking_id = '$booking_id'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $ratingJSON = json_encode($member);
            print_r($ratingJSON);
        } else {
            echo "not found";
        }
    } else {
        die('Query failed');
    }

} else {
    echo "failed";
}
?>