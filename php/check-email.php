<?php
$email = $_GET['email'];

$con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
if (mysqli_connect_errno() || !$con) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    // Use prepared statement to avoid SQL injection
    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "This email already exists";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
