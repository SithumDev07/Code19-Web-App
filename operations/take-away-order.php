<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['sessionId'])) {
    $userid = $_POST['sessionId'];
    $deliveryMethod = $_POST['deliveryMethod'];
    $basicPrice = $_POST['basicPrice'];
    $toppingsList = $_POST['toppingsList'];

    $status = "active";

    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());

    
    $time = substr( $date,-11, 5);
    $date = substr($date, 0, 10);

    $toppingsList = json_decode($toppingsList);
    $toppingsList = implode("', '", $toppingsList);

    $totalPriceforSelectedToppings = 0;


    if (empty($userid) || empty($deliveryMethod) || empty($basicPrice) || empty($toppingsList)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $userid $deliveryMethod";
        exit();
    } else {

        $sql = "SELECT * FROM filling WHERE id in ('$toppingsList');";

        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $totalPriceforSelectedToppings = $totalPriceforSelectedToppings + (int)$row['price'];
            }
        }

        $finalAmount = (int)$basicPrice + $totalPriceforSelectedToppings;


        $sql = "INSERT INTO customer_order(customer_id, date, time, status, delivery_method, total_amount) VALUES (?, ?, ?, ?, ?, ?);";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR";
            exit();
        } else {
            $bindFailed = mysqli_stmt_bind_param($statement, 'issssi', $userid, $date, $time, $status, $deliveryMethod, $finalAmount);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
            $newOrderIdGenerated = mysqli_stmt_insert_id($statement);

            
            // TODO Insert into filling order and food order
            

            echo "success all $newOrderIdGenerated";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
