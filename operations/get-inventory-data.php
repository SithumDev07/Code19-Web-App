<?php
include '../config.php';

// $sql = "SELECT * FROM supplier inner JOIN (select * from supplier_contact group by id order by contact_no desc) AS supplier_contact ON supplier.id = supplier_contact.id;";
$sql = "select * from supplier;";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);
?>

<div class="w-full h-full p-10 add-inventory-form hidden overflow-y-auto">

    <div class="flex-1 mb-24">
        <div class="flex flex-col mx-5 mb-10">
            <input type="text" placeholder="Name" class="mb-5 rounded-md bg-gray-50" id="IngredientName" name="name">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="shift">
                Supplier
            </label>
            <select class="px-3 py-2 w-auto rounded" id="inventorySupplier" name="supplierName">
                <?php
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $supplier = $row['name'];
                ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $supplier; ?></option>

                <?php

                    }
                }
                ?>
            </select>
        </div>

        <div class="ingredients-exists hidden">

        </div>

        <div class="flex items-center mb-10">
            <input type="number" placeholder="Total Cost" class="mx-4 bg-gray-50 rounded-md transform transition-colors duration-300" id="IngredientCost" name="cost">
            <label class="block text-gray-700 text-sm font-bold ml-4 mr-1" for="shift">
                Paid
            </label>
            <label class="switch relative inline-block w-16 h-10 ml-4">
                <input type="checkbox" class="toggle-switch hidden" name="paid" id="isPaidInventory">
                <span class="slider cursor-pointer top-0 left-0 right-0 bottom-0 absolute bg-gray-400 transform transition duration-300 rounded-full"></span>
            </label>
        </div>

        <!-- // TODO Add counter later on -->
        <div class="flex items-center">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="shift">
                    Quantity Purchased in Kilos or Literes or Units
                </label>
                <input type="number" placeholder="Quantity" class="mx-4 mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="IngredientQuantity" name="quantity">
            </div>
            <div class="flex flex-1 items-center ml-5">
                <label class="block text-gray-700 text-sm font-bold mr-3" for="metricType">
                    Type
                </label>
                <select class="px-3 py-2 w-auto rounded" id="inventoryMetricType" name="metricType">

                    <option value="g">g</option>
                    <option value="Kg">Kg</option>
                    <option value="ml">ml</option>
                    <option value="Ltr">Ltr</option>
                    <option value="pieces">pieces</option>


                </select>
            </div>
        </div>

    </div>
    <div class="flex-1 mb-24">
        <div class="flex flex-col mx-5 mb-10">

            <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="birthday">
                Manufacturing date
            </label>
            <input type="date" class="mx-4 mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="IngredientMFD" name="mfd">
            <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="birthday">
                Expiring date
            </label>
            <input type="date" class="mx-4 mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="IngredientEXP" name="exp">
            <label class="block text-gray-700 text-sm font-bold mb-2 mx-4" for="birthday">
                Purchase date
            </label>
            <input type="date" class="mx-4 mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="IngredientPurchase" name="purchaseDate">


            <div class="flex justify-end items-center">
                <p class="text-red-500 font-semibold text-sm hidden inventory-error-message">Oops. It seems to be some inputs are not filled.</p>
                <button class="flex items-center text-green-500 mx-5 bg-green-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-green-400 hover:text-gray-200" id="InsertIngredient" type="submit" name="ingredient-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Add
                </button>
            </div>
        </div>

    </div>
</div>