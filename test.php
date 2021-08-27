<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    $price = "480.75";
    $priceN = "480.00";

    echo substr($priceN, (int)strpos($price, '.') + 1);

    if(substr($priceN, (int)strpos($price, '.') + 1) == 0) {
        echo substr($price, 0, (int)strpos($price, '.'));
        // echo "\nprice has no decimal";
    } else {
        echo "price has a decimal";
    }
    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
