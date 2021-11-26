<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
