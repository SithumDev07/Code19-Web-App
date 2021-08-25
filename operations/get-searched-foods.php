<?php
include '../config.php';

function Render($results)
{

    while ($row = mysqli_fetch_assoc($results)) {
?>
        <div class="card-kitchen mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
            <p class="hidden card-food-id"><?php echo $row['id']; ?></p>
            <div class="flex items-center flex-1 mb-2">
                <div class="w-16 h-16 overflow-hidden flex-1">
                    <img class="object-contain w-full h-full" src="./assets/featured/featured-burger.png" alt="foodImage">
                </div>
                <div>
                    <h1 class="text-gray-600 font-semibold text-sm">Consist of <?php echo $row['count(*)']; ?> ingredients</h1>
                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                    <p class="text-xs text-gray-500">Popularity</p>
                    <div class="flex items-center text-yellow-400 mt-1">
                        <?php
                        for ($i = 0; $i < $row['rating']; $i++) {
                        ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400 my-1"><?php if (strlen($row['description']) > 90) {
                                                        echo substr($row['description'], 0, 87) . "...";
                                                    } else {
                                                        echo $row['description'];
                                                    } ?></p>
            <h1 class="text-gray-600 font-semibold flex-1"><?php echo $row['name']; ?></h1>

            <div class="flex items-center mt-2 justify-between">
                <button class="<?php if ($row['count(*)'] < $row['counts_ing']) {
                                    echo 'text-red-500 bg-red-200';
                                } else {
                                    echo 'text-green-500 bg-green-200';
                                } ?> px-2 py-2 rounded-full flex items-center text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php if ($row['count(*)'] < $row['counts_ing']) {
                        echo 'High';
                    } else {
                        echo 'Low';
                    } ?>
                </button>

                <div class="text-gray-500 text-xs flex items-center">
                    Disappearing Status
                </div>
            </div>
            <div class="absolute bottom-0 w-full h-1 <?php if ($row['count(*)'] < $row['counts_ing']) {
                                                            echo 'bg-red-400';
                                                        } else {
                                                            echo 'bg-green-400';
                                                        } ?> left-0"></div>
        </div>
        <?php
    }
}

if (isset($_POST['query'])) {

    $sql;
    $results;
    $message;

    if (is_numeric($_POST['query']) && is_numeric($_POST['query'])) {
        $sql = "select * from food left join (select count(*), food_id, ingredient_id from ingredient_food join ingredient on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units  < ingredient.remaining_units group by food_id) as total_ing on total_ing.food_id = food.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, food_id from ingredient_food group by food_id) as final_ing on final_ing.food_id = food.id where total_ing.ingredient_id in (select id from ingredient join ingredient_food on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units < ingredient.remaining_units) AND food.id =" . $_POST['query'] . ";";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For ID -" . $_POST['query'];
    } else if (substr($_POST['query'], 0, 5) == 'star:' || substr($_POST['query'], 0, 5) == 'Star:' || substr($_POST['query'], 0, 5) == 'STAR:') {

        $stars = $_POST['query'];
        $starSearch = 0.0;

        if (is_numeric(substr($stars, (int)strpos($stars, ':') + 1, 3))) {

            $sliced = substr($stars, (int)strpos($stars, ':') + 1, 3);
            if (str_contains($sliced, '.')) {
                if (empty(substr($sliced, 2, 1))) {
                    $message = "Invalid Rating - " . $_POST['query'];
                } else {
                    $starSearch = substr($stars, (int)strpos($stars, ':') + 1, 3);
                }
            } else {
                $starSearch = substr($stars, (int)strpos($stars, ':') + 1, 3);
            }
        } else {
            $message = "No Rating is given - " . $_POST['query'];
        }

        $sql = "select * from food left join (select count(*), food_id, ingredient_id from ingredient_food join ingredient on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units  < ingredient.remaining_units group by food_id) as total_ing on total_ing.food_id = food.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, food_id from ingredient_food group by food_id) as final_ing on final_ing.food_id = food.id where total_ing.ingredient_id in (select id from ingredient join ingredient_food on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units < ingredient.remaining_units) AND food.rating = " . $starSearch . ";";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For RATING at - " . $starSearch;
    } else {
        $sql = "select * from food left join (select count(*), food_id, ingredient_id from ingredient_food join ingredient on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units  < ingredient.remaining_units group by food_id) as total_ing on total_ing.food_id = food.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, food_id from ingredient_food group by food_id) as final_ing on final_ing.food_id = food.id where total_ing.ingredient_id in (select id from ingredient join ingredient_food on ingredient.id = ingredient_food.ingredient_id where ingredient_food.no_of_units < ingredient.remaining_units) AND food.name like '%" . $_POST['query'] . "%';";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For Name " . $_POST['query'];
    }



    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results);
        } else {

        ?>
            <h1 class="text-center text-4xl font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
        <?php
        }
    } else {
        ?>
        <h1 class="text-center text-4xl font-semibold text-gray-400 w-full mt-6"><?php echo $message; ?></h1>
<?php
    }
} else {
    echo 'Something went wrong';
}
?>