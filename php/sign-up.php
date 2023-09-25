<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input from the form
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    if (isset($_POST['checkbox']) && $_POST['checkbox'] == 'buddy') {
        // The checkbox is checked, set the role to 'taskbuddy'
        $role = 'taskbuddy';
    } else {
        // The checkbox is not checked, set the role to 'user'
        $role = 'user';
    }
    
    // You can then insert the $role value into your database when registering the user.
    
    $created_at = date("Y-m-d H:i:s"); // Current date and time

    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $dbname = "taskbuddynw";
    echo "Connected successfully";

    $conn = new mysqli($servername, "root", "", $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the user data into the "users" table
    $sql = "INSERT INTO users (username, email, password_hash, role, created_at,fullname)
            VALUES ('$username', '$email', '$hashedPassword', '$role', '$created_at','$fullname')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    include 'usrlogin.php'; //ektelei me tin mia to login
}
?>
