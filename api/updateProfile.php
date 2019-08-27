<?php
include('dbase.php');
session_start();

function updatePersonalDetails($phone_no,$email,$date_of_birth,$matric_no,$type,$conn) {
    
    if (strcmp($type, 'student') == 0) {
        $query = "UPDATE student SET phone_no = '$phone_no', email = '$email', date_of_birth = '$date_of_birth' WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "UPDATE car_owner SET phone_no = '$phone_no', email = '$email', date_of_birth = '$date_of_birth' WHERE matric_no = '$matric_no'";
        
    }
    
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (strcmp($type, 'student') == 0) {
        $query = "SELECT date_of_birth,phone_no,email FROM student WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "SELECT date_of_birth,phone_no,email FROM car_owner WHERE matric_no = '$matric_no'";
        
    }

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $_SESSION['date_of_birth'] = $member['date_of_birth'];
            $_SESSION['phone_no'] = $member['phone_no'];
            $_SESSION['email'] = $member['email'];
        }
    } else {
        die('Query failed');
    }
    
}
function updateLicense($id_no,$student_country,$license_type,$license_expired,$matric_no,$type,$conn) {

    if (strcmp($type, 'student') == 0) {
        $query = "UPDATE student SET student_country = '$student_country', id_no = '$id_no', license_type = '$license_type', license_expired = '$license_expired' WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "UPDATE car_owner SET student_country = '$student_country', id_no = '$id_no', license_type = '$license_type', license_expired = '$license_expired' WHERE matric_no = '$matric_no'";
        
    }
    
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (strcmp($type, 'student') == 0) {
        $query = "SELECT student_country,id_no,license_type,license_expired FROM student WHERE matric_no = '$matric_no'";
        
    }
    if (strcmp($type, 'owner') == 0) {
        $query = "SELECT student_country,id_no,license_type,license_expired FROM car_owner WHERE matric_no = '$matric_no'";
        
    }

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    if (isset($result)) {
        if (mysqli_num_rows($result) == 1) {
            $member = mysqli_fetch_assoc($result);
            $_SESSION['student_country'] = $member['student_country'];
            $_SESSION['id_no'] = $member['id_no'];
            $_SESSION['license_type'] = $member['license_type'];
            $_SESSION['license_expired'] = $member['license_expired'];
        }
    } else {
        die('Query failed');
    }
    
}
    

if (isset($_POST['edit_type'])) {
    $edit_type = $_POST['edit_type'];

   if (strcmp($edit_type,'details') == 0) {

        $type = $_POST['type'];
        $phone_no = $_POST['phone_no'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $matric_no = $_POST['matric_no'];
        updatePersonalDetails($phone_no,$email,$date_of_birth,$matric_no,$type,$conn);
   }
   if (strcmp($edit_type,'license') == 0) {
        $type = $_POST['type'];
        $matric_no = $_POST['matric_no'];
        $id_no = $_POST['id_no'];
        $student_country = $_POST['student_country'];
        $license_type = $_POST['license_type'];
        $license_expired = $_POST['license_expired'];
        
        updateLicense($id_no,$student_country,$license_type,$license_expired,$matric_no,$type,$conn);
   }

}
    

?>