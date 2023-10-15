<?php

function deleteUser($userID) {
    
    // Replace these with your database connection details
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "taskbuddynw";

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deletePostSQL = "SELECT id FROM posts WHERE user_id = ?";
    $stmtDeletePost = $conn->prepare($deletePostSQL);
    $stmtDeletePost->bind_param("i", $userID);
    $stmtDeletePost->execute();
    foreach($stmtDeletePost->get_result() as $row){
        echo $row['id'];
        deletePost($row['id']);
        
    }
    $stmtDeletePost->close();

    
    @include_once 'php/post/deletePost.php?post_id='.$userID;

    // Prepare the SQL statement to delete the post and its associated images
    $deleteUserSQL = "DELETE FROM users WHERE id = ?";
    $deleteMessageSQL = "DELETE FROM messages WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?)";
    $deletePostIdMessageSQL = "DELETE FROM post_id_messages WHERE (incoming_id = ? OR outgoing_id = ?)";
    $deleteNotSQL = "DELETE FROM notifications WHERE (to_user_id = ? OR from_user_id = ?)";

    // Use prepared statements to prevent SQL injection
    $deleteUser = $conn->prepare($deleteUserSQL);
    $deleteMessage = $conn->prepare($deleteMessageSQL);
    $deleteNot = $conn->prepare($deleteNotSQL);
    $deletePostIdMessage = $conn->prepare($deletePostIdMessageSQL);

    // Bind the post ID as a parameter

    $deleteUser->bind_param("i", $userID);
    $deleteMessage->bind_param("ii", $userID,$userID);
    $deleteNot->bind_param("ii", $userID,$userID);
    $deletePostIdMessage->bind_param("ii", $userID,$userID);

    // Execute the statements
    $success = $deletePostIdMessage->execute() &&  $deleteNot->execute() && $deleteMessage->execute()  && $deleteUser->execute() ;

    // Close the statements and the connection
    $deleteUser->close();
    $deleteMessage->close();
    $deleteNot->close();
    $deletePostIdMessage->close();
    $conn->close();

    return $success;
}

// Check if a post ID was provided through a GET request
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];

    // Attempt to delete the post
    if (deleteUser($userID)) {
        // Post deletion was successful
        header("Location: ../../users.php");
        exit();
    } else {
        // Post deletion failed
        echo "Failed to delete the post.";
    }
} else {
    echo "No post ID provided.";
}
?>
