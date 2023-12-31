<?php
    session_name('user');
    session_start(); // Make sure the session is started

    include_once '../connection.php'; 



    // Get data from the GET request
    $userID = $_SESSION['id']; // ID of the logged-in user
    $receiverID = $_GET['receiverID']; // ID of the user you clicked on
    $postID = $_GET['postID']; // ID of the post for which you want to retrieve messages

    // Query to retrieve messages for the post from the identified user
    $query = "SELECT DISTINCT m.*, 
            u_receiver.fullname AS receiver_username,
            u_sender.fullname AS sender_username
            FROM messages AS m
            INNER JOIN users AS u_receiver ON u_receiver.id = m.outgoing_msg_id
            INNER JOIN users AS u_sender ON u_sender.id = m.incoming_msg_id
            WHERE ((m.incoming_msg_id = '$userID' AND m.outgoing_msg_id = '$receiverID')
            OR (m.incoming_msg_id = '$receiverID' AND m.outgoing_msg_id = '$userID'))
            AND m.post_id = '$postID'
            ORDER BY m.created_at ASC";

    $result = mysqli_query($conn, $query);

    $messages = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        mysqli_free_result($result);
    } else {
        // Handle the error
        echo "Error: " . mysqli_error($conn);
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($messages);
?>
