<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    $order1 = array();
    array_push($order1, "4");
    array_push($order1, "7");
    array_push($order1, "8");
    array_push($order1, "1");

    $order2 = array();
    array_push($order2, "9");

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

    array_push($finalOrder3, "2");
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
        echo "<br>";
    }

    // TODO
    $newArray = array();
    $newArray = $Complete;

    for ($i = 0; $i < count($newArray); $i++) {
        $ingredientsIdsArrayTopping = array();
        $ingredientsQQsArrayTopping = array();
        for ($j = 0; $j < count($newArray[$i][2]); $j++) {

            
            $sql = "SELECT * FROM ingredient_filling WHERE filling_id = " . $newArray[$i][2][$j] . ";";
            $results = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($results);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    array_push($ingredientsIdsArrayTopping, $row['ingredient_id']);
                    array_push($ingredientsQQsArrayTopping, (int)$row['no_of_units'] * (int)$newArray[$i][1]);
                }
            }
        }
        array_push($newArray[$i], $ingredientsIdsArrayTopping);
        array_push($newArray[$i], $ingredientsQQsArrayTopping);
    }

    // ? Updating inventory data related to order
    // for ($i = 0; $i < count($ingredientsIdsArrayTopping); $i++) {
    //     $sql = "UPDATE ingredient SET remaining_units = ? WHERE id = ?";
    //     // $statement = mysqli_stmt_init($conn);
    //     if (!mysqli_stmt_prepare($statement, $sql)) {
    //         echo "SQL SERVER ERROR UPDATING ingredient";
    //         exit();
    //     } else {

    //         $bindFailed = mysqli_stmt_bind_param($statement, 'ii', $ingredientsQQsArrayTopping[$i], $ingredientsIdsArrayTopping[$i]);

    //         if ($bindFailed === false) {
    //             echo htmlspecialchars($statement->error);
    //             exit();
    //         }
    //         mysqli_stmt_execute($statement);
    //     }
    // }

    // ? End

    $totalPriceforSelectedToppings = 0.0;
    $totalPriceforSelectedFoods = 0.0;


    for ($i = 0; $i < count($Complete); $i++) {
        for ($j = 0; $j < count($Complete[$i][2]); $j++) {

            // echo $Complete[$i][2][$j] . " ";
            $sql = "SELECT * FROM filling WHERE id = " . $Complete[$i][2][$j] . ";";

            $results = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($results);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $totalPriceforSelectedToppings = $totalPriceforSelectedToppings + (float)$row['price'];
                }
            }
        }

        $sqlFood = "SELECT * FROM food WHERE id = " . $Complete[$i][0] . ";";

        $resultsFood = mysqli_query($conn, $sqlFood);
        $resultCheckFood = mysqli_num_rows($resultsFood);

        if ($resultCheckFood > 0) {
            while ($rowFood = mysqli_fetch_assoc($resultsFood)) {
                $totalPriceforSelectedFoods = $totalPriceforSelectedFoods + (float)$rowFood['basic_price'];
            }
        }
    }


    echo "Comple Order<br>";
    for ($i = 0; $i < count($Complete); $i++) {
        print_r($Complete[$i]);
        echo "<br>";
    }



    echo "<br>";
    echo "New Array<br>";
    for ($i = 0; $i < count($newArray); $i++) {
        print_r($newArray[$i]);
        echo "<br>";
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
