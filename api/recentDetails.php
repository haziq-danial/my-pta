<?php
include('dbase.php');

if (isset($_POST['std_matric']) && isset($_POST['booking_id']) && isset($_POST['type'])) {
    $booking_id = $_POST['booking_id'];
    $std_matric = $_POST['std_matric'];
    
    if (strcmp($_POST['type'],'booking') == 0) {
        $query = "SELECT * FROM booking WHERE std_matric = '$std_matric' AND id = '$booking_id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        if (isset($result)) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                $bookingJSON = json_encode($member);
                print_r($bookingJSON);
            } else {
                echo "not found";
            }
        } else {
            die('Query failed');
        }
    } elseif (strcmp($_POST['type'],'student') == 0) {
        $student = new stdClass();
        $query = "SELECT * FROM student WHERE matric_no = '$std_matric'";
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
                $student->license_type=$member['license_type'];
                $student->license_expired=$member['license_expired'];
                $student->date_of_birth=$member['date_of_birth'];
            } else {
                echo "not found";
            }
        } else {
            die('Query failed');
        }
        $query = "SELECT paid_status,overcharge FROM booking_complete WHERE std_matric = '$std_matric' AND booking_id = '$booking_id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        if (isset($result)) {
            //$student = new stdClass();
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                $student->paid_status=$member['paid_status'];
                $student->overcharge=$member['overcharge'];
            } else {
                echo "not found";
            }
        } else {
            die('Query failed');
        }
        $studentJSON = json_encode($student);
        print_r($studentJSON);

    } else {
        echo 'failed-2';
    }
    
} elseif (isset($_POST['owner_matric']) && isset($_POST['type'])) {
    
    $owner_matric = $_POST['owner_matric'];

    if (strcmp($_POST['type'],'owner') == 0) {
        
        $owner = new stdClass();
        $query = "SELECT * FROM car_owner WHERE matric_no = '$owner_matric'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        if (isset($result)) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                $owner->firstname=$member['firstname'];
                $owner->lastname=$member['lastname'];
                $owner->matric_no=$member['matric_no'];
                $owner->phone_no=$member['phone_no'];
                $owner->student_country=$member['student_country'];
                $owner->id_no=$member['id_no'];
                $owner->license_type=$member['license_type'];
                $owner->license_expired=$member['license_expired'];
                $owner->date_of_birth=$member['date_of_birth'];
                $ownerJSON = json_encode($owner);
                print_r($ownerJSON);
            } else {
                echo "not found";
            }
        } else {
            die('Query failed');
        }
        

    } else {
        echo 'failed-2-1';
    }

} else {
    echo 'failed-1';
}


// && isset($_POST['type'])
// isset($_POST['owner_matric']) 
// $owner_matric = $_POST['owner_matric'];
// elseif (strcmp($_POST['type'],'owner') == 0) {
//     $student = new stdClass();
//     $query = "SELECT * FROM car_owner WHERE matric_no = '$owner_matric'";
//     $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
//     if (isset($result)) {
//         if (mysqli_num_rows($result) == 1) {
//             $member = mysqli_fetch_assoc($result);
//             $student->firstname=$member['firstname'];
//             $student->lastname=$member['lastname'];
//             $student->matric_no=$member['matric_no'];
//             $student->phone_no=$member['phone_no'];
//             $student->student_country=$member['student_country'];
//             $student->id_no=$member['id_no'];
//             $student->license_type=$member['license_type'];
//             $student->license_expired=$member['license_expired'];
//         } else {
//             echo "not found";
//         }
//     } else {
//         die('Query failed');
//     }
// }

?>