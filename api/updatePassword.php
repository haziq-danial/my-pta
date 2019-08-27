<?php
include('dbase.php');

function updatePassword($new_pwd,$matric_no,$type, $conn) {

    if (strcmp($type, 'student') == 0) {
        $query = "UPDATE student SET acc_pwd = '$new_pwd' WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "UPDATE car_owner SET acc_pwd = '$new_pwd' WHERE matric_no = '$matric_no'";
        
    }
    
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
}

if (isset($_POST['new_pwd']) && isset($_POST['matric_no']) && isset($_POST['type'])) {
    $new_pwd = $_POST['new_pwd'];
    $matric_no = $_POST['matric_no'];
    $type = $_POST['type'];

    updatePassword($new_pwd,$matric_no,$type, $conn);

}

?>