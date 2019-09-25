<?php
include('dbase.php');

function getCarImages($matric_no,$conn) {

    $query = "SELECT * FROM car_images WHERE matric_owner = '$matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        $count = mysqli_num_rows($result);
        $car = array();
        $img = new StdClass();
        if ($count > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $img->src = 'http://localhost/haziq%20projects/PTA/images/car-img/'.$row['img_name'];
                $carDATA = json_encode($img);
                $car[$i] = $carDATA;
                $i++;
            }
            $carJSON = json_encode($car);
            print_r($carJSON);
        } else{
            echo "not found";
        }

    } else {
        die('Query failed');
    }

}


if (strcmp($_GET['type'],'getImg') == 0) {

    $matric_no = $_GET['matric_no'];
    getCarImages($matric_no,$conn);
}
?>