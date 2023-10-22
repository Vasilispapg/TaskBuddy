<?php
session_name('user');
session_start();

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


include_once '../connection.php'; 


    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $expireDate = $_POST["year"] . '/' . $_POST["month"] . '/' . $_POST["day"];
        $created_at = date("Y-m-d H:i:s");
        $user_id=$_SESSION['id'];
        $user_location=$_SESSION['location'];
        $status='active';

        $sql = "INSERT INTO posts (title, description, user_id, price, category , status , end_time, location, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
        $stmt = $conn->prepare($sql);

        // print_r($title, $desc, $_SESSION['id'], $price, $category, 'active', $expireDate, $_SESSION['location'], $created_at);
        
        $stmt->bind_param("sssssssss", $title, $desc, $user_id, $price, $category, $status, $expireDate, $user_location, $created_at);

        if ($stmt->execute()) {
            $post_id = $conn->insert_id;
            $imagePath = uploadImage($_SESSION['username'],$post_id);
            if ($imagePath === null) {
                echo "Failed to upload the image.";
            }
            else{
                 // Check if 'image' was uploaded
                $sqlImage="INSERT INTO post_images (post_id,image_url) VALUES ('$post_id','$imagePath')";
                $stmt = $conn->prepare($sqlImage);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header("Location: ../../browseTasks.php");
            }
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

    }


?>