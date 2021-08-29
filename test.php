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

    $sql;
    $results;
    $message;
    $id = $_GET['fillingid'];
    $quantity = $_GET['quantity'];

    $sql = "SELECT * FROM ingredient_filling WHERE filling_id = $id;";
    $results = mysqli_query($conn, $sql);
    $resultCheckFilling = mysqli_num_rows($results);
    $allIngredientIds = array();
    $allIngredientQuantities = array();

    if ($resultCheckFilling > 0) {
        while ($rowIngredient = mysqli_fetch_assoc($results)) {
            array_push($allIngredientIds, $rowIngredient['ingredient_id']);
            array_push($allIngredientQuantities, (int)$rowIngredient['no_of_units'] * (int)$quantity);
        }
    }

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


    echo "ING Ids<br>";
    for ($i = 0; $i < count($allIngredientIds); $i++) {
        print_r($allIngredientIds[$i]);
        echo "<br>";
    }



    echo "<br>";
    echo "QQQQQQQQQQQQ<br>";
    for ($i = 0; $i < count($allIngredientQuantities); $i++) {
        print_r($allIngredientQuantities[$i]);
        echo "<br>";
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
