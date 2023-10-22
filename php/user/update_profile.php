<?php
session_name('user');
session_start();

include_once '../connection.php'; 


$phone = $_POST['phone'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$username = $_POST['uname'];
$location = $_POST['location'];
$job = $_POST['job'];
$about = $_POST['about'];

// Check if another user already has the same username, phone, or email
$checkSql = "SELECT id FROM users WHERE username = '$username' OR phone = '$phone' OR email = '$email'";

$result = mysqli_query($conn, $checkSql);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) > 0 and $row['id'] != $_SESSION['id']) {
    // A user with the same username, phone, or email already exists
    echo "Error: Another user with the same username, phone, or email already exists.";
    header('location:../../profile.php?changed=false');
} else {
    $sql = "UPDATE users SET email='$email', phone='$phone', job='$job', about='$about',
        fullname='$fullname', username='$username', location='$location' WHERE id='{$_SESSION['id']}'";

    if (mysqli_query($conn, $sql)) {
    
        echo "Record updated successfully";
        // Update session variables with the updated data
        $_SESSION["location"] = $location;
        $_SESSION["fullname"] = $fullname;
        $_SESSION["username"] = $username;
        $_SESSION["about"] = $about;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["job"] = $job;

        header('location:../../profile.php?changed=true');


    } else {
        echo "Error updating record: " . mysqli_error($conn);
        header('location:../../profile.php?changed=false');
    }
}

mysqli_close($conn);

?>
