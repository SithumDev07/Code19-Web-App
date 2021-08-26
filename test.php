<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    
    $time = substr( $date,-11, 5);
    $date = substr($date, 0, 10);
    echo $date . "<br>";
    echo $time;
    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
