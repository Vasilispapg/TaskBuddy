<?php
// Assuming you have a database connection established
$con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");

if (mysqli_connect_errno() || !$con) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    // Get the sender and receiver IDs from the request (you should validate and sanitize user input)
    $senderId = $_GET['sender_id'];
    $receiverId = $_GET['receiver_id'];

    // Fetch chat messages from the database
    $query = "SELECT * FROM message WHERE (sender_id = $senderId AND receiver_id = $receiverId) OR (sender_id = $receiverId AND receiver_id = $senderId) ORDER BY created_at ASC";

    $result = mysqli_query($con, $query);

    // Check if there are any messages
    if (mysqli_num_rows($result) > 0) {
        $messages = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = array(
                'sender' => $row['sender_id'],
                'message' => $row['message'],
                'timestamp' => $row['created_at']
            );
        }

        // Return the messages as JSON
        header('Content-Type: application/json');
        echo json_encode($messages);
    } else {
        echo "No messages found.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
