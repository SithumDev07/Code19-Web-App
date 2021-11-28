<?php

include '../config.php';


function Render($conn)
{
    // print_r($data);
?>
    <tr class="text-left border-b border-gray-500">
        <th class="px-4 py-3">Order ID</th>
        <th class="px-4 py-3">Customer</th>
        <th class="px-4 py-3">Order</th>
        <th class="px-4 py-3">Extra Fillings</th>
        <th class="px-4 py-3">Total</th>
        <th class="px-4 py-3">Delivery Method</th>
        <th class="px-4 py-3">Status</th>
    </tr>
    <?php

    $sql = "SELECT * FROM customer_order WHERE status='delivering' ORDER BY id DESC;";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);

    $foodIDs = array();
    $foodQuantities = array();
    $foodNames = array();

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

            $sqlCustomer = "SELECT * FROM customer WHERE id=" . $row['customer_id'] . ";";
            $resultsCustomer = mysqli_query($conn, $sqlCustomer);
            $resultCheckCustomer = mysqli_num_rows($resultsCustomer);
            if ($resultCheckCustomer > 0) {
                while ($rowCustomer = mysqli_fetch_assoc($resultsCustomer)) {
                    array_push($data, $rowCustomer['name']);
                }
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
            array_push($data, $foodQuantities);
            array_push($allData, $data);
            $foodNames = array();
            $foodQuantities = array();
            $fillingNames = array();
            $data = array();
        }
    }

    for ($i = 0; $i < count($allData); $i++) {

    ?>
        <tr class="text-left border-b border-gray-500 text-sm cursor-pointer hover:scale-105 transform transition duration-300 single-order">
            <td class="px-4 py-3 order-id">#<?php echo $allData[$i][1]; ?></td>
            <td class="px-4 py-3"><?php if (strlen($allData[$i][5]) > 15) {
                                        $customer = substr($allData[$i][5], 0, 15) . "...";
                                    } else {
                                        $customer = $allData[$i][5];
                                    }
                                    echo $customer; ?></td>
            <td class="px-4 py-3"><?php
                                    $foodList = '';
                                    //? Looping Through Foods
                                    for ($j = 0; $j < count($allData[$i][6]); $j++) {
                                        $foodList .= $allData[$i][6][$j] . " x" . $allData[$i][8][$j] . ", ";
                                        // echo $allData[$i][6][$j] . " x" . $allData[$i][8][$j] . ", ";
                                    }

                                    if (strlen($foodList) > 35) {
                                        echo substr($foodList, 0, 35) . "...";
                                    } else {
                                        echo $foodList;
                                    }
                                    ?></td>
            <td class="px-4 py-3"><?php
                                    $fillingsList = '';
                                    //? Looping Through Fillings
                                    for ($j = 0; $j < count($allData[$i][7]); $j++) {
                                        $fillingsList .= $allData[$i][7][$j] . ", ";
                                        // echo $allData[$i][7][$j] . ", ";
                                    }
                                    if (strlen($fillingsList) > 30) {
                                        echo substr($fillingsList, 0, 30) . "...";
                                    } else {
                                        echo $fillingsList;
                                    }
                                    ?></td>
            <td class="px-4 py-3">Rs.<?php echo $allData[$i][3]; ?></td>
            <td class="px-4 py-3 text-center capitalize"><?php echo $allData[$i][2]; ?></td>
            <td class="px-4 py-3"><button class="px-3 py-2 <?php if($allData[$i][4] == "Cancelled") { echo "bg-red-500 bg-opacity-80"; } else { echo "bg-green-400"; } ?> rounded text-gray-200 capitalize"><?php if ($allData[$i][4] == 'active') {
                                                                                                                echo "Accept";
                                                                                                            } else echo $allData[$i][4]; ?></button></td>
        </tr>
<?php

    }
}
Render($conn);
?>