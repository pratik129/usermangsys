<?php

require_once('connetion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $query = "INSERT INTO users (`name`, email, mobile_number, gender, dob, age) VALUES ('" . $_POST['name'] . "','" . $_POST['email'] . "'
    ,'" . $_POST['mobile'] . "','" . $_POST['gender'] . "','" . $_POST['dob'] . "','" . $_POST['age'] . "')";
    if (mysqli_query($con, $query)) {
        $last_id = mysqli_insert_id($con);
        // $add = [];
        foreach ($_POST['addresses'] as $key => $addreess) {
            // $add[$key]['address'] = $_POST['addresses'][$key];
            // $add[$key]['cities'] = $_POST['cities'][$key];
            // $add[$key]['states'] = $_POST['states'][$key];
            // $add[$key]['pincodes'] = $_POST['pincodes'][$key];
            $address = $_POST['addresses'][$key];
            $city = $_POST['cities'][$key];
            $state = $_POST['states'][$key];
            $pincodes = $_POST['pincodes'][$key];
            $query = "INSERT INTO `address`(`address`, `city`, `state`, `pincode`, `uid`) VALUES ('" . $address . "','" . $city . "'
    ,'" . $state . "','" . $pincodes . "'," . $last_id . ")";
            mysqli_query($con, $query);
        }
        http_response_code(200);
        echo 'User Added successfully';
    } else {
        http_response_code(500);
        echo 'Error in deleting User: ' . mysqli_error($conn);
    }
} else {
    http_response_code(400);
    echo "Failure";
}
