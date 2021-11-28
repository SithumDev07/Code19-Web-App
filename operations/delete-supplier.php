<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $prevFile = $_POST['prev_file'];

    // * Resources Cleaning
    $prevFileDestination = '../photo_uploads/suppliers/' . $prevFile;

    $sql = "DELETE FROM supplier_contact WHERE id=?;";

    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        // header("Location: ../dashboard.php?signup.php&error=sql_error");
        echo "sql error";
        exit();
    } else {

        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        // * Contact Deleted

        $sql = "DELETE FROM supplier WHERE id=?;";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            // header("Location: ../dashboard.php?signup.php&error=sql_error");
            echo "sql error";
            exit();
        } else {
            mysqli_stmt_bind_param($statement, 'i', $id);
            mysqli_stmt_execute($statement);
        }

        if (!unlink($prevFileDestination)) {
            echo ("$prevFileDestination cannot be deleted due to an error");
        } else {
            echo ("$prevFileDestination has been deleted");
        }


        echo "success deleted completely";
        exit();
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
