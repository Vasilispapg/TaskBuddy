<?php
session_name('user');
session_start();

$conn = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");

if (mysqli_connect_errno() || !$conn) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
} else {
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];

        // Query the database to retrieve post details based on the post_id
        $sql = "SELECT title, description, price, category, end_time FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $post_details = array(
                    "title" => $row['title'],
                    "description" => $row['description'],
                    "price" => $row['price'],
                    "category" => $row['category'],
                    "end_time" => $row['end_time']
                );
                echo json_encode($post_details);
            } else {
                echo json_encode(array("error" => "Post not found"));
            }
        } else {
            echo json_encode(array("error" => "Error executing the query: " . $stmt->error));
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(array("error" => "Invalid request"));
    }
}
?>
