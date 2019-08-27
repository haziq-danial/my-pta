<?php 
include('dbase.php');


if (strcmp($_GET['type'],'getCar') == 0) {

    if (isset($_GET['matric_no'])) {
        $car_details = new StdClass();
        $matric_no = $_GET['matric_no'];
        $query = "SELECT * FROM all_car WHERE matric_no = '$matric_no'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
        if (isset($result)) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                $car_details->car_name = $member['car_name'];
                $car_details->plate_no = $member['plate_no'];
                $car_details->matric_no = $member['matric_no'];
                $car_details->engine_litre = $member['engine_litre'];
                $car_details->transmission = $member['transmission'];
                $car_details->car_seat = $member['car_seat'];
                $car_details->charge_rate = $member['charge_rate'];
                $car_details->rating = $member['rating'];
                $carJSON = json_encode($car_details);
                print_r($carJSON);
            }
        } else {
            die('Query failed');
        }
    } else {
        echo "failed to get car";
    }
    
} elseif (strcmp($_GET['type'],'allCar') == 0) {
    $query = "SELECT * FROM all_car";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        $count = mysqli_num_rows($result);
        $car = array();
        if ($count > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $carDATA = json_encode($row);
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
} else {
    echo "failed";
}

?>