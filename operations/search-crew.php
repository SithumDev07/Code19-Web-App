<?php


if (isset($_POST['query'])) {
    include '../config.php';

    $sql = "SELECT * FROM staff_member WHERE name LIKE '%" . $_POST['query'] . "%';";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {

            echo $row['name'];

        }
    } else {
        echo "Nothing Found";
    }
}
