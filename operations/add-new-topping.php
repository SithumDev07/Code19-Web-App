<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['toppingName'])) {
    $toppingName = $_POST['toppingName'];
    $unitprice = $_POST['unitprice'];
    $ingredientIds = $_POST['ingredientIds'];
    $quantityList = $_POST['quantityList'];

    $ingredientIds = json_decode($ingredientIds);
    $quantityList = json_decode($quantityList);
    


    if (empty($toppingName) || empty($unitprice) || empty($ingredientIds) || empty($quantityList)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $toppingName $unitprice $ingredientIds $quantityList";
        exit();
    } else {

        $sql = "INSERT INTO filling(name, price) VALUES (?, ?);";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'si', $toppingName, $unitprice);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
            $newToppingIdGenerated = mysqli_stmt_insert_id($statement);
    

            // ? Inserting into ingredient_filling

            // $sql = "INSERT INTO ingredient_filling(ingredient_id, filling_id, no_of_units) VALUES (?, ?, ?);";

            // if (!mysqli_stmt_prepare($statement, $sql)) {
            //     echo "sql error";
            //     exit();
            // } else {


            //     $bindFailed = mysqli_stmt_bind_param($statement, 'iii', $supplier, $newToppingIdGenerated, $cost);

            //     if ($bindFailed === false) {
            //         echo htmlspecialchars($statement->error);
            //         exit();
            //     }
            //     mysqli_stmt_execute($statement);
            // }

            echo "success $newToppingIdGenerated";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
