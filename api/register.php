<?php
include('dbase.php');

$request_body = file_get_contents("php://input");
$data = json_decode($request_body);
$dataJSON = new stdClass();
$dataJSON->success= false;

if (strcmp($data->type, 'student') == 0) {
    if (isset($data)) {
        $dataJSON->success = true;
        $dataJSON = json_encode($dataJSON);
        
        $query = "INSERT INTO student(firstname,lastname,matric_no,phone_no,email,acc_pwd,date_of_birth,student_country,id_no,license_type,license_expired) VALUES('$data->firstname','$data->lastname','$data->matricno','$data->phone','$data->email','$data->acc_pwd','$data->date_of_birth','$data->student_country','$data->id_no','$data->license_type','$data->license_expired')";
        $result = mysqli_query($conn,$query) or die(msqli_error($conn));
        print_r($dataJSON);
    } else {
        $success = json_encode($success);
        echo $success;
    }
} elseif (strcmp($data->type,'car_owner') == 0) {
    if (isset($data)) {
        $dataJSON->success = true;
        $dataJSON = json_encode($dataJSON);
        
        $query = "INSERT INTO car_owner(firstname,lastname,matric_no,phone_no,email,acc_pwd,date_of_birth,student_country,id_no,license_type,license_expired) VALUES('$data->firstname','$data->lastname','$data->matricno','$data->phone','$data->email','$data->acc_pwd','$data->date_of_birth','$data->student_country','$data->id_no','$data->license_type','$data->license_expired')";
        $result = mysqli_query($conn,$query) or die(msqli_error($conn));
        
        $profit = "INSERT INTO owner_profit(matric_no,current_profit) VALUES('$data->matricno','0')";
        $result = mysqli_query($conn,$profit) or die(msqli_error($conn));
        print_r($dataJSON);
    } else {
        $success = json_encode($success);
        echo $success;
    }
}


?>