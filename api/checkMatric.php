<?php
include('dbase.php');

extract($_POST);
$status = new StdClass();
$status->verify = false;
if (strcmp($type,'student') == 0) {
    $query = "SELECT * FROM student WHERE matric_no = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $status->verify = true;
        }
    } else {
        die('Query failed');
    }
}

if (strcmp($type,'car_owner') == 0) {
    $query = "SELECT * FROM car_owner WHERE matric_no = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $status->verify = true;
        }
    } else {
        die('Query failed');
    }
}
$status = json_encode($status);
print_r($status);
?>