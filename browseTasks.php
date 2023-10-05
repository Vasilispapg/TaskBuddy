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
    <title>Dashboard</title>
    <link rel="stylesheet" href="web_stuff/css/browseTasks.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<style>
  
  .container {
    font-size: 14px;
    color: #666666;
    font-family: "Open Sans";
  }
</style>
<body>

<?php include 'components/header.php';?>
<div class="taskCard">
    
            <?php
                // Assuming you have a database connection established
                $con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
                if (mysqli_connect_errno() || !$con) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                } 
                else {
                    $query = 'SELECT posts.*,
                                post_images.image_url,
                                users.username AS user,
                                users.id AS user_id
                                FROM users,posts,post_images 
                                WHERE posts.status!="disabled" 
                                AND post_images.post_id=posts.id 
                                AND users.id=posts.user_id 
                                ORDER BY posts.id DESC';

                    $result = mysqli_query($con, $query);
                    if (!$result) {
                        echo "Could not successfully run query ($query) from DB: " . mysqli_error($con);
                        exit;
                    }
                    else{
                        // Check if there are any products in the database
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                include 'components/taskCard.php';
                            }
                        }
                    }
                }
            ?>

</div>

<?php include 'components/footer.php';?>
    
</body>
</html>