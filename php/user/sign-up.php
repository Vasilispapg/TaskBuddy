<?php

function emailExists($email) {
    include_once '../connection.php'; 


    $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    $conn->close();
    return $count > 0;
}

function phoneExists($phone) {
    include_once '../connection.php'; 


    $sql = "SELECT COUNT(*) as count FROM users WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    $conn->close();
    return $count > 0;
}

function usernameExists($username) {
    include_once '../connection.php'; 


    $sql = "SELECT COUNT(*) as count FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    $conn->close();
    return $count > 0;
}

function uploadImage($username) {
    $uploadDirectory = '../../assets/user_images/'; // Change this to your desired directory
    if(!file_exists($uploadDirectory)){
        mkdir($uploadDirectory, 0777, true);
    }
    if(!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name'])){
        return null;
    }
    $uploadedFileName = $_FILES['image']['name'];

    // Generate a unique filename based on the username
    $username = strtolower($username); // Convert username to lowercase
    $username = preg_replace('/\s+/', '_', $username); // Replace spaces with underscores
    $uploadedFileName = $username . '_' . $uploadedFileName;

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


function registerUser() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $bdate = $_POST["birthday_day"] . '/' . $_POST["birthday_month"] . '/' . $_POST["birthday_year"];
        $phone = $_POST["phone"];
        $location = $_POST["location"];

        if (emailExists($email)) {
            echo "Email already exists. Please choose a different email address.";
            return;
        }
        if (phoneExists($phone)) {
            echo "Phone number already exists. Please choose a different phone number.";
            return;
        }
        if (usernameExists($username)) {
            echo "Username already exists. Please choose a different username.";
            return;
        }


        // Check if 'image' was uploaded
        $imagePath = uploadImage($username);

        if ($imagePath === null) {
            $imagePath='../../assets/user_images/default.png'; // Set the default image path here
        }

        include_once '../connection.php'; 



        $role = isset($_POST['checkbox']) && $_POST['checkbox'] == 'buddy' ? 'taskbuddy' : 'user';
        $created_at = date("Y-m-d H:i:s");

        // Define your SQL query here
        $sql = "INSERT INTO users (username, email, password_hash, bdate, role, created_at, fullname, image_path , phone,location)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssssssss", $username, $email, $hashedPassword, $bdate, $role, $created_at, $fullname, $imagePath, $phone,$location);

        if ($stmt->execute()) {
            $id = $stmt->insert_id; // Get the user's ID
            include_once "../confirmation/sendEmail.php";
            $_SESSION['justRegistered'] = true; // Set the flag before redirecting
            include "usrlogin.php"; // Redirect to login page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    registerUser(); // Call the registration function
}
?>