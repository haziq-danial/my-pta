<?php 
include('dbase.php');

$request_body = file_get_contents("php://input");
$data = json_decode($request_body);
$dataJSON = new stdClass();
$dataJSON->verified= false;

if (strcmp($data->type, 'student') == 0) {
    $query = "SELECT * FROM student WHERE matric_no = '$data->matric_no' AND acc_pwd = '$data->acc_pwd'";

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if(isset($result)) {
        if(mysqli_num_rows($result) == 1) {
            $dataJSON->verified = true;
            
            $dataJSON = json_encode($dataJSON);
            print_r($dataJSON);
            
        }
        else {
            $dataJSON = json_encode($dataJSON);
            echo $dataJSON;
        }
    }
    else {
        die('Query failed');
    }
} elseif (strcmp($data->type, 'car_owner') == 0) {
    $query = "SELECT * FROM car_owner WHERE matric_no = '$data->matric_no' AND acc_pwd = '$data->acc_pwd'";

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if(isset($result)) {
        if(mysqli_num_rows($result) == 1) {
            $dataJSON->verified = true;
            
            $dataJSON = json_encode($dataJSON);
            print_r($dataJSON);
            
        }
        else {
            $dataJSON = json_encode($dataJSON);
            echo $dataJSON;
        }
    }
    else {
        die('Query failed');
    }
} else {
    echo 'query failed';
}



?>