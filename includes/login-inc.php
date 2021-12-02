<?php

if (isset($_POST['submit'])) {

    require '../config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=empty_fields");
        exit();
    } else {
        $sql = "SELECT * FROM staff_member WHERE user_name = ?";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../login.php?error=sql_error");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, 's', $username);
            mysqli_stmt_execute($statement);

            $result = mysqli_stmt_get_result($statement);

            if ($row = mysqli_fetch_assoc($result)) {


                $passCheck = password_verify($password, $row['password']);

                if ($passCheck == false) {
                    $location = "Location: ../login.php?error=wrong_password&username=" . $username;
                    $location = str_replace(PHP_EOL, '', $location);
                    header($location);
                    exit();
                } else if ($passCheck == true) {
                    session_start();
                    $_SESSION['sessionId'] = $row['id'];
                    $_SESSION['sessionUser'] = $row['user_name'];
                    header("Location: ../dashboard.php?success=loggedin");
                    exit();
                } else {
                    $location = "Location: ../login.php?error=wrong_password&username=" . $username;
                    $location = str_replace(PHP_EOL, '', $location);
                    header($location);
                    exit();
                }
            } else {
                header("Location: ../login.php?error=user_not_found");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php?error=restricted");
    exit();
}
