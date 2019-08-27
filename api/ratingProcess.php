<?php
include('dbase.php');

if (isset($_POST['owner_matric']) && isset($_POST['std_matric']) && isset($_POST['rating']) && isset($_POST['booking_id'])) {
    $owner_matric = $_POST['owner_matric'];
    $std_matric = $_POST['std_matric'];
    $rating = $_POST['rating'];
    $booking_id = $_POST['booking_id'];
    // echo $owner_matric;
    // echo $std_matric;
    // echo $rating;
    // echo $booking_id;
    $update = "UPDATE booking_complete SET rating = '$rating' WHERE std_matric = '$std_matric' AND booking_id = '$booking_id'";
    $result = mysqli_query($conn,$update) or die(mysqli_error($conn));

    $query = "SELECT rating FROM booking_complete WHERE owner_matric = '$owner_matric' AND NOT rating = 'not given'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if (isset($result)) {
        $count = mysqli_num_rows($result);
        $rating_array = array();
        if ($count > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                // $ratingDATA = json_encode($row);
                $rating_array[$i] = $row;
                $i++;
                // echo "success";
            }
            // print_r($rating_array);
            // $ratingJSON = json_encode($rating_array);
            // print_r($ratingJSON);
            $length = count($rating_array);
            $total_rating = 0;
            $avg_rating = 0;
            for ($i=0; $i < $length; $i++) {

                echo $rating_array[$i]['rating'];
                echo "<br>";
                
                $total_rating = $total_rating + $rating_array[$i]['rating'];
            }
            echo "length=".$length;
            echo "<br>";
            $avg_rating = $total_rating / $length;

            echo $avg_rating;
            
            $update = "UPDATE all_car SET rating = '$avg_rating' WHERE matric_no = '$owner_matric'";
            $result = mysqli_query($conn,$update) or die(mysqli_error($conn));

        } else{
            echo "not found";
            // $query = "UPDATE booking_complete SET rating = '$rating' WHERE std_matric = '$std_matric' AND booking_id = '$booking_id'";
            // $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
        }

    } else {
        die('Query failed');
    }



    // $query = "UPDATE booking_complete SET rating = '$rating' WHERE std_matric = '$std_matric' AND booking_id = '$booking_id'";
    // $result = mysqli_query($conn,$query) or die(mysqli_error($conn));


} else {
    echo "failed";
}

?>