<?php
include('dbase.php');

// echo $_GET['matric_no'];

if (isset($_GET['matric_no'])) {

    $matric_no = $_GET['matric_no'];

    $query = "SELECT * FROM booking_complete WHERE std_matric = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if (isset($result)) {
        $count = mysqli_num_rows($result);
        $booking = array();
        if ($count > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $bookingDATA = json_encode($row);
                $booking[$i] = $bookingDATA;
                $i++;
            }
            $bookingJSON = json_encode($booking);
            print_r($bookingJSON);
        } else{
            echo "not found";
        }

    } else {
        die('Query failed');
    }
    
} else {
    # code...
}


?>