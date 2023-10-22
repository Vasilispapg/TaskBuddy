<?php

include_once '../connection.php'; 


    $token = $_GET['token'];

    // Check if the token exists in the database and hasn't expired
    $sql = "SELECT user_email, token_expiry FROM conf WHERE conf_token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();

    if ($stmt->fetch()) {
        $stmt->close();
        // Token is valid and hasn't expired
        // Mark the user's email as confirmed in your database
        $sql2 = "UPDATE users SET valid_email= ('true') WHERE email = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $_SESSION['email']);
        $stmt2->execute();
        $stmt2->close();
        $conf=true;

        // Delete the token from the database
        $sql3 = "DELETE FROM conf WHERE conf_token = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("s", $token);
        $stmt3->execute();
        $stmt3->close();
        
        // exit();
    } else {
       $conf=false;
       $stmt->close();
    }



?>