<?php 

if(isset($_POST['username'])) {

    require '../config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        echo "Empty Fields";
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE username = ?";
        $statement = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL Server Error";
            exit();
        } else {
            mysqli_stmt_bind_param($statement, 's', $username);
            mysqli_stmt_execute($statement);

            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)) {

                $passCheck = password_verify($password, $row['password']);

                if($passCheck == false) {
                    echo "Wrong Password";
                    exit();
                } else if($passCheck == true) {
                    session_start();
                    $_SESSION['sessionId'] = $row['id'];
                    $_SESSION['sessionUser'] = $row['username'];
                    echo "Success";
                    exit();
                } else {
                    echo "Wrong Password";
                    exit();
                }

            } else {
                echo "User Not Found";
                exit();
            }
        }
    }

} else {
    echo "Restricted";
    exit();
}
