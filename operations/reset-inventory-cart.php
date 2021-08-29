<?php

include '../config.php';

function updateInventory($conn, $allIngredientIds, $allIngredientQuantities)
{
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
}


if (isset($_POST['completeorder'])) {

    $sql;
    $results;
    $message;
    $completeorder = $_POST['completeorder'];
    $completeorder = json_decode($completeorder);


    $allIngredientIds = array();
    $allIngredientQuantities = array();
    for ($i = 0; $i < count($completeorder); $i++) {
        for ($j = 0; $j < count($completeorder[$i][2]); $j++) {
            $sql = "SELECT * FROM ingredient_filling WHERE filling_id = " . $completeorder[$i][2][$j] . ";";
            $results = mysqli_query($conn, $sql);
            $resultCheckFilling = mysqli_num_rows($results);

            $quantity = $completeorder[$i][1];

            if ($resultCheckFilling > 0) {
                while ($rowIngredient = mysqli_fetch_assoc($results)) {
                    array_push($allIngredientIds, $rowIngredient['ingredient_id']);
                    array_push($allIngredientQuantities, (int)$rowIngredient['no_of_units'] * (int)$quantity);
                }
            }
        }
        updateInventory($conn, $allIngredientIds, $allIngredientQuantities);
    }

    // for ($i = 0; $i < count($currentlySelected); $i++) {
        
        //     $sql = "SELECT * FROM ingredient_filling WHERE filling_id = " . $currentlySelected[$i] . ";";
        //     $results = mysqli_query($conn, $sql);
        //     $resultCheckFilling = mysqli_num_rows($results);
        
        //     if ($resultCheckFilling > 0) {
            //         while ($rowIngredient = mysqli_fetch_assoc($results)) {
                //             array_push($allIngredientIds, $rowIngredient['ingredient_id']);
                //             array_push($allIngredientQuantities, (int)$rowIngredient['no_of_units'] * (int)$quantity);
                //         }
                //     }
                // }
                
              
                // TODO
    // $allIngredientIds = array();
    // $allIngredientQuantities = array();
    // for ($i=0; $i < count($completeorder); $i++) { 
    //     if ($completeorder[$i][1] != 0) {
    //         // ? Resetting Food Update
    //         $allIngredientIds = array();
    //         $allIngredientQuantities = array();
    //         $sql = "SELECT * FROM ingredient_food WHERE food_id = " . $completeorder[$i][0] . ";";
    //         $results = mysqli_query($conn, $sql);
    //         $resultCheckFilling = mysqli_num_rows($results);
    
    //         $quantity = $completeorder[$i][1];
    //         if ($resultCheckFilling > 0) {
    //             while ($rowIngredient = mysqli_fetch_assoc($results)) {
    //                 array_push($allIngredientIds, $rowIngredient['ingredient_id']);
    //                 array_push($allIngredientQuantities, (int)$rowIngredient['no_of_units'] * (int)$quantity);
    //             }
    //         }
    //         updateInventory($conn, $allIngredientIds, $allIngredientQuantities);
    //     }
    // }

    

    echo "reset successfully";
    exit();
} else {
    echo 'Something went wrong';
}
