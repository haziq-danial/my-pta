<?php 

include('dbase.php');

if (isset($_FILES['img_header']) && isset($_POST['matric_no'])) {
    $img_header = $_FILES['img_header'];
    print_r($img_header);
    $matric_no = $_POST['matric_no'];
    $img_name = $img_header['name'];

    if(move_uploaded_file($img_header['tmp_name'], "D:/xampp/htdocs/PTA/images/car-img/car-headers/".$img_header['name'])){
        $query = "INSERT INTO image_header(matric_owner,img_name) VALUES('$matric_no','$img_name')";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    } else {
        echo 'failed';
    }
}
?>