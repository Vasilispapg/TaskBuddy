<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_SESSION["fullname"])) {
    // Look up the user by the identifier stored in the session
    $user_id = $_COOKIE["user"];
}
else{
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskify</title>
    <link rel="stylesheet" href="web_stuff/css/profile.css">
</head>
<body style='margin:0'>

    <?php 
    include_once('./php/confirmation/getToken.php');
    include_once('./components/header.php');?>

<?php 
    if($conf){
    echo "<div style=\"height: 85vh; text-align: center; padding: 20px;\">
                <h1>Email Confirmed</h1>
                <p>Your email has been successfully confirmed. You can now use our services.</p>
            </div>";
    }
    else{
        echo "<div style=\"height: 85vh; text-align: center; padding: 20px;\">
                <h1>Something went wrong</h1>
                <p>Your email has not been confirmed.</p>
            </div>";
        
    }
    exit();
?>


<?php include_once('./components/footer.php')?>
</body>
</html>