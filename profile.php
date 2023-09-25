<?php
session_name('user');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="web_stuff/css/profile.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>
<body>
<header class="header">

<menu class="menu">
    <div class="logo"><a class="logo" href="index.php">TaskBuddy</a></div>
    <ul class="nav-list">
        <li><a href="#">Browse Tasks</a></li>
        <?php
        if (isset($_SESSION["username"])) {
            // User is logged in, display their username and a link to their profile or dashboard
            echo '<li><a href="profile.php">Welcome ' . $_SESSION["username"] . '</a></li>';
            echo '<li><a href="php/logout.php">Logout</a></li>';
        } else {
            // User is not logged in, display the "Sign Up / Login" link
            echo '<li><a href="login.php">Sign Up / Login</a></li>';
            echo '<li><a class="actionbutton" href="#">Become a Buddy</a></li>';
        }
        ?>
    </ul>
</menu>
</header>

<footer class="footer">
<div class="footer-content">
    <div class="footer-logo">TaskBuddy</div>
    <div class="footer-links">
        <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
        </ul>
    </div>
</div>
<div class="footer-social">
    <ul>
        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
    </ul>
</div>
</footer>
</body>
</html>