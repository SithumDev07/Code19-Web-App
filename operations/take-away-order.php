<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['sessionId'])) {

    $userid = $_POST['sessionId'];
    $deliverycharges = $_POST['deliverycharges'];
    $finalOrder = $_POST['finalOrder'];

    $status = "active";
    $deliveryMethod = "takeaway";

    date_default_timezone_set('Asia/Colombo');
    $date = date('m/d/Y h:i:s a', time());


    $time = substr($date, -11, 5);
    $date = substr($date, 0, 10);


    $finalOrder = json_decode($finalOrder);

    if (empty($userid) || empty($finalOrder)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $userid";
        exit();
    } else {

        $totalPriceforSelectedToppings = 0.0;
        $totalPriceforSelectedFoods = 0.0;

        for ($i=0; $i < count($finalOrder); $i++) { 
            print_r($finalOrder[$i][2]) . "<br>";
        }

        for ($i = 0; $i < count($finalOrder); $i++) {
            for ($j = 0; $j < count($finalOrder[$i][2]); $j++) {

                $sql = "SELECT * FROM filling WHERE id = " . $finalOrder[$i][2][$j] .";";

                $results = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($results);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $totalPriceforSelectedToppings = $totalPriceforSelectedToppings + (float)$row['price'] * (int)$finalOrder[$i][1];
                    }
                }
            }

            $sqlFood = "SELECT * FROM food WHERE id = " . $finalOrder[$i][0]. ";";

            $resultsFood = mysqli_query($conn, $sqlFood);
            $resultCheckFood = mysqli_num_rows($resultsFood);

            if ($resultCheckFood > 0) {
                while ($rowFood = mysqli_fetch_assoc($resultsFood)) {
                    $totalPriceforSelectedFoods = $totalPriceforSelectedFoods + (float)$rowFood['basic_price'] * (int)$finalOrder[$i][1];
                }
            }
        }

        $finalAmount = $totalPriceforSelectedFoods + $totalPriceforSelectedToppings + (float)$deliverycharges;

        // ? Inserting data into customer_order
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
            // ? Inserting data into food_order
            $sql = "INSERT INTO food_order(order_id, food_id, quantity) VALUES (?, ?, ?)";
            // $statement = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "SQL SERVER ERROR FOOD";
                exit();
            } else {

                for ($i = 0; $i < count($finalOrder); $i++) {

                    $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $newOrderIdGenerated, $finalOrder[$i][0], $finalOrder[$i][1]);

                    if ($bindFailed === false) {
                        echo htmlspecialchars($statement->error);
                        exit();
                    }
                    mysqli_stmt_execute($statement);
                }
            }

            // ? Inserting data into filling_order
            $sql = "INSERT INTO filling_order(order_id, filling_id, quantity) VALUES (?, ?, ?)";
            // $statement = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "SQL SERVER ERROR FILLING";
                exit();
            } else {

                for ($i = 0; $i < count($finalOrder); $i++) {
                    for ($j = 0; $j < count($finalOrder[$i][2]); $j++) {

                        $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $newOrderIdGenerated, $finalOrder[$i][2][$j], $finalOrder[$i][1]);

                        if ($bindFailed === false) {
                            echo htmlspecialchars($statement->error);
                            exit();
                        }
                        mysqli_stmt_execute($statement);
                    }
                }
            }


            echo "success all $newOrderIdGenerated $userid $finalAmount";
            exit();
        }
    }



} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
