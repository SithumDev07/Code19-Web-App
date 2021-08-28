<?php

require '../config.php';


// TODO insert in mobile fields
if (isset($_POST['sessionId'])) {
    $id = $_POST['sessionId'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    function updateAddress($conn, $id, $address)
    {
        // ? Updating Customer Address
        $sql = "SELECT * FROM customer_address WHERE customer_id = " . $id . ";";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {

            $sql = "UPDATE customer_address SET address = ? WHERE customer_id = ?";
            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "sql error";
                exit();
            } else {
                $bindFailed = mysqli_stmt_bind_param($statement, 'si', $address, $id);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }
        } else {
            $sql = "INSERT INTO customer_address(customer_id, address) VALUES(?, ?)";
            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "sql error";
                exit();
            } else {
                $bindFailed = mysqli_stmt_bind_param($statement, 'is', $id, $address);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }
        }
    }



    if (empty($id) || empty($fullname)) {
        echo "EMPTY FIELDS $id $fullname";
        exit();
    } else {

        if(empty($address)) {
            $address = " ";
        }

        if(empty($phone)) {
            $phone = " ";
        }

        if (isset($_FILES['profileCustomer']['name'])) {
            $file = $_FILES['profileCustomer'];
            $fileName = $_FILES['profileCustomer']['name'];
            $fileTmpName = $_FILES['profileCustomer']['tmp_name'];
            $fileSize = $_FILES['profileCustomer']['size'];
            $fileError = $_FILES['profileCustomer']['error'];
            $fileType = $_FILES['profileCustomer']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 3000000) {

                        $prevFile;
                        // ? Getting Prev file name from DB
                        $sql = "SELECT * FROM customer WHERE id = " . $id . ";";
                        $results = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($results);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($results)) {
                                $prevFile = $row['photo'];
                            }
                        }

                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../photo_uploads/customers/' . $fileNameNew;

                        if ($prevFile !== null) {
                            $prevFileDestination = '../photo_uploads/customers/' . $prevFile;
                            if (!unlink($prevFileDestination)) {
                                echo ("$prevFileDestination cannot be deleted due to an error");
                            } else {
                                echo ("$prevFileDestination has been deleted");
                            }
                        }

                        move_uploaded_file($fileTmpName, $fileDestination);

                        $sql = "UPDATE customer SET name =?, photo = ? WHERE id = ?";

                        $statement = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            // header("Location: ../dashboard.php?signup.php&error=sql_error");
                            echo "sql error";
                            exit();
                        } else {

                            $bindFailed = mysqli_stmt_bind_param($statement, 'ssi', $fullname, $fileNameNew, $id);
                            if ($bindFailed === false) {
                                echo htmlspecialchars($statement->error);
                                exit();
                            }
                            mysqli_stmt_execute($statement);

                            // ? Calling Update Address Function
                            updateAddress($conn, $id, $address);

                            echo "successfully updated with image";
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
            $sql = "UPDATE customer SET name =? WHERE id = ?";

            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "sql error";
                exit();
            } else {

                $bindFailed = mysqli_stmt_bind_param($statement, 'si', $fullname, $id);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);

                // ? Calling Update Address Function
                updateAddress($conn, $id, $address);

                echo "successfully updated without image";
                exit();
            }
        }
    }
} else {
    echo "main error";
    exit();
}
