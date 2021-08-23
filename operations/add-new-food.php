<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['foodname'])) {
    $foodname = $_POST['foodname'];
    $fooddescription = $_POST['fooddescription'];
    $basicprice = $_POST['basicprice'];
    $preptime = $_POST['preptime'];
    $ingredientIds = $_POST['ingredientIds'];
    $toppingIds = $_POST['toppingIds'];

    $ingredientIds = json_decode($ingredientIds);
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
    


    if (empty($toppingName) || empty($unitprice) || empty($ingredientIds) || empty($quantityList)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $toppingName $unitprice $ingredientIds $quantityList";
        exit();
    } else {

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 3000000) {

                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../photo_uploads/foods/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql;

                    $sql = "INSERT INTO filling(name, basic_price, prep_time (mins), description, rating, photo) VALUES (?, ?, ?, ?, ?, ?);";

                    $statement = mysqli_stmt_init($conn);
            
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        echo "sql error";
                        exit();
                    } else {
                        $rating = 0.0;
                        $bindFailed = mysqli_stmt_bind_param($statement, 'siisis', $foodname, $basicprice, $preptime, $fooddescription, $rating, $fileNameNew);
                        if ($bindFailed === false) {
                            echo htmlspecialchars($statement->error);
                            exit();
                        }
                        mysqli_stmt_execute($statement);
                        $newFoodIdGenerated = mysqli_stmt_insert_id($statement);
                
            
                        // ? Inserting into ingredient_food
            
                        $sql = "INSERT INTO ingredient_filling(ingredient_id, filling_id, no_of_units) VALUES (?, ?, ?);";
            
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            echo "sql error";
                            exit();
                        } else {
            
                            for ($i=0; $i < count($ingredientIds); $i++) { 
                                $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $ingredientIds[$i], $newFoodIdGenerated, $quantityList[$i]);
                
                                if ($bindFailed === false) {
                                    echo htmlspecialchars($statement->error);
                                    exit();
                                }
                                mysqli_stmt_execute($statement);
                            }
            
                        }
            
                        echo "success all $newFoodIdGenerated";
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
