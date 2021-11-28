<?php

require '../config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

   


    if (empty($id) || empty($status)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $id $status";
        exit();
    } else {
        $sql;
        if(isset($_POST['note'])) {
    
            $sql = "UPDATE customer_order SET status=?, special_notes=? WHERE id=?;";

        } else {

            $sql = "UPDATE customer_order SET status=? WHERE id=?;";
        }


        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR - ORDER STATUS UPDATE";
            exit();
        } else {

            $bindFailed = false;
            if(isset($_POST['note'])) {
                $bindFailed = mysqli_stmt_bind_param($statement, 'ssi', $status, $_POST['note'], $id);
            } else {
                
                $bindFailed = mysqli_stmt_bind_param($statement, 'si', $status, $id);
            }

            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);


            echo "Order is $status Now";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
