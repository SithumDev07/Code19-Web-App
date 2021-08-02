<?php


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmedPassword = $_POST['confirmPassword'];

    if (empty($username) || empty($email) || empty($password) || empty($confirmedPassword)) {
        header("Location: ../signup.php?error=username is required");
        exit();
    }
} else {
    header("Location: ../signup.php?error=accessforbidden");
    exit();
}
