<?php
session_name('user');
session_start(); // Make sure the session is started

// Your database connection code here
$mysqli = new mysqli("localhost", "root", "", "taskbuddynw");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $toUserID = $_POST['to_user_id'];
    $message = $_POST['message'];
    $postID = $_POST['postID'];
    $seen = 'false';

    // Insert the notification into the database
    $sql = "INSERT INTO notifications (to_user_id, message, created_at,from_user_id,postID,seen) VALUES (?, ?, NOW(),?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("isiis", $toUserID, $message,$_SESSION['id'],$postID,$seen);
    // echo $stmt->$argv;

    if ($stmt->execute()) {
        // Notification sent successfully
        echo "Notification sent successfully!";
    } else {
        // Handle the error
        echo "Error sending notification.";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
