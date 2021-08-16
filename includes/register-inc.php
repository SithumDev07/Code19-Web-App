<?php

require '../config.php';


if (isset($_POST['final'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $mobile = $_POST['mobile'];
    $landline = $_POST['landline'];
    $position = $_POST['position'];
    $shift = $_POST['shift'];
    $file = $_FILES['profileUpload'];

    $fileName = $_FILES['profileUpload']['name'];
    $fileTmpName = $_FILES['profileUpload']['tmp_name'];
    $fileSize = $_FILES['profileUpload']['size'];
    $fileError = $_FILES['profileUpload']['error'];
    $fileType = $_FILES['profileUpload']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (empty($username) || empty($email) || empty($password) || empty($firstname) || empty($lastname) || empty($address) || empty($birthday) || empty($mobile) || empty($landline) || empty($position) || empty($shift)) {
        header("Location: ../signup.php?error=empty_fields");
        exit();
    } else {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 3000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../photo_uploads/users/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
    
                    $sql = "INSERT INTO staff_member(user_name, name, password, email, address, DOB, position, shift, personal_no, LAN_no, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $statement = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        header("Location: ../index.php?signup.php&error=sql_error");
                        exit();
                    } else {
                        $fullName = $firstname . ' ' . $lastname;
                        $hashPass = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($statement, 'sssssssssss', $username, $fullName, $hashPass, $email, $address, $birthday, $position, $shift, $mobile, $landline, $fileNameNew);
                        mysqli_stmt_execute($statement);

                        session_start();
                        $_SESSION['sessionId'] = 1;
                        $_SESSION['sessionUser'] = $username;
                        header("Location: ../dashboard.php?success=registered");
                        exit();
                    }
                
                } else {
                    echo "File is too large.";
                }
            } else {
                echo "There was an error.";
            }
        } else {
            echo "You cannot upload files of " . $fileActualExt . " type";
        }
    }
} else {
    header("Location: ../signup.php?error=accessforbidden");
    exit();
}
