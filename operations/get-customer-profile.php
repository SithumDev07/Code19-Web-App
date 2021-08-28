<?php
include '../config.php';

$due;
$primaryColor;
$secondaryColor;
function Render($results, $address, $phone)
{

    while ($row = mysqli_fetch_assoc($results)) {
        $fullname = $row['name'];
        $firstName = substr($fullname, 0, strpos($fullname, ' '));
        $lastName = substr($fullname, strpos($fullname, ' ') + 1);
?>
        <div class="flex justify-center">
            <div class="w-48 h-48 rounded-full overflow-hidden relative cursor-pointer profile-picture-customer">
                <i class="fas fa-camera text-white absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl z-10"></i>
                <img id="profile" class="transform transition hover:opacity-50 duration-300" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Profile">
                <input type="file" name="profileUploadCustomer" id="upload-profile-customer">
            </div>
        </div>
        <div class=" flex items-center w-full flex-wrap mt-10">
            <input type="text" class="text-gray-200 flex-1 rounded-md rounded-r-none px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" placeholder="First Name" name="firstname" id="FirstNameCustomerProfile" value="<?php echo $firstName; ?>">
            <input type="text" class="text-gray-200 flex-1 ml-2 rounded-md rounded-l-none px-3 py-3 mt-4 bg-transparent border border-gray-200 placeholder-gray-300" placeholder="Last Name" name="lastname" id="LastNameCustomerProfile" value="<?php echo $lastName; ?>">
        </div>
        <input type="number" placeholder="Phone Number" class="text-gray-200 rounded-md w-full px-3 py-3 mt-6 bg-transparent border border-gray-200 placeholder-gray-300" id="CustomerPersonalNumber" name="phone" value="<?php echo $phone; ?>">
        <textarea type="text" placeholder="Address" class="text-gray-200 rounded-md w-full px-3 py-3 mt-6 bg-transparent border border-gray-200 placeholder-gray-300" id="AddressCustomerProfile" name="address"><?php echo $address; ?></textarea>
        <button type="submit" class="relative w-full rounded-md mt-5 flex items-center justify-center bg-blue-600 p-3 text-gray-300 text-sm font-semibold h-14 hover:bg-blue-700 transition duration-300" id="UpdateCustomerProfile">
            Update Profile
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute top-1/2 right-5 transform -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </button>
        <div class="flex items-center mt-2 mb-5">
            <button type="submit" class="w-full rounded-md mt-5 flex flex-1 mr-5 items-center justify-center p-3 text-red-500 text-sm font-semibold transform h-14 hover:scale-105 transition duration-150 active:scale-90" id="DeleteCustomerProfile">
                Delete Account
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
            <button type="submit" class="w-full rounded-md mt-5 flex flex-1 items-center justify-center text-black p-3 text-sm font-semibold h-14 transform hover:scale-105 transition duration-150 active:scale-90" id="LogOutCustomerProfile">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>

        </div>
        <?php
    }
}

if (isset($_POST['id'])) {

    $sql;
    $results;
    $message;
    $id = $_POST['id'];

    // ? Getting address
    $sql = "SELECT * FROM customer_address WHERE customer_id = " . $id . " LIMIT 1;";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);
    $address = '';

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            $address = $row['address'];
        }
    }


    // ? Getting PhoneNumber
    $sql = "SELECT * FROM customer_phone WHERE customer_id = " . $id . " LIMIT 1;";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);
    $phone = '';

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            $phone = $row['phone'];
        }
    }

    $sql = "SELECT * FROM customer WHERE id = " . $id . ";";
    $results = mysqli_query($conn, $sql);
    $message = "No Results Found For UserId " . $_POST['id'];

    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results, $address, $phone);
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