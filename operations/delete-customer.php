<?php

require '../config.php';


// TODO insert in mobile fields
if (isset($_POST['sessionId'])) {

    $id = $_POST['sessionId'];

    if (empty($id)) {
        echo "EMPTY FIELDS $id";
        exit();
    } else {

        $orderIds = array();
        // ? Getting realted all the order ids
        $sql = "SELECT * FROM customer_order WHERE customer_id = " . $id . ";";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                array_push($orderIds, $row['id']);
            }
        }

        // ? Getting current photo if have
        $sql = "SELECT * FROM customer WHERE id = " . $id . ";";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);
        $currentPhoto;

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $currentPhoto = $row['photo'];
            }
        }


        $statement = mysqli_stmt_init($conn);
        // ? Deleting corder id related filling_orders
        $sql = "DELETE FROM filling_order WHERE order_id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete filling";
            exit();
        } else {

            for ($i = 0; $i < count($orderIds); $i++) {
                $bindFailed = mysqli_stmt_bind_param($statement, 'i', $orderIds[$i]);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }
        }


        // ? Deleting corder id related food_orders
        $sql = "DELETE FROM food_order WHERE order_id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete food";
            exit();
        } else {

            for ($i = 0; $i < count($orderIds); $i++) {
                $bindFailed = mysqli_stmt_bind_param($statement, 'i', $orderIds[$i]);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }
        }


        // ? Deleting orders related to the user
        $sql = "DELETE FROM customer_order WHERE id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete order";
            exit();
        } else {

            for ($i = 0; $i < count($orderIds); $i++) {
                $bindFailed = mysqli_stmt_bind_param($statement, 'i', $orderIds[$i]);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }
        }


        // ? Deleting user addresses
        $sql = "DELETE FROM customer_address WHERE customer_id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete address";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $id);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }


        // ? Deleting user phone numbers
        $sql = "DELETE FROM customer_phone WHERE customer_id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete phone";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $id);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }


        // ? Deleting user
        $sql = "DELETE FROM customer WHERE id = ?";

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error delete user";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $id);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }

        if ($currentPhoto != null) {
            $currentPhotoLocation = '../photo_uploads/customers/' . $currentPhoto;
            if (!unlink($currentPhotoLocation)) {
                echo ("$currentPhotoLocation cannot be deleted due to an error");
            } else {
                echo ("$currentPhotoLocation has been deleted");
            }
        }

        echo "successfully deleted everything";
        exit();
    }
} else {
    echo "main error";
    exit();
}
