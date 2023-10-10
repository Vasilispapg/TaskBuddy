<?php
session_name('user');
session_start();

$conn = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");

if (mysqli_connect_errno() || !$conn) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
} else {
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $title = $_POST['edit_title'];
        $description = $_POST['edit_desc'];
        $price = $_POST['edit_price'];
        $category = $_POST['edit_category'];
        $end_time = $_POST['edit_expireDate'];

        // Check if the user has permission to update the post (you can add your own authorization logic here)

        // Update the post information in the database
        $sql = "UPDATE posts SET title = ?, description = ?, price = ?, category = ?, end_time = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $title, $description, $price, $category, $end_time, $post_id);

        if ($stmt->execute()) {
            echo json_encode(array("success" => "Post updated successfully"));
            header("Location: ../dashboard.php");
        } else {
            echo json_encode(array("error" => "Error updating the post: " . $stmt->error));
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(array("error" => "Invalid request"));
    }
}
?>
