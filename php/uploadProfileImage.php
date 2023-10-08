<?php
session_name('user');
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to login page or handle unauthorized access
    header("location:../login.php");
    exit();
}

function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "taskbuddynw";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        header('location:../profile.php?changed=false');

    }
    return $conn;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a new image file was uploaded
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {

        // Define the upload directory and file path
        $uploadDirectory = '../assets/user_images/';
        $uploadedFileName = $_FILES['new_image']['name'];
        $username = $_SESSION['username'];

        // Generate a unique filename based on the username
        $username = strtolower($username); // Convert username to lowercase
        $username = preg_replace('/\s+/', '_', $username); // Replace spaces with underscores
        $uploadedFileName = $username . '_' . $uploadedFileName;

        $targetFilePath = $uploadDirectory . $uploadedFileName;

        $_SESSION['image_path'] = $targetFilePath;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['new_image']['tmp_name'], $targetFilePath)) {
            // File upload successful, update the image_path in the database
            $conn = connectToDatabase();

            // Update the image_path in the database for the logged-in user
            $updateSql = "UPDATE users SET image_path = ? WHERE username = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ss", $targetFilePath, $username);

            if ($stmt->execute()) {
                // Update successful
                echo "Profile picture updated successfully.";
                header('location:../profile.php?changed=true');
            } else {
                echo "Error updating profile picture: " . $stmt->error;
                header('location:../profile.php?changed=false');
            }

            $stmt->close();
            $conn->close();
        } else {
            // Failed to upload the new image
            echo "Failed to upload the new image.";
        }
    } else {
        // No new image uploaded
        echo "No new image uploaded.";
    }
}
?>
