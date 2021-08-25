<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    $string = "STAR:4";
    $string1 = "STAR:4.4";
    $string2 = "star:2.33";
    $string3 = "STAR:";

    echo strpos($string2, ':') . "<br>";
    if(is_numeric(substr($string2, (int)strpos($string2, ':') + 1, 3))) {

        $sliced = substr($string2, (int)strpos($string2, ':') + 1, 3);
        if(str_contains($sliced, '.')) {
            if(empty(substr($sliced, 2, 1))) {
                echo "Invalid rating";
            } else {
                echo substr($string2, (int)strpos($string2, ':') + 1, 3) . "<br>";
            }
        } else {
            echo substr($string2, (int)strpos($string2, ':') + 1, 3) . "<br>";
        }

    } else {
        echo " No rating is given";
    }
    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
