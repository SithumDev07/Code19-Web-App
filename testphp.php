<?php

if (isset($_POST['usernam'])) {

    echo $_POST['username'];
} else {
    header("Location: ../signup.php?error=accessforbidden");
    exit();
}
