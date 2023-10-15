<?php
session_name('user');
session_start();

function deleteMessages($conn,$post_id){
    $deleteMessages="DELETE FROM messages WHERE post_id = ?";
    $stmtDeleteMessages = $conn->prepare($deleteMessages);
    $stmtDeleteMessages->bind_param("i", $post_id);
    $stmtDeleteMessages->execute();
    $stmtDeleteMessages->close();
}
function deleteMessagesIDPost($conn,$post_id){
    $deleteMessages="DELETE FROM post_id_messages WHERE post_id = ?";
    $stmtDeleteMessages = $conn->prepare($deleteMessages);
    $stmtDeleteMessages->bind_param("i", $post_id);
    $stmtDeleteMessages->execute();
    $stmtDeleteMessages->close();
}

function deletePost($post_id) {
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

    // Prepare the SQL statement to delete the post and its associated images
    $deletePostSQL = "DELETE FROM posts WHERE id = ?";
    $deleteImagesSQL = "DELETE FROM post_images WHERE post_id = ?";

    // Use prepared statements to prevent SQL injection
    $stmtDeletePost = $conn->prepare($deletePostSQL);
    $stmtDeleteImages = $conn->prepare($deleteImagesSQL);

    // Bind the post ID as a parameter
    $stmtDeletePost->bind_param("i", $post_id);
    $stmtDeleteImages->bind_param("i", $post_id);

    deleteMessagesIDPost($conn,$post_id);
    deleteMessages($conn,$post_id);
    // Execute the statements
    $success =$stmtDeleteImages->execute() && $stmtDeletePost->execute() ;

    // Close the statements and the connection
    $stmtDeletePost->close();
    $stmtDeleteImages->close();
    $conn->close();

    return $success;
}

// Check if a post ID was provided through a GET request
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Attempt to delete the post
    if (deletePost($post_id)) {
        // Post deletion was successful
        header("Location: ../../dashboard.php");
        exit();
    } else {
        // Post deletion failed
        echo "Failed to delete the post.";
    }
} else {
    echo "No post ID provided.";
}
?>
