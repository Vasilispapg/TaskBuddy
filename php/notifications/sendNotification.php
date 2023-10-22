<?php
session_name('user');
session_start(); // Make sure the session is started

include_once '../connection.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $toUserID = $_POST['to_user_id'];
    $message = $_POST['message'];
    $postID = $_POST['postID'];
    $type = $_POST['type'];
    $seen = 'false';

    // Insert the notification into the database
    $sql = "INSERT INTO notifications (to_user_id, message, created_at,from_user_id,postID,seen,type) VALUES (?, ?, NOW(),?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiiss", $toUserID, $message,$_SESSION['id'],$postID,$seen,$type);
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
    $conn->close();
}
?>
