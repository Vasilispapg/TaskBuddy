<?php
session_name('user');
session_start(); // Make sure the session is started

include_once '../connection.php'; 



// Function to check if a row already exists in post_id_messages
function doesRowExist($conn, $incoming_id, $outgoing_id, $post_id) {
    $query = "SELECT id FROM post_id_messages WHERE ((incoming_id = ? AND outgoing_id = ?) OR (incoming_id = ? AND outgoing_id = ?)) AND post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $incoming_id, $outgoing_id, $outgoing_id, $incoming_id, $post_id);
    $stmt->execute();
    $stmt->store_result();
    
    // Fetch the result to check for the existence of a row
    $stmt->fetch();
    
    return $stmt->num_rows > 0;
}

// Get JSON data from the request body
$inputJSON = file_get_contents("php://input");
$inputData = json_decode($inputJSON);
if ($inputData) {
    $incomingMsgId = $inputData->receiverID; // ID of the recipient user
    $postID = $inputData->postID; // ID of the post
    $message = mysqli_real_escape_string($conn, $inputData->message);

    // Get the sender's user ID from the session (you may need to adjust this)
    $senderID = $_SESSION['id'];

    // Insert the message into the database (messages table)
    $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, post_id, created_at) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($query);

    // Use prepared statements to prevent SQL injection
    $stmt->bind_param("sssss", $incomingMsgId, $senderID, $message, $postID, $formattedDate);

    date_default_timezone_set('Europe/Athens');
    $currentTimestamp = time();
    $formattedDate = date('Y-m-d H:i:s', $currentTimestamp);

    if ($stmt->execute()) {
        // Message sent successfully to messages table

        // Check if the row already exists in post_id_messages
        if (!doesRowExist($conn, $incomingMsgId, $senderID, $postID)) {
            // The row does not exist, proceed with the insertion
            $query2 = "INSERT INTO post_id_messages (incoming_id, outgoing_id, post_id) VALUES (?, ?, ?)";
            $stmt2 = $conn->prepare($query2);

            // Use prepared statements to prevent SQL injection
            $stmt2->bind_param("sss", $senderID, $incomingMsgId, $postID);

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

$conn->close();
?>
