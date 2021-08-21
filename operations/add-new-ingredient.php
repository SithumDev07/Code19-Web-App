<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['name'])) {
    $ingredientName = $_POST['name'];
    $supplier = $_POST['supplier'];
    $cost = $_POST['cost'];
    $paid = $_POST['paid'];
    $quantity = $_POST['quantity'];
    $MFD = $_POST['mfd'];
    $EXP = $_POST['exp'];
    $purchaseDate = $_POST['purchaseDate'];
    $selectedIngredient = $_POST['selectedIngredient'];


    if (empty($ingredientName) || empty($supplier) || empty($cost) || empty($quantity) || empty($MFD) || empty($EXP) || empty($purchaseDate)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $ingredientName $supplier $cost $quantity $MFD $EXP $purchaseDate";
        exit();
    } else {
        $ingredientId;
        $currentUnits = 0;
        $sql = "SELECT * FROM ingredient WHERE name='" . $ingredientName . "';";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);
        $newIngredientIdGenerated = 'unset';

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $ingredientId = $row['id'];
                $currentUnits = (int)$row['remaining_units'];
            }
            $currentUnits = $currentUnits + (int)$quantity;
            $sql = "UPDATE ingredient SET remaining_units = ? WHERE id=?;";
        } else {
            $sql = "INSERT INTO ingredient(name, remaining_units) VALUES (?, ?);";
        }

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error";
            exit();
        } else {

            if ($currentUnits == 0) {
                $bindFailed = mysqli_stmt_bind_param($statement, 'si', $ingredientName, $quantity);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
                $newIngredientIdGenerated = mysqli_stmt_insert_id($statement);
            } else {
                $bindFailed = mysqli_stmt_bind_param($statement, 'ii', $currentUnits, $ingredientId);
                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }



            // ? Inserting data into supplier_ingredient - Purchase Table


            if ($paid) {
                $paid = 'yes';
            } else {
                $paid = 'no';
            }

            $sql = "INSERT INTO supplier_ingredient(supplier_id, ingredient_id, cost, paid, quantity, MFD, EXP, purchase_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            if (!mysqli_stmt_prepare($statement, $sql)) {
                echo "sql error";
                exit();
            } else {
                if ($currentUnits == 0) {
                    $bindFailed = mysqli_stmt_bind_param($statement, 'iiisisss', $supplier, $newIngredientIdGenerated, $cost, $paid, $quantity, $MFD, $EXP, $purchaseDate);
                } else {
                    $bindFailed = mysqli_stmt_bind_param($statement, 'iiisisss', $supplier, $selectedIngredient, $cost, $paid, $quantity, $MFD, $EXP, $purchaseDate);
                }

                if ($bindFailed === false) {
                    echo htmlspecialchars($statement->error);
                    exit();
                }
                mysqli_stmt_execute($statement);
            }

            echo "success $newIngredientIdGenerated $currentUnits $supplier";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
