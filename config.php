<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pap_s_kitchen";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){

    $location = "Location: ./page_not_found.php?error=" . $conn->connect_error;
    $location = str_replace(PHP_EOL, '', $location);
    header($location);
    exit();
};
