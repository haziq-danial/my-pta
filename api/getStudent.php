<?php
include('dbase.php');

$request_body = file_get_contents("php://input");
$data = json_decode($request_body);
$student = new stdClass();
session_start();

if (strcmp($data->type,'login') == 0) {
    $query = "SELECT * FROM student WHERE matric_no = '$data->matric_no' AND acc_pwd = '$data->acc_pwd'";

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));


    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            session_regenerate_id();
            $member = mysqli_fetch_assoc($result);
            $_SESSION['status'] = true;
            $_SESSION['id']=$member['id'];
            $_SESSION['firstname']=$member['firstname'];
            $_SESSION['lastname']=$member['lastname'];
            $_SESSION['matric_no']=$member['matric_no'];
            $_SESSION['phone_no']=$member['phone_no'];
            $_SESSION['email']=$member['email'];
            $_SESSION['date_of_birth']=$member['date_of_birth'];
            $_SESSION['student_country']=$member['student_country'];
            $_SESSION['id_no']=$member['id_no'];
            $_SESSION['license_type']=$member['license_type'];
            $_SESSION['license_expired']=$member['license_expired'];
            session_write_close();
            $student->firstname=$member['firstname'];
            $student->lastname=$member['lastname'];
            $student->matric_no=$member['matric_no'];
            $student->phone_no=$member['phone_no'];
            $student->email=$member['email'];
            $student->date_of_birth=$member['date_of_birth'];
            $student->student_country=$member['student_country'];
            $student->id_no=$member['id_no'];
            $student->license_type=$member['license_type'];
            $student->license_expired=$member['license_expired'];
            $studentJSON = json_encode($student);
            print_r($studentJSON);
        } else {
            echo "not found";
        }
        
    } else {
        die('Query failed');
    }
} elseif (strcmp($data->type,'get') == 0) {
    $student->firstname=$_SESSION['firstname'];
    $student->lastname=$_SESSION['lastname'];
    $student->matric_no=$_SESSION['matric_no'];
    $student->phone_no=$_SESSION['phone_no'];
    $student->email=$_SESSION['email'];
    $student->date_of_birth=$_SESSION['date_of_birth'];
    $student->student_country=$_SESSION['student_country'];
    $student->id_no=$_SESSION['id_no'];
    $student->license_type=$_SESSION['license_type'];
    $student->license_expired=$_SESSION['license_expired'];
    $studentJSON = json_encode($student);
    print_r($studentJSON);

} elseif (strcmp($data->type,'getStudentData') == 0) {
    //display for booking data
    $query = "SELECT * FROM student WHERE matric_no = '$data->matric_no'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $student->firstname=$member['firstname'];
            $student->lastname=$member['lastname'];
            $student->matric_no=$member['matric_no'];
            $student->phone_no=$member['phone_no'];
            $student->student_country=$member['student_country'];
            $student->id_no=$member['id_no'];
            $student->license_type=$_SESSION['license_type'];
            $student->license_expired=$_SESSION['license_expired'];
            $studentJSON = json_encode($student);
            print_r($studentJSON);
        } else {
            echo "not found";
        }
    } else {
        die('Query failed');
    }
} else {
    echo 'failed';
}



?>