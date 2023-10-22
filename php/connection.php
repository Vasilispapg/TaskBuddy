<?php
// Database connection details
$host = "localhost"; // Database server hostname
$username = "root"; // Database username
$password = ""; // Database password
$database = "taskbuddynw"; // Database name

// Create a new database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>