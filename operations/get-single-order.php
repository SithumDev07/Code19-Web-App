<?php

include '../config.php';


function Render($data)
{
    // print_r($data);
?>
    <div class="flex flex-col w-full h-full py-5 px-10 relative">
        <div class="fixed top-1/4 right-1/2 transform translate-x-1/2 w-80 py-2 px-3 rounded-xl bg-gray-100 bg-opacity-95 scale-0 transition duration-150 order-cancel-confirmation">
            <div class="flex items-center justify-end">
                <button class="flex items-center rounded-full justify-center p-3 bg-black text-gray-200 transform transition duration-150 active:scale-95 hover:scale-105" id="CloseCancelation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="italic text-gray-600 font-semibold text-sm text-center">Please tell the reason for cancelling.</p>
            <textarea name="special-note" id="specialNote" placeholder="reason" class="my-2 block mx-auto border border-gray-300 w-full bg-transparent text-sm font-semibold text-gray-700"></textarea>
            <button class="rounded-full px-5 py-2 flex items-center justify-center mt-2 bg-red-400 text-gray-200 mx-auto transform transition duration-150 active:scale-90 hover:scale-105" id="CancelConfirm">
                Cancel
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="flex items-center justify-between w-full px-5">
            <h1 class="text-5xl opacity-60 font-semibold text-gray-400 order-id-display italic">#<?php echo $data[1]; ?></h1>
            <h1 class="text-5xl opacity-60 font-semibold text-gray-400 order-total italic">Rs.<?php echo $data[3]; ?></h1>
        </div>
        <div class="flex items-center mt-5">
            <div class="w-16 h-16 rounded-full overflow-hidden">
                <img src="<?php if ($data[6] == null) {
                                echo "https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80";
                            } else {
                                echo "./photo_uploads/customers/" . $data[6];
                            } ?>" class="w-full h-full object-cover rounded-full" alt="single-food">
            </div>
            <div class="flex flex-col ml-4">
                <h4 class="text-blue-600 font-semibold text-xl"><?php echo $data[5]; ?></h4>
                <?php
                if ($data[2] == 'takeaway') {
                ?>
                    <h4 class="text-blue-600 opacity-80 font-semibold">Takeaway</h4>
                <?php
                } else {
                ?>
                    <h4 class="text-blue-600 opacity-80 font-semibold"><?php print_r($data[7]); ?></h4>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="list flex flex-col my-6">
            <?php
            for ($i = 0; $i < count($data[8]); $i++) {
            ?>
                <div class="flex items-center justify-between border border-gray-400 px-3 py-2 rounded mb-2">
                    <div class="w-14 h-14 rounded-full overflow-hidden">
                        <img src="./photo_uploads/foods/<?php echo $data[10][$i]; ?>" class="w-full h-full object-cover rounded-full" alt="single-food">
                    </div>
                    <h2 class="text-lg font-semibold text-gray-700 food-name mx-3 flex-1"><?php echo $data[8][$i]; ?> x<?php echo $data[11][$i]; ?></h2>
                    <p class="text-sm xl:text-xs 2xl:text-sm text-gray-500 fillings-list"><?php
                                                                    $toppings = '';
                                                                    for ($j = 0; $j < count($data[9]); $j++) {
                                                                        $toppings .= $data[9][$j] . ", ";
                                                                    }
                                                                    echo $toppings;
                                                                    ?></p>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="actions flex items-center <?php if($data[4] == "Cancelled") { echo "justify-center"; } else { echo "justify-between"; } ?> mt-5">
            <p class="order-cancelled-message <?php if($data[4] != "Cancelled") { echo "hidden"; } ?> text-red-500 font-semibold text-sm italic text-center">This order is cancelled by</p>
            <div class="flex items-center">
                <button class="flex <?php if ($data[4] == 'active' || $data[4] == "Cancelled") {
                                        echo "scale-0";
                                    } else if ($data[4] == 'On Hold') {
                                        echo "animate-ping mr-8";
                                    } ?> items-center rounded-full justify-center p-3 bg-yellow-300 text-gray-200 transform transition duration-150 active:scale-95 hover:scale-105" id="HoldOrder">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button class="flex <?php if ($data[4] == 'active' || $data[4] == "Cancelled") {
                                        echo "scale-0";
                                    } else if ($data[4] == 'Delivering') {
                                        echo "animate-ping ml-8";
                                    } ?> items-center rounded-full justify-center p-3 bg-green-400 text-gray-200 transform transition duration-150 active:scale-95 ml-3 hover:scale-105" id="Delivered">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center">
                <button class="<?php if($data[4] == "Cancelled") { echo "scale-0"; } ?> flex items-center rounded-full justify-center p-4 mr-3 bg-red-400 text-gray-200 transform transition duration-150 active:scale-95 hover:scale-105" id="CancelOrder">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button class="<?php if ($data[4] != 'active') {
                                    echo "scale-0";
                                } ?> flex items-center rounded-full justify-center p-4 bg-green-400 text-gray-200 transform transition duration-150 active:scale-95 hover:scale-105" id="AcceptOrder">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


