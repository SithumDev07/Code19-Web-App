<?php

require '../config.php';

if (isset($_POST['cardid'])) {
    $cardid = $_POST['cardid'];


    if (empty($cardid)) {
        echo "empty fields $cardid";
        exit();
    } else {

        $sql = "DELETE FROM paymentmethod WHERE id=?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR - PAYMENT DELETE";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $cardid);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);


            echo "successfully deleted";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
