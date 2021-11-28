<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {
    $foodId = $_POST['id'];
    $prevFile;

    // ? Getting previous ingredients data
    $sql = "SELECT * FROM food WHERE id =" . $foodId .";";
    $results = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($results);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            $prevFile = $row['photo'];
        }
    }
    // ?

    // TODO Add validation on toppings ids later
    if (empty($foodId) || empty($prevFile)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $foodId $prevFile";
        exit();
    } else {

        $prevFileDestination = '../photo_uploads/foods/' . $prevFile;
        if (!unlink($prevFileDestination)) {
            echo ("$prevFileDestination cannot be deleted due to an error");
        } else {
            echo ("$prevFileDestination has been deleted");
        }

        $sql = "DELETE FROM ingredient_food WHERE food_id=?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error food part";
            exit();
        } else {
            $rating = 0.0;
            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $foodId);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }


        $sql = "DELETE FROM food WHERE id=?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "sql error food part";
            exit();
        } else {
            $rating = 0.0;
            $bindFailed = mysqli_stmt_bind_param($statement, 'i', $foodId);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
        }

        // TODO here
        echo "successfully Deleted $foodId";
        exit();
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
