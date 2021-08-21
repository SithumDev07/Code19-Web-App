<?php
include '../config.php';

$sql = "SELECT * FROM supplier inner JOIN (select * from supplier_contact group by id order by contact_no desc) AS supplier_contact ON supplier.id = supplier_contact.id;";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
?>
        <div class="card-suppliers mb-4 w-72 overflow-hidden relative flex flex-col card cursor-pointer border border-gray-300 rounded-2xl p-5 ml-5 transform transition duration-200 hover:bg-white hover:border-opacity-0 hover:shadow-2xl hover:scale-105">

            <div class="flex items-center flex-1 mb-2">
                <div class="overflow-hidden w-16 h-16 rounded-full mb-1 cursor-pointer mr-2">
                    <!-- TODO Update Photo Link -->
                    <img class="object-cover w-full h-full rounded-full" src="./photo_uploads/suppliers/<?php if ($row != null) {
                                                                                                            echo $row['photo'];
                                                                                                        } else {
                                                                                                            echo "611f0f941fce68.26123095.png";
                                                                                                        } ?>" alt="SupplierImage">
                </div>
                <p class="hidden card-supplier-id"><?php echo $row['id']; ?></p>
                <div class="flex-1 ml-2">
                    <h1 class="text-gray-600 font-semibold text-sm">All Purpose Flour and 6+ more</h1>
                    <!-- <p class="text-xs text-gray-400 my-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, provident.</p> -->
                    <p class="text-xs text-gray-500"><?php echo $row['contact_no']; ?></p>
                    <p class="text-xs text-gray-500"><?php echo $row['email']; ?></p>

                </div>
            </div>

            <h1 class="text-gray-600 font-semibold flex-1"><?php echo $row['name']; ?></h1>
            <p class="text-xs text-gray-500 my-1 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <?php echo $row['address']; ?>
            </p>

            <div class="flex items-center mt-2 justify-between">
                <button class="text-green-500 bg-green-200 px-2 py-2 rounded-full flex items-center text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    No Due
                </button>

                <div class="text-gray-500 text-xs flex flex-col">
                    <h3 class="text-xl font-semibold text-gray-500">Rs. 74,000.00</h3>
                    Total Payments
                </div>
            </div>
            <div class="absolute bottom-0 w-full h-1 bg-green-400 left-0"></div>
        </div>
    <?php
    }
} else {

    ?>
    <h1 class="text-center text-6xl font-semibold text-gray-400 w-full mt-6">No Results Found</h1>
<?php
}
?>