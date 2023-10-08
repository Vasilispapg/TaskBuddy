<div class="col-md-4 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center ">
                <div class="profile-content">
                    <div class="profile-pic">
                        <img src="<?php if(isset($rowUser['image_path'])) echo ltrim($rowUser['image_path'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
                    </div>
                </div>
                <div class="mt-3 modal_profile">
                    <h4><?php if(isset($rowUser['fullname'])) echo $rowUser['fullname'];?></h4>
                    <p class="text-secondary mb-1"><?php if(isset($rowUser['job'])) {echo $rowUser['job'];}?></p>
                    <p class="text-muted font-size-sm"><?php if(isset($rowUser['location'])) echo $rowUser['location'];?></p>
                    <p class="text-muted font-size-sm"><?php if(isset($rowUser['phone'])) echo $rowUser['phone'];?></p>
                    <p class="text-muted font-size-sm"><?php if(isset($rowUser['status'])) echo $rowUser['status'];?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    $mysqli3 = new mysqli("localhost", "root", "", "taskbuddynw");

    if ($mysqli3->connect_error) {
        die("Connection failed: " . $mysqli3->connect_error);
    }
    $queryImage = "SELECT image_url
    FROM post_images
    WHERE post_id = {$row['id']}";
    $resultImage = $mysqli3->query($queryImage);

    ?>
  
<div class='slider--container'>
    <?php 
        if ($resultImage->num_rows > 0) {
            while($rowImage = $resultImage->fetch_assoc()) {
                echo '<img style=width:250px src='.$rowImage['image_url'].'>';
    
            }
        } else {
            echo "0 results";
        }?>
</div>
