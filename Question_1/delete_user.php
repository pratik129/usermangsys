<?php
require_once('connetion.php');

if (isset($_POST['id'])) {
    $userId = $_POST['id'];
    $query = "DELETE FROM `address` WHERE `uid` = " . $userId;
    if (mysqli_query($con, $query)) {
        $query = "DELETE FROM users WHERE id = " . $userId;
        if (mysqli_query($con, $query)) {
            http_response_code(200);
            echo 'Record deleted successfully';
        } else {
            http_response_code(500);
            echo 'Error deleting record: ' . mysqli_error($conn);
        }
    } else {
        http_response_code(500);
        echo 'Error deleting record: ' . mysqli_error($conn);
    }
} else {
    http_response_code(400);
    echo "User ID not provided";
}