<?php
}

if (isset($_POST['orderid'])) {

    $id = $_POST['orderid'];

    $sql = "SELECT * FROM customer_order WHERE id =" . $id . ";";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);

    $foodIDs = array();
    $foodQuantities = array();
    $foodNames = array();
    $foodPhotos = array();

    $fillingsIDs = array();
    $fillingNames = array();

    $data = array();
    $allData = array();
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            array_push($data, $row['customer_id']);
            array_push($data, $row['id']);
            array_push($data, $row['delivery_method']);
            array_push($data, $row['total_amount']);
            array_push($data, $row['status']);

            // ? Customer Data
            $sqlCustomer = "SELECT * FROM customer WHERE id=" . $row['customer_id'] . ";";
            $resultsCustomer = mysqli_query($conn, $sqlCustomer);
            $resultCheckCustomer = mysqli_num_rows($resultsCustomer);
            if ($resultCheckCustomer > 0) {
                while ($rowCustomer = mysqli_fetch_assoc($resultsCustomer)) {
                    array_push($data, $rowCustomer['name']);
                    array_push($data, $rowCustomer['photo']);
                }
            }

            // ? Customer Address Data
            $sqlCustomer = "SELECT * FROM customer_address WHERE customer_id=" . $row['customer_id'] . ";";
            $resultsCustomer = mysqli_query($conn, $sqlCustomer);
            $resultCheckCustomer = mysqli_num_rows($resultsCustomer);
            if ($resultCheckCustomer > 0) {
                while ($rowCustomer = mysqli_fetch_assoc($resultsCustomer)) {
                    array_push($data, $rowCustomer['address']);
                }
            } else {
                array_push($data, "No Address");
            }

            // ? Getting Foods
            $sqlFood = "SELECT * FROM food_order WHERE order_id=" . $row['id'] . ";";
            $resultsFood = mysqli_query($conn, $sqlFood);
            $resultCheckFood = mysqli_num_rows($resultsFood);
            if ($resultCheckFood > 0) {
                while ($rowFood = mysqli_fetch_assoc($resultsFood)) {
                    array_push($foodIDs, $rowFood['food_id']);
                    array_push($foodQuantities, $rowFood['quantity']);
                }


                for ($i = 0; $i < count($foodIDs); $i++) {
                    $sqlFood = "SELECT * FROM food WHERE id=" . $foodIDs[$i] . ";";
                    $resultsFood = mysqli_query($conn, $sqlFood);
                    $resultCheckFood = mysqli_num_rows($resultsFood);
                    if ($resultCheckFood > 0) {
                        while ($rowFood = mysqli_fetch_assoc($resultsFood)) {
                            array_push($foodNames, $rowFood['name']);
                            array_push($foodPhotos, $rowFood['photo']);
                        }
                    }
                }
                $foodIDs = array();
            }


            //? Getting Fillings
            $sqlFillings = "SELECT * FROM filling_order WHERE order_id = " . $row['id'] . ";";
            $resultsFillings = mysqli_query($conn, $sqlFillings);
            $resultsCheckFillings = mysqli_num_rows($resultsFillings);
            if ($resultsCheckFillings > 0) {
                while ($rowFillings = mysqli_fetch_assoc($resultsFillings)) {
                    array_push($fillingsIDs, $rowFillings['filling_id']);
                }

                for ($i = 0; $i < count($fillingsIDs); $i++) {
                    $sqlFillings = "SELECT * FROM filling WHERE id = " . $fillingsIDs[$i] . ";";
                    $resultsFillings = mysqli_query($conn, $sqlFillings);
                    $resultsCheckFillings = mysqli_num_rows($resultsFillings);
                    if ($resultsCheckFillings > 0) {
                        while ($rowFillings = mysqli_fetch_assoc($resultsFillings)) {
                            array_push($fillingNames, $rowFillings['name']);
                        }
                    }
                }

                $fillingsIDs = array();
            }


            array_push($data, $foodNames);
            array_push($data, $fillingNames);
            array_push($data, $foodPhotos);
            array_push($data, $foodQuantities);
            $foodNames = array();
            $foodQuantities = array();
            $fillingNames = array();
            $foodPhotos = array();
        }

        Render($data);
    }
} else {
    echo 'Something went wrong';
}
?>