<?php
include '../config.php';

function Render($results)
{

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
                <h1 class="flex-1 m-3 text-3xl font-semibold text-gray-600 text-center">
                    <?php
                    if ($row['type'] == 'g') {
                        if ($row['remaining_units'] >= 1000) {
                            echo ($row['remaining_units'] * 0.001) . "Kg";
                        } else {
                            echo ($row['remaining_units']) . "g";
                        }
                    } else if ($row['type'] == 'ml') {
                        if ($row['remaining_units'] >= 1000) {
                            echo ($row['remaining_units'] * 0.001) . "Ltr";
                        } else {
                            echo ($row['remaining_units']) . "ml";
                        }
                    } else if ($row['type'] == 'pieces') {
                        echo ($row['remaining_units']) . "pcs";
                    } else {
                        echo ($row['remaining_units'] * 0.01);
                    }
                    ?>
                </h1>
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
}

if (isset($_POST['query'])) {

    $sql;
    $results;
    $message;

    if (is_numeric($_POST['query']) && strlen($_POST['query']) != 10) {
        $sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id WHERE purchase.ingredient_id = " . $_POST['query'] . ";";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For ID -" . $_POST['query'];
    } else if (filter_var($_POST['query'], FILTER_VALIDATE_EMAIL)) {

        // ? search for MX Record
        // if (!checkdnsrr($domain, 'MX')) {
        //     // domain is not valid
        // }

        $sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id WHERE supplier.email = '" . $_POST['query'] . "';";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For Email - " . $_POST['query'];
    } else if (is_numeric($_POST['query']) && strlen($_POST['query']) == 10) {
        $sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id WHERE communication.contact = '" . $_POST['query'] . "';";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For Contact Number - " . $_POST['query'];
    } else {
        // $sql = "SELECT * FROM supplier WHERE name LIKE '%" . $_POST['query'] . "%';";
        $sql = "select * from ingredient join (select sum(cost) as total, ingredient_id, supplier_id from supplier_ingredient group by ingredient_id) as purchase on ingredient.id = purchase.ingredient_id join (select name as supplier, email, id from supplier) as supplier on supplier.id = purchase.supplier_id join (select max(contact_no) as contact, id as supplier_contact_id from supplier_contact group by supplier_contact_id) as communication on communication.supplier_contact_id = supplier.id WHERE supplier.supplier like '%" . $_POST['query'] . "%' OR name like '%" . $_POST['query'] . "%';";
        $results = mysqli_query($conn, $sql);
        $message = "No Results Found For Name " . $_POST['query'];
    }



    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results);
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