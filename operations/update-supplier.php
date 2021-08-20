<?php

require '../config.php';

// TODO insert in mobile fields
if (isset($_POST['id'])) {
    $email = $_POST['email'];
    $fullname = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $landline = $_POST['landline'];
    $id = $_POST['id'];
    $prevFile = $_POST['prev_file'];
    

    if (empty($fullname) || empty($address) || empty($mobile)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields";
        exit();
    } else {
        if(isset($_FILES['profileUpload']['name'])){
            $file = $_FILES['profileUpload'];
            $fileName = $_FILES['profileUpload']['name'];
            $fileTmpName = $_FILES['profileUpload']['tmp_name'];
            $fileSize = $_FILES['profileUpload']['size'];
            $fileError = $_FILES['profileUpload']['error'];
            $fileType = $_FILES['profileUpload']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 3000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../photo_uploads/suppliers/' . $fileNameNew;
                        $prevFileDestination = '../photo_uploads/suppliers/' . $prevFile;
                        if (!unlink($prevFileDestination)) { 
                            echo ("$prevFileDestination cannot be deleted due to an error"); 
                        } 
                        else { 
                            echo ("$prevFileDestination has been deleted"); 
                        } 
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $sql;
    
                        if(empty($email)) {
                            if(empty($landline)) {
                                $sql = "UPDATE supplier SET name=?, address=?, photo=? WHERE id=?;";
                            } else {
                                $sql = "UPDATE supplier SET name=?, address=?, photo=? WHERE id=?;";
                            }
                        } else {
                            if(empty($landline)) {
                                $sql = "UPDATE supplier SET name=?, email=?, address=?, photo=? WHERE id=?;";
                            } else {
                                $sql = "UPDATE supplier SET name=?, email=?, address=?, photo=? WHERE id=?;";
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
                                    mysqli_stmt_bind_param($statement, 'sssi', $fullname, $address, $fileNameNew, $id);
                                    mysqli_stmt_execute($statement);
                                } else {
                                    mysqli_stmt_bind_param($statement, 'sssi', $fullname, $address, $fileNameNew, $id);
                                    mysqli_stmt_execute($statement);
                                }
                            } else {
                                if(empty($landline)) {
                                    mysqli_stmt_bind_param($statement, 'ssssi', $fullname, $email, $address, $fileNameNew, $id);  
                                    mysqli_stmt_execute($statement);  
                                } else {
                                    mysqli_stmt_bind_param($statement, 'ssssi', $fullname, $email, $address, $fileNameNew, $id);
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
                echo "You can't upload files of " . $fileActualExt . " type " . $fileName;
            }
        } else {
            if(empty($email)) {
                if(empty($landline)) {
                    $sql = "UPDATE supplier SET name=?, address=?, photo=? WHERE id=?;";
                } else {
                    $sql = "UPDATE supplier SET name=?, address=?, photo=? WHERE id=?;";
                }
            } else {
                if(empty($landline)) {
                    $sql = "UPDATE supplier SET name=?, email=?, address=?, photo=? WHERE id=?;";
                } else {
                    $sql = "UPDATE supplier SET name=?, email=?, address=?, photo=? WHERE id=?;";
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
                        mysqli_stmt_bind_param($statement, 'sssi', $fullname, $address, $prevFile, $id);
                        mysqli_stmt_execute($statement);
                    } else {
                        mysqli_stmt_bind_param($statement, 'sssi', $fullname, $address, $prevFile, $id);
                        mysqli_stmt_execute($statement);
                    }
                } else {
                    if(empty($landline)) {
                        mysqli_stmt_bind_param($statement, 'ssssi', $fullname, $email, $address, $prevFile, $id);  
                        mysqli_stmt_execute($statement);  
                    } else {
                        mysqli_stmt_bind_param($statement, 'ssssi', $fullname, $email, $address, $prevFile, $id);
                        mysqli_stmt_execute($statement);
                    }
                }
                
                // mysqli_stmt_bind_param($statement, 'sssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $fileNameNew);
                // mysqli_stmt_execute($statement);

                // header("Location: ../dashboard.php?success=employee_added");
                echo "success";
                exit();
            }
        }
        
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
