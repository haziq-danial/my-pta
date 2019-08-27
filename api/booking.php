<?php
include('dbase.php');

if (strcmp($_POST['type'], 'enter_booking') == 0) {
    $std_matric = $_POST['std_matric'];
    $owner_matric = $_POST['owner_matric'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $duration = $_POST['duration'];
    $delivery_options = $_POST['delivery_options'];
    $charge_rate = $_POST['charge_rate'];
    $price = $_POST['price'];
    $car_status = $_POST['car_status'];

    $query = "INSERT INTO booking(std_matric,owner_matric,start_time,end_time,duration,delivery_options,charge_rate,price,booking_status) VALUES('$std_matric','$owner_matric','$start_time','$end_time','$duration','$delivery_options','$charge_rate','$price','ongoing')";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $car_update = "UPDATE all_car SET car_status = '$car_status' WHERE matric_no = '$owner_matric'";
    $result = mysqli_query($conn,$car_update) or die(mysqli_error($conn));

} elseif (strcmp($_POST['type'], 'get_booking_std') == 0) {
    $matric_no = $_POST['matric_no'];
    $query = "SELECT * FROM booking WHERE std_matric = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    // if (isset($result)) {
    //     if (mysqli_num_rows($result) == 1) {
    //         $member = mysqli_fetch_assoc($result);
    //         $ownerJSON = json_encode($member);
    //         print_r($ownerJSON);
    //     } else {
    //         echo "not found";
    //     }
    // } else {
    //     die('Query failed');
    // }

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
} elseif (strcmp($_POST['type'], 'get_booking_owner') == 0) {
    $matric_no = $_POST['matric_no'];
    $query = "SELECT * FROM booking WHERE owner_matric = '$matric_no'";
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
    echo 'failed';
}

?>