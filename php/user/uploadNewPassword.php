<?php
session_name('user');
session_start();

include_once '../connection.php'; 



$password = $_POST['password'];
$confpassword = $_POST['confirmpassowrd'];
$currentpassword = $_POST['currentpassword'];

$sql= "SELECT password_hash FROM users WHERE id = '{$_SESSION['id']}'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$hash = $row['password_hash'];

if (password_verify($currentpassword, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
    header('location:../../profile.php?changed=false');
    exit();
}

if($password == $confpassword) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

$sql = "UPDATE users SET password_hash='$hashedPassword' WHERE id='{$_SESSION['id']}'";

if (mysqli_query($conn, $sql)) {
    header('location:../../profile.php?changed=true'); // Pass a query parameter to indicate password change success
} else {
    header('location:../../profile.php?changed=false');
}

mysqli_close($conn);

?>
