<?php
$phone = $_GET['phone'];

$con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
if (mysqli_connect_errno() || !$con) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    // Use prepared statement to avoid SQL injection
    $sql = "SELECT phone FROM users WHERE phone=?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "This phone already exists";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
