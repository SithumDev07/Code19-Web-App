<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM supplier_ingredient WHERE ingredient_id=?;";

    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        // header("Location: ../dashboard.php?signup.php&error=sql_error");
        echo "sql error";
        exit();
    } else {

        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        // * Purchase Deleted

        $sql = "DELETE FROM ingredient WHERE id=?;";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            // header("Location: ../dashboard.php?signup.php&error=sql_error");
            echo "sql error";
            exit();
        } else {
            mysqli_stmt_bind_param($statement, 'i', $id);
            mysqli_stmt_execute($statement);
        }


        echo "success deleted completely";
        exit();
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
