<?php

function uploadImage($username,$post_id) {
    $uploadDirectory = '../../assets/post_images/'; // Change this to your desired directory
    $uploadedFileName = $_FILES['image']['name'];

    // Generate a unique filename based on the username
    $username = strtolower($username); // Convert username to lowercase
    $username = preg_replace('/\s+/', '_', $username); // Replace spaces with underscores

    $uploadedFileName = $post_id . '_' . $username .'_'.$uploadedFileName;

    $targetFilePath = $uploadDirectory . $uploadedFileName;

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        // File upload successful, return the file path
        return $targetFilePath;
    } else {
        // Failed to upload the image
        return null;
    }
}

session_name('user');
session_start();

include_once '../connection.php'; 


    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $title = $_POST['edit_title'];
        $description = $_POST['edit_desc'];
        $price = $_POST['edit_price'];
        $category = $_POST['edit_category'];
        $expireDate = $_POST["year"] . '/' . $_POST["month"] . '/' . $_POST["day"];

        // Check if the user has permission to update the post (you can add your own authorization logic here)

        // Update the post information in the database
        $sql = "UPDATE posts SET title = ?, description = ?, price = ?, category = ?, end_time = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $title, $description, $price, $category, $expireDate, $post_id);

        if($_FILES['image']['name']){
            $imagePath = uploadImage($_SESSION['username'],$post_id);
            $sqlImage="UPDATE post_images set post_id = ? ,image_url =?";
            $stmt2 = $conn->prepare($sqlImage);
            $stmt2->bind_param("ss", $post_id, $imagePath);
            if($stmt2->execute()){
                echo json_encode(array("success" => "Post updated successfully"));
            }
            else{
                echo json_encode(array("error" => "Error updating the post: " . $stmt->error));
            }
            $stmt2->close();
        }
        if ($stmt->execute() ) {
            echo json_encode(array("success" => "Post updated successfully"));
            header("Location: ../../dashboard.php");
        } else {
            echo json_encode(array("error" => "Error updating the post: " . $stmt->error));
        }

        $stmt->close();
        $conn->close();

        
    } else {
        echo json_encode(array("error" => "Invalid request"));
    }

?>
