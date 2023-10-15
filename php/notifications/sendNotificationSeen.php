<?php
function sendNotificationSeen($notification_ids, $db_connection) {
    // Prepare the query
    $query = "UPDATE notifications SET seen = 'true' WHERE id = ?";
    $statement = $db_connection->prepare($query);
    
    if (!$statement) {
        // Handle the case where the query preparation fails
        return json_encode(["status" => "error", "message" => "Error preparing the query"]);
    }
    
    $results = [];

    // Loop through the notification IDs and execute the query for each
    foreach ($notification_ids as $notification_id) {
        // Bind the parameters
        $statement->bind_param("i", $notification_id);
    
        // Execute the query
        $statement->execute();
    
        // Check if the query was successful
        if ($statement->affected_rows > 0) {
            $results[] = ["status" => "success", "notification_id" => $notification_id];
        } else {
            $results[] = ["status" => "error", "notification_id" => $notification_id, "message" => "Error sending the query"];
        }
    }

    $statement->close(); // Close the prepared statement

    return json_encode(["status" => "batch_update", "results" => $results]);
}

session_name('user');
session_start();

$conn = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");

if (mysqli_connect_errno() || !$conn) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
} else {
    // Get JSON data from the request body
    $inputJSON = file_get_contents("php://input");
    $inputData = json_decode($inputJSON);
    if ($inputData && isset($inputData->notID) && is_array($inputData->notID)) {
        echo sendNotificationSeen($inputData->notID, $conn);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid input data"]);
    }
}

$conn->close();

?>
