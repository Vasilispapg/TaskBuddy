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
<div class="main">
<div class="categoryCont">
<?php 
          $con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
          if (mysqli_connect_errno() || !$con) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
          } 
  ?>
      <div class="tags price">
          <h5>Price</h5>
          <?php include('./components/slider.php');?>
      </div>

      <div class="tags status">
          <h5>Status</h5>
            <a href="#" data-filter-type='status' data-filter-value='active' class="tag">Active</a>
            <a href="#" data-filter-type='status' data-filter-value='pending' class="tag">Pending</a>
            <!-- <a href="#" data-filter-type='status' data-filter-value='disabled' class="tag">Disabled</a> -->
      </div>
      <div class="tags">
        
          <h5>Job Type</h5>
          <?php 
            $query = 'SELECT DISTINCT posts.category,COUNT(posts.category) AS count
            FROM posts
            where posts.status!="disabled"
            GROUP BY category';

            $result = mysqli_query($con, $query);
            if (!$result) {
              echo "Could not successfully run query ($query) from DB: " . mysqli_error($con);
              exit;
            }

            while($row=mysqli_fetch_assoc($result)){
              $category = $row['category'];
              $count=$row['count'];
              echo "<a href='#' data-filter-type='category' data-filter-value='$category' class='tag'>$category ($count)</a>";
            }
          ?>
      </div>
        
</div>

            <?php
                // Assuming you have a database connection established
                $con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
                if (mysqli_connect_errno() || !$con) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                } 
                else {
                      function timeAgo($timestamp) {
                        $currentTimestamp = time();
                        $timestamp = strtotime($timestamp);
                        $timestampDiff = $currentTimestamp - $timestamp;

                        if ($timestampDiff < 60) {
                            return "Πριν " . $timestampDiff . " δευτερόλεπτα";
                        } elseif ($timestampDiff < 3600) {
                            $minutes = floor($timestampDiff / 60);
                            return "Πριν " . $minutes . " λεπτά";
                        } elseif ($timestampDiff < 86400) {
                            $hours = floor($timestampDiff / 3600);
                            return "Πριν " . $hours . " ώρες";
                        } elseif ($timestampDiff < 604800) {
                            $days = floor($timestampDiff / 86400);
                            return "Πριν " . $days . " μέρες";
                        } else {
                            $weeks = floor($timestampDiff / 604800);
                            return "Πριν " . $weeks . " εβδ.";
                        }
                      }
                    
                    $query = 'SELECT posts.*,
                                post_images.image_url,
                                users.fullname AS user,
                                users.image_path AS user_image,
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
                            echo '<div class="taskCard">';
                            while ($row = mysqli_fetch_assoc($result)) {
                                include 'components/taskCard.php';
                                include 'product.php';

                            }
                            echo '</div>';
                        }
                    }
                }
            ?>
</div>

</div>


<?php include 'components/footer.php';?>
    
</body>
<script src='scripts/slider.js'></script>
<script src='scripts/taskFilter.js'></script>
<script src='scripts/imageSlider.js'></script>


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