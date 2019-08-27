<?php
include('dbase.php');

// echo $_POST['std_name'];
// echo " ";
// echo $_POST['std_matric'];
// echo " ";
// echo $_POST['owner_matric'];
// echo " ";
// echo $_POST['time_used'];
// echo " ";
// echo $_POST['paid_status'];
// echo " ";
// echo $_POST['overcharge'];
// echo " ";
// echo $_POST['price'];
// echo " ";
// echo $_POST['booking_status'];
// echo " ";
// complete booking
if (isset($_POST['std_name']) && isset($_POST['std_matric']) && isset($_POST['owner_matric']) &&
    isset($_POST['paid_status']) && isset($_POST['overcharge']) && isset($_POST['price']) && isset($_POST['booking_status'])) {
        $owner_name = $_POST['owner_name'];
        $std_name = $_POST['std_name'];
        $std_matric = $_POST['std_matric'];
        $owner_matric = $_POST['owner_matric'];
        $time_used = $_POST['time_used'];
        $book_date = $_POST['book_date'];
        $book_day = $_POST['book_day'];
        $paid_status = $_POST['paid_status'];
        $overcharge = $_POST['overcharge'];
        $price = $_POST['price'];
        $final_price = $_POST['final_price'];
        $booking_status = $_POST['booking_status'];
        $car_status = $_POST['car_status'];
        $booking_id = $_POST['booking_id'];

        $query = "INSERT INTO booking_complete(booking_id,owner_name,std_name,std_matric,owner_matric,time_used,book_date,book_day,paid_status,overcharge,price,final_price,rating) VALUES('$booking_id','$owner_name','$std_name' ,'$std_matric' ,'$owner_matric', '$time_used', '$book_date' , '$book_day' ,'$paid_status' ,'$overcharge' ,'$price', '$final_price','not given')";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        $update = "UPDATE booking SET booking_status = '$booking_status' WHERE std_matric='$std_matric' AND id = '$booking_id'";
        $result = mysqli_query($conn,$update) or die(mysqli_error($conn));

        $car_update = "UPDATE all_car SET car_status = '$car_status' WHERE matric_no = '$owner_matric'";
        $result = mysqli_query($conn,$car_update) or die(mysqli_error($conn));
} else {
    echo 'failed';
}


?>