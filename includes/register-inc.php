<?php


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
    $file = $_POST['profileUpload'];

    $fileName = $_FILES['Image']['name'];
    $fileTmpName = $_FILES['Image']['tmp_name'];
    $fileSize = $_FILES['Image']['size'];
    $fileError = $_FILES['Image']['error'];
    $fileType = $_FILES['Image']['type'];

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
                        mysqli_stmt_bind_param($statement, 'sssssssssss', $username, $fullName, $password, $email, $address, $birthday, $position, $shift, $mobile, $landline, $fileNameNew);
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
    header("Location: ../signup.php?error=accessforbidden");
    exit();
}
