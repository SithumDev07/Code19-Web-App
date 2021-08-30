<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['sessionId'])) {
    $userId = $_POST['sessionId'];
    $nameuponcard = $_POST['nameuponcard'];
    $cardnumber = $_POST['cardnumber'];
    $cardtype = $_POST['cardtype'];
    $expiredate = $_POST['expiredate'];
    $cvc = $_POST['cvc'];


    if (empty($userId) || empty($nameuponcard) || empty($cardnumber) || empty($cardtype) || empty($expiredate) || empty($cvc)) {
        // header("Location: ../dasboard.php?error=empty_fields");
        echo "empty fields $userId $nameuponcard $cardnumber $cardtype";
        exit();
    } else {

        $sql = "INSERT INTO paymentmethod(customer_id, card_number, card_type, name_upon_card, expire_date, cvc) VALUES (?, ?, ?, ?, ?, ?);";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL SERVER ERROR - PAYMENT";
            exit();
        } else {

            $bindFailed = mysqli_stmt_bind_param($statement, 'issssi', $userId, $cardnumber, $cardtype, $nameuponcard, $expiredate, $cvc);
            if ($bindFailed === false) {
                echo htmlspecialchars($statement->error);
                exit();
            }
            mysqli_stmt_execute($statement);
            $newpaymentId = mysqli_stmt_insert_id($statement);


            echo "success all $newpaymentId";
            exit();
        }
    }
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
