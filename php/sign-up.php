<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "taskbuddynw";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function uploadImage($username) {
    $uploadDirectory = '../assets/user_images/'; // Change this to your desired directory
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
        $bdate = $_POST["birthday_year"] . '-' . $_POST["birthday_month"] . '-' . $_POST["birthday_day"];

        // Check if 'image' was uploaded
        $imagePath = uploadImage($username);

        if ($imagePath === null) {
            echo "Failed to upload the image.";
            return; // Exit registration if image upload fails
        }

        $conn = connectToDatabase();

        $role = isset($_POST['checkbox']) && $_POST['checkbox'] == 'buddy' ? 'taskbuddy' : 'user';
        $created_at = date("Y-m-d H:i:s");

        // Define your SQL query here
        $sql = "INSERT INTO users (username, email, password_hash, bdate, role, created_at, fullname, image_path)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssssss", $username, $email, $hashedPassword, $bdate, $role, $created_at, $fullname, $imagePath);

        if ($stmt->execute()) {
            echo "User registered successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        header("location:..\import_info.php");

    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    registerUser(); // Call the registration function
}
?>