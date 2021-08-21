<?php

include '../config.php';
$id = $_POST['id'];
$sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id WHERE purchase.ingredient_id = " . $id . ";";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($results)) {

?>
        <!-- <form id="crew-form" method="post" enctype="multipart/form-data"> -->
        <div class="w-full h-full p-10 flex-col justify-center items-center  hidden add-inventory-form overflow-y-auto">
            <!-- Card Account -->
            <input type="text" class="hidden" id="IngredientId" name="id" value="<?php echo $id; ?>">
            <div class="card-inventory mb-4 w-96 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">
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

            <div class="flex items-center mt-8 mb-28">
                <button class="flex items-center text-green-500 mx-5 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="CancelIngredient" name="ingredient-cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Cancel
                </button>
                <button class="flex items-center text-red-500 mx-5 bg-red-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-red-400 hover:text-gray-200" id="DeleteIngredient" type="submit" name="ingredient-delete" onclick="console.log('Working')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
        <!-- </form> -->
    <?php
    }
} else {

    ?>
    <h1 class="text-center text-6xl font-semibold text-gray-400 w-full mt-6">No Results Found</h1>
<?php
}
?>