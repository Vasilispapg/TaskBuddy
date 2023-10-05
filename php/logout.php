<?php
session_name('user');
session_start();

$con = mysqli_connect("localhost", "root", "", "taskbuddynw");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Mark the user as 'offline' in the database
    $userId = $_SESSION['id'];
    $sql = "UPDATE users SET status='offline' WHERE id=$userId";
    mysqli_query($con, $sql);

    // Unset and destroy the session
    session_unset();
    session_destroy();

   // Loop through all cookies and set them to expire
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', 1, '/');
        }
    }

}

mysqli_close($con);

// Redirect to the login page or any other page after logout
header("location: ../index.php");
?>
