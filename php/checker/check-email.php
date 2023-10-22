<?php
$email = $_GET['email'];

include_once '../connection.php'; 


    // Use prepared statement to avoid SQL injection
    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "This email already exists";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);

?>


