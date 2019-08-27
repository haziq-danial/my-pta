<?php 
include('dbase.php');

// echo $_GET['owner_matric'];
// echo " ";

if (isset($_GET['owner_matric'])) {
    $owner_matric = $_GET['owner_matric'];

    $query = "SELECT * FROM booking_complete WHERE owner_matric = '$owner_matric'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        $count = mysqli_num_rows($result);
        $customer = array();
        if ($count > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $customerDATA = json_encode($row);
                $customer[$i] = $customerDATA;
                $i++;
            }
            $customerJSON = json_encode($customer);
            print_r($customerJSON);
        } else{
            echo "not found";
        }

    } else {
        die('Query failed');
    }
    
} else {
    //echo 'failed';
}


?>