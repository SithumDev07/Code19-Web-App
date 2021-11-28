<?php

require '../config.php';

if (isset($_POST['cardid'])) {
    $cardid = $_POST['cardid'];
    $nameuponcard = $_POST['nameuponcard'];
    $cardnumber = $_POST['cardnumber'];
    $cardtype = $_POST['cardtype'];
    $expiredate = $_POST['expiredate'];
    $cvc = $_POST['cvc'];


    if (empty($cardid) || empty($nameuponcard) || empty($cardnumber) || empty($cardtype) || empty($expiredate) || empty($cvc)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $cardid $nameuponcard $cardnumber $cardtype";
        exit();
    } else {

        $sql = "UPDATE paymentmethod SET card_number=?, card_type=?, name_upon_card=?, expire_date=?, cvc=? WHERE id=?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR - PAYMENT UPDATE";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'issssi', $cardnumber, $cardtype, $nameuponcard, $expiredate, $cvc, $cardid);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);


            echo "successfully updated";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
