<?php

require '../config.php';

// TODO reset isset function
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $prevFile = $_POST['prev_file'];

    $prevFileDestination = '../photo_uploads/users/' . $prevFile;
    
    $sql = "DELETE FROM staff_member WHERE id=?;";
                  
    $statement = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($statement, $sql)) {
        // header("Location: ../dashboard.php?signup.php&error=sql_error");
        echo "sql error";
        exit();
    } else {

        mysqli_stmt_bind_param($statement, 'i', $id);
        
        mysqli_stmt_execute($statement);

        if (!unlink($prevFileDestination)) { 
            echo ("$prevFileDestination cannot be deleted due to an error"); 
        } 
        else { 
            echo ("$prevFileDestination has been deleted"); 
        } 
        
        
        echo "success";
        exit();
    }
      
    
} else {
    // header("Location: ../dashboard.php?error=accessforbidden");
    echo "main error";
    exit();
}
