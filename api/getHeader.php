<?php
include('dbase.php');

function getHeaderImg($matric_no,$conn) {
    $car_img = new StdClass();

    $query = "SELECT * FROM image_header WHERE matric_owner = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $car_img->path = 'http://localhost/haziq%20projects/PTA/images/car-img/car-headers/'.$member['img_name'];
            $carJSON = json_encode($car_img);
            print_r($carJSON);
        }
    } else {
        die('Query failed');
    }
}

if (strcmp($_GET['type'],'getImg') == 0) {

    $matric_no = $_GET['matric_no'];
    getHeaderImg($matric_no,$conn);
    
} else {
    # code...
}

?>