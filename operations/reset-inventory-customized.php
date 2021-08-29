<?php

include '../config.php';


if (isset($_POST['quantity'])) {

    $sql;
    $results;
    $message;
    $quantity = $_POST['quantity'];
    $currentlySelected = $_POST['selectedToppings'];
    $currentlySelected = json_decode($currentlySelected);

    $allIngredientIds = array();
    $allIngredientQuantities = array();
    for ($i = 0; $i < count($currentlySelected); $i++) {

        $sql = "SELECT * FROM ingredient_filling WHERE filling_id = " . $currentlySelected[$i] . ";";
        $results = mysqli_query($conn, $sql);
        $resultCheckFilling = mysqli_num_rows($results);

        if ($resultCheckFilling > 0) {
            while ($rowIngredient = mysqli_fetch_assoc($results)) {
                array_push($allIngredientIds, $rowIngredient['ingredient_id']);
                array_push($allIngredientQuantities, (int)$rowIngredient['no_of_units'] * (int)$quantity);
            }
        }
    }

    // ? Getting current remaining units
    $currentStockIngredients = 0;
    for ($i = 0; $i < count($allIngredientIds); $i++) {
        $sql = "SELECT * FROM ingredient WHERE id = " . $allIngredientIds[$i] . ";";
        $results = mysqli_query($conn, $sql);
        $resultCheckFilling = mysqli_num_rows($results);

        if ($resultCheckFilling > 0) {
            while ($rowIngredient = mysqli_fetch_assoc($results)) {
                // array_push($currentStockIngredients, $rowIngredient['remaining_units']);
                $currentStockIngredients = (int)$rowIngredient['remaining_units'];
            }
        }


        // ? Updating data in ingredient
        $sql = "UPDATE ingredient SET remaining_units = ? WHERE id = ?;";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR FOOD";
            exit();
        } else {
            $newUnits = $currentStockIngredients + $allIngredientQuantities[$i];
            
            $bindFailed = mysqli_stmt_bind_param($statement, 'ii', $newUnits, $allIngredientIds[$i]);
            
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }
    }

    echo "reset successfully";
    exit();


} else {
    echo 'Something went wrong';
}
?>