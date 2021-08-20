<?php

include '../config.php';
$id = $_POST['id'];
$sql = "SELECT * FROM supplier WHERE id=" . $id . ";";
$results = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($results);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($results)) {

        $sql = "SELECT * FROM supplier_contact WHERE id = $id ORDER BY contact_no DESC LIMIT 1;";
        $resultsMobile = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($resultsMobile);
        $currentMobile;

        if ($resultCheck > 0) {
            while ($rowMobile = mysqli_fetch_assoc($resultsMobile)) {
                $currentMobile = $rowMobile['contact_no'];
            }
        }

        $sql = "SELECT * FROM supplier_contact WHERE id = $id ORDER BY contact_no ASC LIMIT 1;";
        $resultsLandline = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($resultsLandline);
        $currentLandline;

        if ($resultCheck > 0) {
            while ($rowLandline = mysqli_fetch_assoc($resultsLandline)) {
                $currentLandline = $rowLandline['contact_no'];
            }

            if($currentMobile == $currentLandline) {
                // ? There is no landline
                $currentLandline = '';
            }
        }

?>
        <!-- <form id="crew-form" method="post" enctype="multipart/form-data"> -->
        <div class="w-full h-full p-10 flex-col  hidden add-supplier-form overflow-y-auto">
            <!-- Card Account -->
            <div class="flex items-center">
                <div class="flex-1 flex flex-col px-12">
                    <input type="text" placeholder="Name" class="mb-5 flex-1 rounded-md bg-gray-50" id="supplierName" name="name" value="<?php echo $row['name']; ?>">
                    <input type="email" placeholder="Email (Optional)" class="mb-5 flex-1 bg-gray-50 rounded-md transform transition-colors duration-300" id="supplierEmail" name="email" value="<?php if ($row['email'] != null) {
                                                                                                                                                                                                        echo $row['email'];
                                                                                                                                                                                                    } ?>">
                    <textarea name="address" id="supplierAddress" class="mb-5 appearance-none py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50 rounded-md transform transition-colors duration-300" placeholder="Address" id="crewAddress" name="address"><?php echo $row['address']; ?></textarea>


                </div>
                <div class="w-48 h-48 rounded-full overflow-hidden relative cursor-pointer profile-picture p-1 border-2 border-blue-600 CrewImageContainer shadow-2xl">
                    <i class="fas fa-camera text-white absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-3xl z-10"></i>
                    <img id="supplierUploadedProfile" class="opacity-80 rounded-full w-full h-full object-cover" src="./photo_uploads/suppliers/<?php echo $row['photo']; ?>" alt="Crew Profile">
                    <input type="file" name="profileUpload" id="SupplierUploadProfile" value="">
                </div>
            </div>
            <div class="mb-24 mt-5">

                <div class="flex items-center px-8">
                    <input type="number" placeholder="Phone Number" class="mx-4 mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="supplierPersonalNumber" name="mobile" value="<?php echo $currentMobile; ?>">
                    <input type="number" placeholder="Land Line (Optional)" class="mb-5 bg-gray-50 rounded-md transform transition-colors duration-300" id="supplierLandLine" name="landline" value="<?php echo $currentLandline; ?>">
                    <input type="text" class="hidden" id="SupplierId" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" class="hidden" id="SupplierPreviousProfile" name="prev_file" value="<?php echo $row['photo']; ?>">
                </div>


                <div class="flex justify-between items-center mb-48">
                    <a href="./dashboard.php" class="flex items-center text-gray-900 font-bold mx-5 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95" id="CancelOpendedSupplier">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Cancel
                    </a>
                    <div class="flex items-center">
                        <p class="text-red-500 font-semibold text-sm hidden supplier-error-message">Oops. It seems to be some inputs are not filled.</p>
                        <button class="flex items-center text-red-500 mx-5 bg-red-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-red-400 hover:text-gray-200" id="DeleteSupplier" name="supplier-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Delete
                        </button>
                        <button class="flex items-center text-yellow-500 mx-5 bg-yellow-200 px-5 py-3 rounded-md transform transition-colors duration-300 active:scale-95 hover:bg-yellow-400 hover:text-gray-200" id="UpdateSupplier" type="submit" name="supplier-update">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Update
                        </button>
                    </div>

                </div>
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