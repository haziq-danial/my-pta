<?php
include('dbase.php');

if (isset($_POST['std_matric']) && isset($_POST['owner_matric']) && isset($_POST['id']) && isset($_POST['type'])) {
    if (strcmp($_POST['type'], 'student') == 0) {
        $std_matric = $_POST['std_matric'];
        $owner_matric = $_POST['owner_matric'];
        $id = $_POST['id'];
        $car_status = $_POST['car_status'];
        $query = "DELETE FROM booking WHERE std_matric = '$std_matric' AND id = '$id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        $car_update = "UPDATE all_car SET car_status = '$car_status' WHERE matric_no = '$owner_matric'";
        $result = mysqli_query($conn,$car_update) or die(mysqli_error($conn));
    } else {
        echo 'failed2';
    }
} else {
    echo $_POST['type'];
    echo $_POST['owner_matric'];
    echo 'failed1';
}



?>