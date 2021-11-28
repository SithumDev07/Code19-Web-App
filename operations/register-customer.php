<?php

require '../config.php';


if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $fullName = $_POST['fullName'];
    $password = $_POST['password'];


    if (empty($username) || empty($fullName) || empty($password)) {
        echo "empty fields";
        exit();
    } else {


        $sql = "SELECT * FROM customer WHERE username = '" . $username . "';";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            echo "Username is already taken";
            exit();
        } else {
            $hashPass = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO customer(username, password, name) VALUES (?, ?, ?)";

            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "sql error";
                exit();
            } else {

                $bindFailed = mysqli_stmt_bind_param($statement, 'sss', $username, $hashPass, $fullName);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
                $newCustomerIdGenerated = mysqli_stmt_insert_id($statement);
                session_start();
                $_SESSION['sessionId'] = $newCustomerIdGenerated;
                $_SESSION['sessionUser'] = $username;
                echo "Successfully Registered";
                exit();
            }
        }
    }
} else {
    echo "main error";
    exit();
}
