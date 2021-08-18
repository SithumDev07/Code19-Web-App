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

    if (empty($fullname) || empty($lastname) || empty($address) || empty($birthday) || empty($mobile) || empty($position) || empty($shift) || empty($salary) || empty($payDate)) {
        header("Location: ../dasboard.php?error=empty_fields");
        exit();
    } else {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 3000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../photo_uploads/users/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql;

                    if(empty($email)) {
                        if(empty($landline)) {
                            $sql = "INSERT INTO staff_member(name, address, DOB, position, shift, personal_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        } else {
                            $sql = "INSERT INTO staff_member(name, address, DOB, position, shift, personal_no, LAN_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        }
                    } else {
                        if(empty($landline)) {
                            $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        } else {
                            $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, LAN_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        }
                    }
    
                    // $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, LAN_no, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $statement = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        header("Location: ../dashboard.php?signup.php&error=sql_error");
                        exit();
                    } else {
                        $fullName = $firstname . ' ' . $lastname;
                        $hashPass = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($statement, 'sssssssssss', $username, $fullName, $hashPass, $email, $address, $birthday, $position, $shift, $mobile, $landline, $fileNameNew);
                        mysqli_stmt_execute($statement);

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
    header("Location: ../dashboard.php?error=accessforbidden");
    exit();
}
