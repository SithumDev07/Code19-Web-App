<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    $order1 = array();
    array_push($order1, "4");
    array_push($order1, "7");
    array_push($order1, "2");

    $order2 = array();
    array_push($order2, "2");

    $order3 = array();

    $finalOrder = array();
    $finalOrder2 = array();
    $finalOrder3 = array();

    array_push($finalOrder, "4");
    array_push($finalOrder, "10");
    array_push($finalOrder, $order1);

    array_push($finalOrder2, "1");
    array_push($finalOrder2, "5");
    array_push($finalOrder2, $order2);

    array_push($finalOrder3, "7");
    array_push($finalOrder3, "1");
    array_push($finalOrder3, $order3);

    $Complete = array();

    array_push($Complete, $finalOrder);
    array_push($Complete, $finalOrder2);
    array_push($Complete, $finalOrder3);

    for ($i = 0; $i < count($Complete); $i++) {
        for ($j = 0; $j < count($Complete[$i][2]); $j++) {
            echo $Complete[$i][2][$j] . " ";
        }
        // echo "<br>";
    }


    $totalPriceforSelectedToppings = 0.0;
    $totalPriceforSelectedFoods = 0.0;

    for ($i = 0; $i < count($Complete); $i++) {
        for ($j = 0; $j < count($Complete[$i][2]); $j++) {

            echo $Complete[$i][2][$j] . " ";
            $sql = "SELECT * FROM filling WHERE id = $Complete[$i][2][$j]";

            $results = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($results);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $totalPriceforSelectedToppings = $totalPriceforSelectedToppings + (float)$row['price'];
                }
            }
        }

        $sqlFood = "SELECT * FROM food WHERE id = $Complete[$i][0]";

        $resultsFood = mysqli_query($conn, $sqlFood);
        $resultCheckFood = mysqli_num_rows($resultsFood);

        if ($resultCheckFood > 0) {
            while ($rowFood = mysqli_fetch_assoc($resultsFood)) {
                $totalPriceforSelectedFoods = $totalPriceforSelectedFoods + (float)$rowFood['basic_price'];
            }
        }
    }



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

            for ($i = 0; $i < count($Complete); $i++) {

                $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $newGeneratedOrderId, $Complete[$i][0], $Complete[$i][1]);

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

            for ($i = 0; $i < count($Complete); $i++) {
                for ($j = 0; $j < count($Complete[$i][2]); $j++) {

                    $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $newGeneratedOrderId, $Complete[$i][2][$j], $Complete[$i][1]);

                    if ($bindFailed === false) {
                        echo htmlspecialchars($statement->error);
                        exit();
                    }
                    mysqli_stmt_execute($statement);
                }
            }
        }
    }



    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
