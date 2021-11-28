<?php

include '../config.php';


function Render($results)
{

    while ($row = mysqli_fetch_assoc($results)) {
?>
        <button class="resulted-ingredients flex px-4 py-3 rounded-full bg-green-400 text-gray-100 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 mr-2 isSelectedIngredient" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="ingredient-name"><?php echo $row['name']; ?></h3>
            
            <p class="hidden selectedIngredientId"><?php echo $row['id']; ?></p>
            <p class="hidden quantityFromIngredient"><?php echo $row['no_of_units']; ?></p>
        </button>


        <?php
    }
}

if (isset($_POST['id'])) {

    $sql;
    $results;
    $message;

    // $alreadAdded = $_POST['alreadyAdded'];
    // $alreadAdded = json_decode($alreadAdded);
    // $alreadAdded = implode("','", $alreadAdded);

    $sql = "SELECT * FROM ingredient JOIN ingredient_food ON ingredient_food.ingredient_id = ingredient.id JOIN (SELECT id AS food_id_selected FROM food) AS food ON food.food_id_selected = ingredient_food.food_id WHERE food.food_id_selected = 4;";
    

    $results = mysqli_query($conn, $sql);


    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results);
        } else {

        ?>
            <h1 class="text-center text-xs font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
        <?php
        }
    } else {
        ?>
        <h1 class="text-center text-xs font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
<?php
    }
} else {
    echo 'Something went wrong';
}
?>