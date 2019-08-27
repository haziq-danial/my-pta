<?php
session_start();
$res = new stdClass();

if (isset($_SESSION['status']) == true) {
    $res->status = true;
} else {
    $res->status = false;
}

$res = json_encode($res);
print_r($res);

?>