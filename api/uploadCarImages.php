<?php 
include('dbase.php');
function reArrayFiles($files_post) {
    $file_ary = array();
    $file_count = count($files_post['name']);
    // echo $file_count;
    // echo "<br>";
    $file_keys = array_keys($files_post);
    for ($i=0; $i < $file_count; $i++) { 
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $files_post[$key][$i];
        }
    }
    return $file_ary;
}

if (isset($_FILES['car_images']) && isset($_POST['matric_no'])) {
    $car_images = reArrayFiles($_FILES['car_images']);
    // print_r($car_images);
    $file_count = count($car_images);
    $matric_no = $_POST['matric_no'];
    // echo "<br>";
    // echo $file_count;
    // echo "<br>";
    for ($i=0; $i < $file_count; $i++) { 
        if (move_uploaded_file($car_images[$i]['tmp_name'], "D:/xampp/htdocs/PTA/images/car-img/".$car_images[$i]['name'])) {
            $img_name[$i] = $car_images[$i]['name'];
            $query = "INSERT INTO car_images(matric_owner,img_name) VALUES('$matric_no','$img_name[$i]')";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        } else {
            echo 'failed';
        }
        
    }
}
?>