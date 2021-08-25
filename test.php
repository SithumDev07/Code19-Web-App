<?php

require './config.php';

// TODO reset isset function
if (isset($_GET['id'])) {

    $ingredientIds = array();
    $ingredientQuantities = array();

    array_push($ingredientIds, 15);
    array_push($ingredientQuantities, 20);
    array_push($ingredientIds, 4);
    array_push($ingredientQuantities, 65);
    array_push($ingredientIds, 1);
    array_push($ingredientQuantities, 150);
    array_push($ingredientIds, 12);
    array_push($ingredientQuantities, 580);
    array_push($ingredientIds, 7);
    array_push($ingredientQuantities, 100);
    
    $currentIngredientIds = array();
    $currentUnits = array();

    // ? Quantity Updating Array
    $quantityUpdate = array();
    $quantityUpdateIds = array();
    $foodId = $_GET['id'];
    
    // ?Inserting
    $insertingIds = array();
    $insertingQuantities = array();
    $insertingPositions = array();

   


    // ? Display sorted array
    echo "<br><br>" . "Before Sorted <br>";
    for ($i=0; $i < count($ingredientIds); $i++) { 
        echo " IID - " . $ingredientIds[$i];
        echo " IQ - " . $ingredientQuantities[$i] . "<br>";
    }
    


    // ? Sorting the client data arrays
    for ($i=0; $i < count($ingredientIds); $i++) { 
        for ($j=0; $j < count($ingredientIds) - 1; $j++) { 
            
            if($ingredientIds[$j] > $ingredientIds[$j+1]) {
                $temp = $ingredientIds[$j+1];
                $tempQuantity = $ingredientQuantities[$j+1];
                $ingredientIds[$j+1] = $ingredientIds[$j];
                $ingredientQuantities[$j+1] = $ingredientQuantities[$j];
                $ingredientIds[$j] = $temp;
                $ingredientQuantities[$j] = $tempQuantity;
            }

        }
    }

    // ? Display sorted array
    echo "<br><br>" . "After Sorted <br>";
    for ($i=0; $i < count($ingredientIds); $i++) { 
        echo " IID - " . $ingredientIds[$i];
        echo " IQ - " . $ingredientQuantities[$i] . "<br>";
    }


     // ? Getting previous ingredients data
     echo "<br><br>" . "DB Data <br>";
     $sql = " SELECT * FROM food JOIN ingredient_food ON ingredient_food.food_id = food.id WHERE food.id = " . $foodId .";";
     $results = mysqli_query($conn, $sql);
     $resultCheck = mysqli_num_rows($results);
     if ($resultCheck > 0) {
         while ($row = mysqli_fetch_assoc($results)) {
             echo " IID - " . $row['ingredient_id'];
             array_push($currentIngredientIds, $row['ingredient_id']);
             echo " IQ - " . $row['no_of_units'] . "<br>";
             array_push($currentUnits, $row['no_of_units']);
         }
     }
     // ?
    
    
    // ? What should insert
    echo "<br><br>" . "Inserting <br>";
    $difference = array_diff($ingredientIds, $currentIngredientIds);
    
    foreach ($difference as $key => $value) {
        echo $value . "<br>";

        array_push($insertingIds, $value);


        if(array_search($value, $ingredientIds) != '') {
            array_push($insertingPositions, array_search($value, $ingredientIds));
        }
    }

    //  ? Getting inserting quantities
    for ($i=0; $i < count($insertingPositions); $i++) { 
        $pos = $insertingPositions[$i];
        array_push($insertingQuantities, $ingredientQuantities[$pos]);
    }

    // ? Display sorted array
    echo "<br><br>" . "Insertintg data <br>";
    for ($i=0; $i < count($insertingIds); $i++) { 
        echo " IID - " . $insertingIds[$i];
        echo " IQ - " . $insertingQuantities[$i] . "<br>";
    }
    
    
    // ? What should delete
    echo "<br><br>" . "Deleting <br>";
    $difference = array_diff($currentIngredientIds, $ingredientIds);
    
    foreach ($difference as $key => $value) {
        echo $value . "<br>";
        
    }


    echo "<br><br>" . "Updating <br>";
    // ?? First Case - When Current Ingredients array is larger
    for ($i=0; $i < count($currentIngredientIds); $i++) { 
        if(array_search($currentIngredientIds[$i], $ingredientIds) != '') {
            array_push($quantityUpdateIds, array_search($currentIngredientIds[$i], $ingredientIds));
        }
    }
    
    // ? Should Updated Ingredient IDs 
    $shouldUpdated = array();
    for ($i=0; $i < count($quantityUpdateIds); $i++) { 
        $value = $quantityUpdateIds[$i];
        array_push($shouldUpdated, $ingredientIds[$value]);
        array_push($quantityUpdate, $ingredientQuantities[$value]);
    }
    
    
    // ? Display sorted array
    echo "<br><br>" . "After Updated <br>";
    for ($i=0; $i < count($shouldUpdated); $i++) { 
        echo " IID - " . $shouldUpdated[$i];
        echo " IQ - " . $quantityUpdate[$i] . "<br>";
    }
    
    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
