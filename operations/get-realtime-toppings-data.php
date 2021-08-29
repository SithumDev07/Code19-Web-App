<?php

include '../config.php';


function Render($conn, $selectedToppingId, $currentlySelected)
{

    $sql = "SELECT * FROM filling";
    $resultsFilling = mysqli_query($conn, $sql);
    $resultCheckFilling = mysqli_num_rows($resultsFilling);
    $fillingsAll = array();

    if ($resultCheckFilling > 0) {
        while ($rowFilling = mysqli_fetch_assoc($resultsFilling)) {
            array_push($fillingsAll, $rowFilling['id']);
        }
    }

    $sql = "select * from filling left join (select count(*) as now_count, count(filling_id) as disappearing ,filling_id, ingredient_id from ingredient_filling join ingredient on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units group by filling_id) as total_ing on total_ing.filling_id = filling.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, filling_id from ingredient_filling group by filling_id) as final_ing on final_ing.filling_id = filling.id where total_ing.ingredient_id in (select id from ingredient join ingredient_filling on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units) and total_ing.disappearing < final_ing.counts_ing;";
    $resultsFilling = mysqli_query($conn, $sql);
    $resultCheckFilling = mysqli_num_rows($resultsFilling);
    $toppingsOutOfStock = array();
    if ($resultCheckFilling > 0) {
        while ($rowFilling = mysqli_fetch_assoc($resultsFilling)) {
            array_push($toppingsOutOfStock, $rowFilling['id']);
        }
    }
    $toBeShown = array();
    $toBeShown = array_diff($fillingsAll, $toppingsOutOfStock);
    $toBeShown = implode("','", $toBeShown);




    $sql = "SELECT * FROM filling WHERE id IN('$toBeShown');";
    // $sql = "select * from filling left join (select count(*) as now_count, count(filling_id) as disappearing ,filling_id, ingredient_id from ingredient_filling join ingredient on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units group by filling_id) as total_ing on total_ing.filling_id = filling.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, filling_id from ingredient_filling group by filling_id) as final_ing on final_ing.filling_id = filling.id where total_ing.ingredient_id in (select id from ingredient join ingredient_filling on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units) and total_ing.disappearing < final_ing.counts_ing;";
    $resultsFilling = mysqli_query($conn, $sql);
    $resultCheckFilling = mysqli_num_rows($resultsFilling);

    if ($resultCheckFilling > 0) {
        while ($rowFilling = mysqli_fetch_assoc($resultsFilling)) {

            if (in_array($rowFilling['id'], $currentlySelected)) {
?>
                <button class="toppings-buttons flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3 rendered">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="hidden fillingId"><?php echo $rowFilling['id']; ?></p>
                    <h2 class="fillingName"><?php echo $rowFilling['name'];  ?></h2>
                </button>

            <?php
            } else {


            ?>

                <button class="toppings-buttons flex px-3 py-2 rounded-full border border-gray-300 text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3 rendered">
                    <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="hidden fillingId"><?php echo $rowFilling['id']; ?></p>
                    <h2 class="fillingName"><?php echo $rowFilling['name'];  ?></h2>
                </button>

<?php
            }
        }
    }
}

if (isset($_POST['fillingid'])) {

    $sql;
    $results;
    $message;
    $id = $_POST['fillingid'];
    $quantity = $_POST['quantity'];
    if($quantity == 0) {
        $quantity = 1;
    }
    $currentlySelected = $_POST['currentlySelected'];
    $currentlySelected = json_decode($currentlySelected);

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
            if(in_array($id, $currentlySelected)) {
                $newUnits = $currentStockIngredients - $allIngredientQuantities[$i];
            } else {
                $newUnits = $currentStockIngredients + $allIngredientQuantities[$i];
            }
            $bindFailed = mysqli_stmt_bind_param($statement, 'ii', $newUnits, $allIngredientIds[$i]);

            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }
    }



    // ? Render on screen
    Render($conn, $id, $currentlySelected);
} else {
    echo 'Something went wrong';
}
?>