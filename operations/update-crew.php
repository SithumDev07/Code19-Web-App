<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {
    $email = $_POST['email'];
    $fullname = $_POST['name'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $mobile = $_POST['mobile'];
    $landline = $_POST['landline'];
    $position = $_POST['position'];
    $shift = $_POST['shift'];
    $salary = $_POST['salary'];
    $payDate = $_POST['payDate'];
    $id = $_POST['id'];
    $prevFile = $_POST['prev_file'];
    

    if (empty($fullname) || empty($address) || empty($birthday) || empty($mobile) || empty($position) || empty($shift) || empty($salary) || empty($payDate)) {
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
                        $fileDestination = '../photo_uploads/users/' . $fileNameNew;
                        $prevFileDestination = '../photo_uploads/users/' . $prevFile;
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
                                $sql = "UPDATE staff_member SET name=?, address=?, DOB=?, position=?, shift=?, personal_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                            } else {
                                $sql = "UPDATE staff_member SET name=?, address=?, DOB=?, position=?, shift=?, personal_no=?, LAN_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                            }
                        } else {
                            if(empty($landline)) {
                                $sql = "UPDATE staff_member SET name=?, email=?, address=?, DOB=?, position=?, shift=?, personal_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                            } else {
                                $sql = "UPDATE staff_member SET name=?, email=?, address=?, DOB=?, position=?, shift=?, personal_no=?, LAN_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
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
                                    mysqli_stmt_bind_param($statement, 'sssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $salary, $payDate, $fileNameNew);
                                    mysqli_stmt_execute($statement);
                                } else {
                                    mysqli_stmt_bind_param($statement, 'ssssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $fileNameNew);
                                    mysqli_stmt_execute($statement);
                                }
                            } else {
                                if(empty($landline)) {
                                    mysqli_stmt_bind_param($statement, 'ssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $salary, $payDate, $fileNameNew);  
                                    mysqli_stmt_execute($statement);  
                                } else {
                                    mysqli_stmt_bind_param($statement, 'sssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $fileNameNew);
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
                    $sql = "UPDATE staff_member SET name=?, address=?, DOB=?, position=?, shift=?, personal_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                } else {
                    $sql = "UPDATE staff_member SET name=?, address=?, DOB=?, position=?, shift=?, personal_no=?, LAN_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                }
            } else {
                if(empty($landline)) {
                    $sql = "UPDATE staff_member SET name=?, email=?, address=?, DOB=?, position=?, shift=?, personal_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
                } else {
                    $sql = "UPDATE staff_member SET name=?, email=?, address=?, DOB=?, position=?, shift=?, personal_no=?, LAN_no=?, Salary=?, pay_date=?, photo=? WHERE id=?;";
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
                        mysqli_stmt_bind_param($statement, 'sssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $salary, $payDate, $prevFile);
                        mysqli_stmt_execute($statement);
                    } else {
                        mysqli_stmt_bind_param($statement, 'ssssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $prevFile);
                        mysqli_stmt_execute($statement);
                    }
                } else {
                    if(empty($landline)) {
                        mysqli_stmt_bind_param($statement, 'ssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $salary, $payDate, $prevFile);  
                        mysqli_stmt_execute($statement);  
                    } else {
                        mysqli_stmt_bind_param($statement, 'sssssssssss', $fullname, $email, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $prevFile);
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
