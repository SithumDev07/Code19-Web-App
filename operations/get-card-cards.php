<?php

include '../config.php';


function Render($results, $quantity, $toppings, $toppingPrices, $toppingIds)
{

    while ($row = mysqli_fetch_assoc($results)) {
?>
        <div class="cart-card w-full h-auto rounded-lg border flex items-center px-3 py-4 pr-5 mb-6">
            <p class="hidden totalPriceRes"><?php echo (int)$row['basic_price'] * $quantity; ?></p>
            <div class="w-32 h-32">
                <img src="./photo_uploads/foods/<?php echo $row['photo']; ?>" class="w-full h-full object-contain" alt="Food Image">
            </div>
            <div class="conetent flex flex-col flex-1 border-l border-r px-3">
                <h1 class="text-xl font-bold text-gray-100 food-name"><?php echo $row['name'] ?></h1>
                <div class="flex flex-wrap">
                    <?php
                    for ($i=0; $i < count($toppings); $i++) { 
                    ?>

                        <button class="flex px-3 py-2 rounded-full bg-black text-gray-200 items-center active:scale-90 transition duration-150 hover:shadow-lg mr-1 mt-3 text-xs toppingAtCart">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <h3 class="tooping-name"><?php echo $toppings[$i]; ?></h3>
                            <h3 class="tooping-id hidden"><?php echo $toppingIds[$i]; ?></h3>
                        </button>
                    <?php
                    }
                    ?>
                </div>
                <div class="hidden">
                    <?php
                    foreach ($toppingPrices as $toppingPrice) {
                    ?>
                        <p class="toppingPrices"><?php echo $toppingPrice; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="pricing flex flex-col pl-3 items-center">
                <h1 class="text-gray-100 font-semibold text-2xl">Rs.<?php echo $row['basic_price']; ?>/<span class="text-sm">each</span></h1>
                <div class="p-3 w-auto h-auto flex items-center text-gray-200 active:scale-90 mt-3 text-xs">
                    <button class="transition duration-150 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>
                    <p class="mx-3 font-bold text-xl"><?php echo $quantity; ?></p>
                    <button class="transition duration-150 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                        </svg>
                    </button>
                </div>
                <button class="text-red-600 text-lg font-bold shadow-sm" id="CartCardRemove">Remove</button>
            </div>

        </div>


        <?php
    }
}

if (isset($_POST['completeOrder'])) {

    $sql;
    $results;

    $completeOrder = $_POST['completeOrder'];
    $completeOrder = json_decode($completeOrder);


    foreach ($completeOrder as $order) {
        $sql = "SELECT * FROM food WHERE id = $order[0];";

        $results = mysqli_query($conn, $sql);

        $toppingsNames = array();
        $toppingPrices = array();
        $toppingIds = array();

        if (mysqli_num_rows($results) > 0) {
            $resultCheck = mysqli_num_rows($results);

            if ($resultCheck > 0) {

                foreach ($order[2] as $toppings) {




                    $sqlToppings = "SELECT * FROM filling WHERE id = $toppings;";

                    $resultsToppings = mysqli_query($conn, $sqlToppings);

                    $resultCheckToppings = mysqli_num_rows($resultsToppings);

                    if ($resultCheckToppings > 0) {
                        while ($row = mysqli_fetch_assoc($resultsToppings)) {
                            array_push($toppingsNames, $row['name']);
                            array_push($toppingPrices, $row['price']);
                            array_push($toppingIds, $row['id']);
                        }
                    }
                }


                Render($results, $order[1], $toppingsNames, $toppingPrices, $toppingIds);


                // while ($rowPrices = mysqli_fetch_assoc($results)) {
                //     array_push($foodPrices, $rowPrices['basic_price']);
                // }
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
    }
} else {
    echo 'Something went wrong';
}
?>