<?php
include('dbase.php');

function getPassword($type,$matric_no, $conn) {

    if (strcmp($type, 'student') == 0) {
        $query = "SELECT acc_pwd FROM student WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "SELECT acc_pwd FROM car_owner WHERE matric_no = '$matric_no'";
        
    }
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if (isset($result)) {
        
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $password = $member['acc_pwd'];
            return $password;
        } else {
            echo 'not found';
        }
        

    } else {
        die('Query failed');
    }

}

if (isset($_POST['matric_no']) && isset($_POST['type'])) {
    $type = $_POST['type'];
    $matric_no = $_POST['matric_no'];
    
    $password = getPassword($type,$matric_no,$conn);
    $json = json_encode($password);
    print_r($json);
}
?>