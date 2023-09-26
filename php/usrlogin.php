<?php

$user = $_POST['username'];
$pass = $_POST['password'];

$con = mysqli_connect("localhost", "root", "", "taskbuddynw");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $user = mysqli_real_escape_string($con, $user);

    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedHashedPassword = $row['password_hash'];

            // Verify the entered password against the stored hashed password
            if (password_verify($pass, $storedHashedPassword)) {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Handle other login validations (username, password, etc.)

                    if (isset($_POST["remember_me"])) {
                        // If "Remember Me" is selected, set a cookie with a long expiration time
                        $cookie_name = "user";
                        $cookie_value = $row['id']; // Store a user identifier
                        $cookie_expiration = time() + 30 * 24 * 60 * 60; // 30 days (adjust as needed)
                        
                        setcookie($cookie_name, $cookie_value, $cookie_expiration, "/");
                    }

                    // Perform the login and redirect the user as needed
                }

                session_name('user');
                session_start();
                $_SESSION['error'] = 0;
                $_SESSION["username"] = $user; // Set the username in the session
                header("location:../index.php");
                exit(); // Add this line to prevent further execution
            } else {
                $_SESSION['error'] = 1;
                header("location:../login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = 1;
            header("location:../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 1;
        header("location:../login.php");
        exit();
    }
    mysqli_close($con);
}
?>
