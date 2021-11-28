<?php

include '../config.php';


function Render($results, $conn)
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

    while ($row = mysqli_fetch_assoc($results)) {
?>

        <!-- <div class="popupmenu scale-0 w-96 h-56 rounded-md shadow-xl bg-gray-100 bg-opacity-80 fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 transition duration-200">
            <button class="fixed h-8 w-8 rounded-full bg-black top-1 md:top-4 right-1 md:right-4 flex justify-center items-center text-white z-50 transform transition active:scale-90 duration-150" id="CloseConfirmMenu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex items-center flex-col justify-center h-full">
                <h2 class="text-center text-2xl font-semibold text-gray-800">Confirmation</h2>
                <p class="text-sm text-gray-500 text-center my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, dicta!</p>

                <div class="flex items-center w-full px-5 mt-3">
                    <button type="submit" class="relative w-full rounded-md mr-3 flex flex-1 items-center justify-center bg-yellow-500 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-yellow-600 transition transform duration-200 active:scale-90" id="takeAway">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Take away
                    </button>
                    <button type="submit" class="relative w-full rounded-md flex flex-1 items-center justify-center bg-green-500 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-green-600 transition transform duration-200 active:scale-90" id="Proceed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Add to cart
                    </button>
                </div>
            </div>
        </div> -->

        <div class="popupmenu-stay scale-0 w-96 h-56 rounded-md shadow-xl bg-gray-100 bg-opacity-80 fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 transition duration-200">
            <button class="fixed h-8 w-8 rounded-full bg-black top-1 md:top-4 right-1 md:right-4 flex justify-center items-center text-white z-50 transform transition active:scale-90 duration-150" id="CloseConfirmMenu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex items-center flex-col justify-center h-full">
                <h2 class="text-center text-2xl font-semibold text-gray-800">Confirmation</h2>
                <p class="text-sm text-gray-500 text-center my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, dicta!</p>

                <div class="flex items-center w-full px-5 mt-3">
                    <button type="submit" class="relative w-full rounded-md mr-3 flex flex-1 items-center justify-center bg-yellow-500 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-yellow-600 transition transform duration-200 active:scale-90" id="keepOrder">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Keep Ordering
                    </button>
                    <button type="submit" class="relative w-full rounded-md flex flex-1 items-center justify-center bg-green-500 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-green-600 transition transform duration-200 active:scale-90" id="checkoutTakeaway">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <button class="fixed h-14 w-14 rounded-full bg-black top-1 md:top-6 right-1 md:right-8 flex justify-center items-center text-white z-50 transform transition active:scale-90 duration-150" id="CloseCustomMenu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Header -->
        <header class="flex flex-col xl:flex-row xl:container xl:mx-auto h-screen">
            <div class="left flex flex-col xl:flex-1">
                <h1 class="text-6xl md:text-9xl font-extrabold selection:bg-red-500" style="-webkit-text-stroke: 2px; -webkit-text-stroke-color: rgb(229, 231, 235); color: transparent;">Customize</h1>

                <div class="flex items-center justify-center">
                    <img src="./photo_uploads/foods/<?php echo $row['photo']; ?>" class="w-4/5 xl:w-4/5 2xl:w-full" alt="Featured-Food">
                </div>
            </div>

            <div class="right relative flex xl:justify-center flex-col flex-1 customize-menu-right">
                <h1 class="text-2xl md:text-5xl lg:text-7xl xl:text-5xl text-gray-200 font-bold"><?php echo $row['name']; ?></h1>
                <p class="text-justify text-gray-300 text-base md:text-xl xl:text-base my-2 md:my-6 lg:my-10 xl:my-3"><?php echo $row['description']; ?></p>
                <h3 class="uppercase font-semibold text-2xl text-gray-200 tracking-widest">Topping</h3>
                <div class="flex my-2 md:my-4 flex-wrap overflow-y-auto toppings">
                    <?php


                    $sql = "SELECT * FROM filling WHERE id IN('$toBeShown');";
                    // $sql = "select * from filling left join (select count(*) as now_count, count(filling_id) as disappearing ,filling_id, ingredient_id from ingredient_filling join ingredient on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units group by filling_id) as total_ing on total_ing.filling_id = filling.id join (select id as ingredientId, name as ingredient, remaining_units from ingredient) as ingredient on ingredient.ingredientId = total_ing.ingredient_id join (select count(*) as counts_ing, filling_id from ingredient_filling group by filling_id) as final_ing on final_ing.filling_id = filling.id where total_ing.ingredient_id in (select id from ingredient join ingredient_filling on ingredient.id = ingredient_filling.ingredient_id where ingredient_filling.no_of_units < ingredient.remaining_units) and total_ing.disappearing < final_ing.counts_ing;";
                    $resultsFilling = mysqli_query($conn, $sql);
                    $resultCheckFilling = mysqli_num_rows($resultsFilling);

                    if ($resultCheckFilling > 0) {
                        while ($rowFilling = mysqli_fetch_assoc($resultsFilling)) {


                    ?>

                            <button class="toppings-buttons flex px-3 py-2 rounded-full border border-gray-300 text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-3 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="hidden fillingId"><?php echo $rowFilling['id']; ?></p>
                                <h2 class="fillingName"><?php echo $rowFilling['name'];  ?></h2>
                            </button>

                    <?php

                        }
                    }
                    ?>

                </div>
                <div class="flex justify-between items-center">
                    <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                        <button class="transition duration-150 hover:shadow-lg transform active:scale-90" id="QuantityIncreaser">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <p class="mx-3 font-bold text-2xl quantity-customize">0</p>
                        <button class="transition duration-150 hover:shadow-lg transform active:scale-90" id="QuantityReducer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                            </svg>
                        </button>
                    </div>
                    <p class="hidden basicPrice"><?php echo $row['basic_price']; ?></p>
                    <h2 class="text-4xl text-gray-100 font-semibold">Rs.<?php
                                                                        if (substr($row['basic_price'], (int)strpos($row['basic_price'], '.') + 1) == 0) {
                                                                            echo substr($row['basic_price'], 0, (int)strpos($row['basic_price'], '.'));
                                                                            // echo "\nprice has no decimal";
                                                                        } else {
                                                                            echo $row['basic_price'];
                                                                        }
                                                                        ?>/<span class="text-sm">each</span></h2>
                </div>
                <!-- // TODO Take care of disabled -->
                <button disabled class="rounded-br-none fixed bottom-5 right-10 explore flex text-gray-100 bg-black py-3 px-5 rounded-xl justify-center items-center mt-5 font-semibold disabled:opacity-50" id="GoCheckout">Add to cart<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg></button>

                <div class="-bottom-full bounce-err fixed left-1/2 explore flex text-gray-100 bg-red-500 py-3 px-5 rounded justify-center items-center mt-5 font-semibold disabled:opacity-50 error">Please select at least one topping</div>
            </div>
        </header>
        <?php
    }
}

if (isset($_POST['id'])) {

    $sql;
    $results;
    $message;
    $id = $_POST['id'];

    $sql = " select * from food where id = $id;";
    $results = mysqli_query($conn, $sql);
    $message = "No Results Found For Name -" . $_POST['id'];


    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results, $conn);
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