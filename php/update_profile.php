<?php
session_name('user');
session_start();

$con = mysqli_connect('localhost', 'root', '') or die("Connection failed: " . mysqli_connect_error());
mysqli_select_db($con, "taskbuddynw");

$phone = $_POST['phone'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$password = $_POST['password'];
$username = $_POST['uname'];
$location = $_POST['location'];
$job = $_POST['job'];
$about = $_POST['about'];

// Check if another user already has the same username, phone, or email
$checkSql = "SELECT id FROM users WHERE username = '$username' OR phone = '$phone' OR email = '$email'";

$result = mysqli_query($con, $checkSql);

if (mysqli_num_rows($result) > 0) {
    // A user with the same username, phone, or email already exists
    echo "Error: Another user with the same username, phone, or email already exists.";
} else {
    // No duplicate found, proceed with the update
    if (empty($password)) {
        $sql = "UPDATE users SET email='$email', phone='$phone', address='$address',
         fullname='$fullname', username='$username', location='$location' WHERE id='{$_SESSION['id']}'";
    } else {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        $sql = "UPDATE users SET password_hash='$hashedPassword', email='$email', phone='$phone',
        address='$address', fullname='$fullname', username='$username', location='$location' WHERE id='{$_SESSION['id']}'";
    }

    if (mysqli_query($con, $sql)) {
        echo "Record updated successfully";
        // Update session variables with the updated data
        $_SESSION["location"] = $location;
        $_SESSION["fullname"] = $fullname;
        $_SESSION["username"] = $username;
        $_SESSION["about"] = $about;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["address"] = $address;
        $_SESSION["job"] = $job;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

mysqli_close($con);

header('location:../profile.php');
?>
