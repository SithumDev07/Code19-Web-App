<?php
include '../config.php';

// $sql = "select ingredient.name as ingredient, supplier.name as supplier, supplier_contact.contact_no as contact, supplier.email as email, ingredient.remaining_units as remaining from ingredient join supplier_ingredient on ingredient.id = supplier_ingredient.ingredient_id join supplier on supplier.id = supplier_ingredient.supplier_id join supplier_contact on supplier_contact.id = supplier.id order by supplier_contact.contact_no desc limit 1;";
$sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id;";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($results)) {

?>
        <div class="card-inventory mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
            <p class="hidden card-inventory-id"><?php echo $row['ingredient_id']; ?></p>
            <div class="flex items-center flex-1 mb-2">
                <div class="">
                    <h1 class="text-gray-600 font-semibold"><?php echo $row['name']; ?></h1>
                    <p class="text-sm text-gray-500 font-bold my-1"><?php echo $row['supplier']; ?></p>
                    <p class="text-xs text-gray-400"><?php echo $row['contact']; ?></p>
                    <p class="text-xs text-gray-400"><?php echo $row['email']; ?></p>
                </div>
                <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center"><?php echo ($row['remaining_units'] * 0.01) ?>Kg</h1>
            </div>

            <div class="flex items-center">
                <h1 class="text-gray-500 font-semibold flex-1">Previous Stock</h1>
                <p class="text-gray-500 font-semibold">12th Aug</p>
            </div>
            <div class="flex items-center mt-2 justify-between">
                <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    13Kg
                </button>

                <div class="text-gray-500 text-xs flex items-center">
                    Average Consumtion
                </div>
            </div>
            <div class="absolute bottom-0 w-full h-1 bg-yellow-400 left-0"></div>
        </div>

    <?php

    }
} else {
    ?>
    <h1 class="text-center text-6xl font-semibold text-gray-400 w-full mt-6">No Results Found</h1>
<?php
}

?>