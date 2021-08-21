<?php

require '../config.php';

// TODO reset isset function
if (isset($_FILES['profileUpload'])) {
    $ingredientName = $_POST['name'];
    $supplier = $_POST['supplier'];
    $cost = $_POST['cost'];
    $paid = $_POST['paid'];
    $quantity = $_POST['quantity'];
    $MFD = $_POST['mfd'];
    $EXP = $_POST['exp'];
    $purchaseDate = $_POST['purchaseDate'];


    if (empty($name) || empty($supplier) || empty($cost) || empty($quantity) || empty($MFD) || empty($EXP) || empty($purchaseDate)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields";
        exit();
    } else {
        $sql;

        if (empty($email)) {
            if (empty($landline)) {
                $sql = "INSERT INTO staff_member(name, address, DOB, position, shift, personal_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            } else {
                $sql = "INSERT INTO staff_member(name, address, DOB, position, shift, personal_no, LAN_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }
        } else {
            if (empty($landline)) {
                $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            } else {
                $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, LAN_no, Salary, pay_date, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }
        }

        // $sql = "INSERT INTO staff_member(name, email, address, DOB, position, shift, personal_no, LAN_no, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            // header("Location: ../dashboard.php?signup.php&error=sql_error");
            echo "sql error";
            exit();
        } else {

            if (empty($email)) {
                if (empty($landline)) {
                    mysqli_stmt_bind_param($statement, 'sssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $salary, $payDate, $fileNameNew);
                    mysqli_stmt_execute($statement);
                } else {
                    mysqli_stmt_bind_param($statement, 'ssssssssss', $fullname, $address, $birthday, $position, $shift, $mobile, $landline, $salary, $payDate, $fileNameNew);
                    mysqli_stmt_execute($statement);
                }
            } else {
                if (empty($landline)) {
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
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
