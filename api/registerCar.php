<?php 
include('dbase.php');

if (isset($_POST['car_name']) && isset($_POST['plate_no']) 
&& isset($_POST['matric_no']) && isset($_POST['engine_litre'])
&& isset($_POST['transmission']) && isset($_POST['car_seat'])
&& isset($_POST['charge_rate']) && isset($_POST['owner_name'])) {
    $owner_name = $_POST['owner_name'];
    $car_name = $_POST['car_name'];
    $plate_no = $_POST['plate_no'];
    $matric_no = $_POST['matric_no'];
    $engine_litre = $_POST['engine_litre'];
    $transmission = $_POST['transmission'];
    $car_seat = $_POST['car_seat'];
    $charge_rate = $_POST['charge_rate'];

    $query = "INSERT INTO all_car(owner_name,matric_no,plate_no,car_name,engine_litre,transmission,car_seat,charge_rate,rating,car_status) VALUES('$owner_name','$matric_no','$plate_no','$car_name','$engine_litre','$transmission','$car_seat','$charge_rate',0,'not used')";
    $result = mysqli_query($conn,$query) or die(msqli_error($conn));

}

?>