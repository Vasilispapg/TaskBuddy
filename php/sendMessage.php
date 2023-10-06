<?php
session_name('user');
session_start(); // Make sure the session is started

// Your database connection code here
$mysqli = new mysqli("localhost", "root", "", "taskbuddynw");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to check if a row already exists in post_id_messages
function doesRowExist($mysqli, $hostId, $buddyId, $postId) {
    $query = "SELECT id FROM post_id_messages WHERE host_id = ? AND buddy_id = ? AND post_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sss", $hostId, $buddyId, $postId);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

// Get JSON data from the request body
$inputJSON = file_get_contents("php://input");
$inputData = json_decode($inputJSON);
if ($inputData) {
    $incomingMsgId = $inputData->receiverID; // ID of the recipient user
    $postID = $inputData->postID; // ID of the post
    $message = mysqli_real_escape_string($mysqli, $inputData->message);

    // Get the sender's user ID from the session (you may need to adjust this)
    $senderID = $_SESSION['id'];
    $isBuddy = $_SESSION['isBuddy'];

    // Insert the message into the database (messages table)
    $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, post_id, created_at) VALUES (?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);

    // Use prepared statements to prevent SQL injection
    $stmt->bind_param("sssss", $incomingMsgId, $senderID, $message, $postID, $formattedDate);

    date_default_timezone_set('Europe/Athens');
    $currentTimestamp = time();
    $formattedDate = date('Y-m-d H:i:s', $currentTimestamp);

    if ($stmt->execute()) {
        // Message sent successfully to messages table

        // Check if the row already exists in post_id_messages
        if (!doesRowExist($mysqli, $incomingMsgId, $senderID, $postID)) {
            // The row does not exist, proceed with the insertion
            $query2 = "INSERT INTO post_id_messages (host_id, buddy_id, post_id) VALUES (?, ?, ?)";
            $stmt2 = $mysqli->prepare($query2);

            // Use prepared statements to prevent SQL injection
            if ($isBuddy) {
                $stmt2->bind_param("sss", $incomingMsgId, $senderID, $postID);
            } else {
                $stmt2->bind_param("sss", $senderID, $incomingMsgId, $postID);
            }

            if ($stmt2->execute()) {
                // Message sent successfully to post_id_messages table
                echo json_encode(["status" => "success"]);
            } else {
                // Handle the error for the second query
                echo json_encode(["status" => "error", "message" => "Error sending message to post_id_messages table"]);
            }

            $stmt2->close();
        } else {
            // The row already exists in post_id_messages
            echo json_encode(["status" => "success"]);
        }

        $stmt->close();
    } else {
        // Handle the error for the first query
        echo json_encode(["status" => "error", "message" => "Error sending message to messages table"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error getting data"]);
}

$mysqli->close();
?>
