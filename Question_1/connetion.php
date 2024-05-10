<?php

$hostname = "localhost";
$username = "root";
$passowrd = "";
$database = "testdb";
$con = mysqli_connect($hostname, $username, $passowrd, $database);

if (!$con) {
    die("Connection failed" . mysqli_connect_error());
}
