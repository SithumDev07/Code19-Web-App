<?php

require '../config.php';

// TODO reset isset function
if (isset($_FILES['profileUpload'])) {
    $email = $_POST['email'];
    $fullname = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $landline = $_POST['landline'];
    $file = $_FILES['profileUpload'];

    $fileName = $_FILES['profileUpload']['name'];
    $fileTmpName = $_FILES['profileUpload']['tmp_name'];
    $fileSize = $_FILES['profileUpload']['size'];
    $fileError = $_FILES['profileUpload']['error'];
    $fileType = $_FILES['profileUpload']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (empty($fullname) || empty($address) || empty($mobile)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields";
        exit();
    } else {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 3000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../photo_uploads/suppliers/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql;

                    if(empty($email)) {
                        if(empty($landline)) {
                            $sql = "INSERT INTO supplier(name, address, photo) VALUES (?, ?, ?)";
                        } else {
                            $sql = "INSERT INTO supplier(name, address, photo) VALUES (?, ?, ?)";
                        }
                    } else {
                        if(empty($landline)) {
                            $sql = "INSERT INTO supplier(name, email, address, photo) VALUES (?, ?, ?, ?)";
                        } else {
                            $sql = "INSERT INTO supplier(name, email, address, photo) VALUES (?, ?, ?, ?)";
                        }
                    }
    
                    // $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, LAN_no, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $statement = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        // header("Location: ../dashboard.php?signup.php&error=sql_error");
                        echo "sql error";
                        exit();
                    } else {

                        if(empty($email)) {
                            if(empty($landline)) {
                                mysqli_stmt_bind_param($statement, 'sss', $fullname, $address, $fileNameNew);
                                mysqli_stmt_execute($statement);
                            } else {
                                mysqli_stmt_bind_param($statement, 'sss', $fullname, $address, $fileNameNew);
                                mysqli_stmt_execute($statement);
                            }
                        } else {
                            if(empty($landline)) {
                                mysqli_stmt_bind_param($statement, 'ssss', $fullname, $email, $address, $fileNameNew);  
                                mysqli_stmt_execute($statement);  
                            } else {
                                mysqli_stmt_bind_param($statement, 'ssss', $fullname, $email, $address, $fileNameNew);
                                mysqli_stmt_execute($statement);
                            }
                        }
                        
                        // mysqli_stmt_bind_param($statement, 'sssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $fileNameNew);
                        // mysqli_stmt_execute($statement);

                        // header("Location: ../dashboard.php?success=employee_added");
                        echo "success";
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
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
