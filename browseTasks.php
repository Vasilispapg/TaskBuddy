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
<button id='newPost' class="btn btn-primary"><a href="newPost.php">New Post</a></button>

<div class="main">
            <?php
            include 'components/filters.php';
                // Assuming you have a database connection established
                include_once './php/connection.php'; 

                    function timeDiff($timestamp, $isBefore) {
                        $currentTimestamp = time();
                        $timestamp = strtotime($timestamp);
                        if($isBefore)
                            $timestampDiff = $currentTimestamp - $timestamp;
                        else
                            $timestampDiff = $timestamp - $currentTimestamp;
                    
                        if ($isBefore) {
                            $prefix = "Πριν ";
                        } else {
                            $prefix = "Λήγει σε ";
                        }
                    
                        if ($timestampDiff < 60) {
                            return $prefix . $timestampDiff . " δευτερόλεπτα";
                        } elseif ($timestampDiff < 3600) {
                            $minutes = ceil($timestampDiff / 60);
                            return $prefix . $minutes . " λεπτά";
                        } elseif ($timestampDiff < 86400) {
                            $hours = ceil($timestampDiff / 3600);
                            return $prefix . $hours . " ώρες";
                        } elseif ($timestampDiff < 604800) {
                            $days = ceil($timestampDiff / 86400);
                            return $prefix . $days . " μέρες";
                        } else {
                            $weeks = ceil($timestampDiff / 604800);
                            return $prefix . $weeks . " εβδ.";
                        }
                    }
                      
                    
                    $query = 'SELECT
                    posts.id,
                    posts.title,
                    posts.description,
                    posts.user_id,
                    posts.price,
                    posts.category,
                    posts.status,
                    posts.end_time,
                    posts.location,
                    posts.created_at,
                    MAX(post_images.image_url) AS image_url,
                    users.fullname AS user,
                    users.image_path AS user_image,
                    users.id AS user_id,
                    users.status AS user_status
                FROM
                    posts
                INNER JOIN
                    post_images ON post_images.post_id = posts.id
                INNER JOIN
                    users ON users.id = posts.user_id
                WHERE
                    posts.status != "disabled"
                AND
                    posts.end_time > NOW()
                GROUP BY
                    posts.id,
                    posts.title,
                    posts.description,
                    posts.user_id,
                    posts.price,
                    posts.category,
                    posts.status,
                    posts.end_time,
                    posts.location,
                    posts.created_at,
                    users.fullname,
                    users.image_path,
                    users.id
                ORDER BY
                    posts.id DESC;
                ';

                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "Could not successfully run query ($query) from DB: " . mysqli_error($conn);
                        exit;
                    }
                    else{
                        // Check if there are any products in the database
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="taskCard">';
                            while ($row = mysqli_fetch_assoc($result)) {
                                include 'components/taskCard.php';
                                include 'product.php';

                            }
                            echo '</div>';
                        }
                    }
                
            ?>
</div>

</div>


<?php include 'components/footer.php';?>
    
</body>
<script src='scripts/client/slider.js'></script>
<script src='scripts/client/taskFilter.js'></script>
<script src='scripts/notifications/sendNotification.js'></script>

<script>
  // Get the modal elements and buttons
  var modals = document.querySelectorAll(".modal");
  var buttons = document.querySelectorAll("#readMoreBtn");
  var closes = document.querySelectorAll(".close");

  // Open the corresponding modal when a button is clicked
  buttons.forEach(function (button, index) {
    button.addEventListener("click", function () {
      modals[index].style.display = "block";
    });
  });

  // Close the corresponding modal when its close button is clicked
  closes.forEach(function (close, index) {
    close.addEventListener("click", function () {
      modals[index].style.display = "none";
    });
  });

  // Close the modal when the user clicks outside of any modal
  window.addEventListener("click", function (event) {
    modals.forEach(function (modal) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });
  });

</script>




</html>