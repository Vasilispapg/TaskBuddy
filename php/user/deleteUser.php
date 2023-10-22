<?php

include_once '../connection.php'; 


function deleteAuthEmail($id, $conn) {
    $sqlDeleteAuth = "DELETE FROM conf WHERE user_id = ?";
    $stmtDeleteAuth = $conn->prepare($sqlDeleteAuth);
    $stmtDeleteAuth->bind_param("i", $id);
    $stmtDeleteAuth->execute();
    $stmtDeleteAuth->close();
}

function deleteMessages($userID, $conn) {
    $deleteMessageSQL = "DELETE FROM messages WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?)";
    $stmtDeleteMessage = $conn->prepare($deleteMessageSQL);
    $stmtDeleteMessage->bind_param("ii", $userID, $userID);
    $stmtDeleteMessage->execute();
    $stmtDeleteMessage->close();
}

function deleteNotifications($userID, $conn) {
    $deleteNotSQL = "DELETE FROM notifications WHERE (to_user_id = ? OR from_user_id = ?)";
    $stmtDeleteNot = $conn->prepare($deleteNotSQL);
    $stmtDeleteNot->bind_param("ii", $userID, $userID);
    $stmtDeleteNot->execute();
    $stmtDeleteNot->close();
}

function deletePostIdMessages($userID, $conn) {
    $deletePostIdMessageSQL = "DELETE FROM post_id_messages WHERE (incoming_id = ? OR outgoing_id = ?)";
    $stmtDeletePostIdMessage = $conn->prepare($deletePostIdMessageSQL);
    $stmtDeletePostIdMessage->bind_param("ii", $userID, $userID);
    $stmtDeletePostIdMessage->execute();
    $stmtDeletePostIdMessage->close();
}

function deletePosts($userID, $conn) {
    $deletePostSQL = "SELECT id FROM posts WHERE user_id = ?";
    $stmtDeletePost = $conn->prepare($deletePostSQL);
    $stmtDeletePost->bind_param("i", $userID);
    $stmtDeletePost->execute();

    $result = $stmtDeletePost->get_result();
    while ($row = $result->fetch_assoc()) {
        deletePost($row['id'], $conn);
    }

    $stmtDeletePost->close();
}

function deleteUser($userID, $conn) {
    // Handle user-related data deletion
    deleteMessages($userID, $conn);
    deleteNotifications($userID, $conn);
    deletePostIdMessages($userID, $conn);

    // Delete user's posts
    deletePosts($userID, $conn);

    // Delete authentication-related data
    deleteAuthEmail($userID, $conn);

    // Delete the user
    $deleteUserSQL = "DELETE FROM users WHERE id = ?";
    $stmtDeleteUser = $conn->prepare($deleteUserSQL);
    $stmtDeleteUser->bind_param("i", $userID);
    $success = $stmtDeleteUser->execute();
    $stmtDeleteUser->close();

    return $success;
}

if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];

    if (deleteUser($userID, $conn)) {
        // User deletion was successful
        header("Location: success_page.php"); // Redirect to a success page
        exit();
    } else {
        // User deletion failed
        echo "Failed to delete the user.";
    }
} else {
    echo "No user ID provided.";
}

$conn->close(); // Close the database connection
?>
