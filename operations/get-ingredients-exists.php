<?php

include '../config.php';


function Render($results)
{

    while ($row = mysqli_fetch_assoc($results)) {
?>
        <div class="flex items-center">
        <p class="" id="SelectedIngredientId"><?php echo $row['id']; ?></p>
        <p class="ml-3"><?php echo $row['name']; ?></p>
        </div>
        <?php
    }
}

if (isset($_POST['query'])) {

    $sql;
    $results;
    $message;

    // if (!is_numeric($_POST['query'])) {
    //     $sql = "SELECT * FROM ingredient WHERE name = '" . $_POST['query'] . "';";
    //     $results = mysqli_query($conn, $sql);
    //     $message = "No Results Found For ID-" . $_POST['query'];
    // } else {
    //     $sql = "SELECT * FROM supplier WHERE name LIKE '%" . $_POST['query'] . "%';";
    //     $sql = "SELECT * FROM supplier INNER JOIN supplier_contact ON supplier.id = supplier_contact.id WHERE supplier.name LIKE '%" . $_POST['query'] . "%' order by supplier_contact.contact_no desc limit 1;";
    //     $results = mysqli_query($conn, $sql);
    //     $message = "No Results Found For Name " . $_POST['query'];
    // }

    $sql = "SELECT * FROM ingredient WHERE name = '" . $_POST['query'] . "';";
    $results = mysqli_query($conn, $sql);
    $message = "No Results Found For Name -" . $_POST['query'];


    if (mysqli_num_rows($results) > 0) {
        $resultCheck = mysqli_num_rows($results);

        if ($resultCheck > 0) {
            Render($results);
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
} else {
    echo 'Something went wrong';
}
?>