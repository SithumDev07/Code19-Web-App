<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {
    $foodname = $_POST['foodname'];
    $fooddescription = $_POST['fooddescription'];
    $basicprice = $_POST['basicprice'];
    $preptime = $_POST['preptime'];
    $ingredientIds = $_POST['ingredientIds'];
    $ingredientQuantities = $_POST['ingredientQuantities'];
    $toppingIds = $_POST['toppingIds'];
    $foodId = $_POST['id'];

    $ingredientIds = json_decode($ingredientIds);
    $ingredientQuantities = json_decode($ingredientQuantities);
    $toppingIds = json_decode($toppingIds);


    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    $prevFile;

    $currentIngredientIds = array();
    $currentUnits = array();

    // ? Quantity Updating Array
    $quantityUpdateIds = array();
    $quantityUpdate = array(); // ? Final Updating Quantities
    $shouldUpdated = array(); // ? Final Updating ids
    
    // ?Inserting
    $insertingIds = array(); // ?? Final Inserting Ids
    $insertingQuantities = array(); // ? Final Inserting Quantities
    $insertingPositions = array();

    // ? Deleting
    $deletingIds = array(); // ? Final Deleting Ids

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

     // ? Getting previous ingredients data
     $sql = " SELECT * FROM food JOIN ingredient_food ON ingredient_food.food_id = food.id WHERE food.id = " . $foodId .";";
     $results = mysqli_query($conn, $sql);
     $resultCheck = mysqli_num_rows($results);
     if ($resultCheck > 0) {
         while ($row = mysqli_fetch_assoc($results)) {
             array_push($currentIngredientIds, $row['ingredient_id']);
             array_push($currentUnits, $row['no_of_units']);
             $prevFile = $row['photo'];
         }
     }
     // ?

         // ? What should insert
    $difference = array_diff($ingredientIds, $currentIngredientIds);
    
    foreach ($difference as $key => $value) {

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

    // ? What should delete
    $difference = array_diff($currentIngredientIds, $ingredientIds);
    
    foreach ($difference as $key => $value) {
        array_push($deletingIds, $value);
        
    }

    
    // ?? First Case - When Current Ingredients array is larger
    for ($i=0; $i < count($currentIngredientIds); $i++) { 
        if(array_search($currentIngredientIds[$i], $ingredientIds) != '') {
            array_push($quantityUpdateIds, array_search($currentIngredientIds[$i], $ingredientIds));
        }
    }
    
    // ? Should Updated Ingredient IDs 
    
    for ($i=0; $i < count($quantityUpdateIds); $i++) { 
        $value = $quantityUpdateIds[$i];
        array_push($shouldUpdated, $ingredientIds[$value]);
        array_push($quantityUpdate, $ingredientQuantities[$value]);
    }


    // TODO Add validation on toppings ids later
    if (empty($foodId) ||empty($foodname) || empty($basicprice) || empty($ingredientIds) || empty($ingredientQuantities)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $foodId $foodname $basicprice";
        exit();
    } else {

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 3000000) {

                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../photo_uploads/foods/' . $fileNameNew;
                    $prevFileDestination = '../photo_uploads/foods/' . $prevFile;
                    if (!unlink($prevFileDestination)) {
                        echo ("$prevFileDestination cannot be deleted due to an error");
                    } else {
                        echo ("$prevFileDestination has been deleted");
                    }
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql;

                    $sql = "UPDATE food SET name=?, basic_price=?, prep_time=?, description=?, photo=? WHERE id=?;";

                    $statement = mysqli_stmt_init($conn);
            
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        echo "sql error food part";
                        exit();
                    } else {
                        $rating = 0.0;
                        $bindFailed = mysqli_stmt_bind_param($statement, 'siissi', $foodname, $basicprice, $preptime, $fooddescription, $fileNameNew, $foodId);
                        if ($bindFailed === false) {
                            echo htmlspecialchars($statement->error);
                            exit();
                        }
                        mysqli_stmt_execute($statement);
                        $newFoodIdGenerated = mysqli_stmt_insert_id($statement);
                
            
                        // ? Updating Exisiting ingredient data in ingredient_food
            
                        $sql = "UPDATE ingredient_food SET ingredient_id=?, no_of_units=? WHERE food_id = ?;";
            
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            echo "sql error";
                            exit();
                        } else {
            
                            for ($i=0; $i < count($shouldUpdated); $i++) { 
                                $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $shouldUpdated[$i], $quantityUpdate[$i], $foodId);
                
                                if ($bindFailed === false) {
                                    echo htmlspecialchars($statement->error);
                                    exit();
                                }
                                mysqli_stmt_execute($statement);
                            }
            
                        }
            
                        // ? Inserting new ingredient data in ingredient_food
            
                        $sql = "INSERT INTO ingredient_food(ingredient_id, food_id, no_of_units) VALUES (?, ?, ?);";
            
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            echo "sql error";
                            exit();
                        } else {
            
                            for ($i=0; $i < count($insertingIds); $i++) { 
                                $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $insertingIds[$i], $foodId, $insertingQuantities[$i]);
                
                                if ($bindFailed === false) {
                                    echo htmlspecialchars($statement->error);
                                    exit();
                                }
                                mysqli_stmt_execute($statement);
                            }
            
                        }


                        // ? Deleting removed ingredient data in ingredient_food
            
                        $sql = "DELETE FROM ingredient_food WHERE ingredient_id = ?;";
            
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            echo "sql error";
                            exit();
                        } else {
            
                            for ($i=0; $i < count($deletingIds); $i++) { 
                                $bindFailed = mysqli_stmt_bind_param($statement, 'i', $deletingIds[$i]);
                
                                if ($bindFailed === false) {
                                    echo htmlspecialchars($statement->error);
                                    exit();
                                }
                                mysqli_stmt_execute($statement);
                            }
            
                        }

            
                        // TODO here
                        echo "success all $foodId";
                        exit();
                    }

                } else {
                    echo "File is too large.";
                }
            } else {
                echo "There was an error.";
            }
        } else {
            echo "You cannot upload files of " . $fileActualExt . " type";
        }

        
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
