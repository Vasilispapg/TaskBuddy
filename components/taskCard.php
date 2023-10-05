<div class="container">
        <div class="row pt-4 m-auto">
            <div class="col-md-6 col-lg-10 pb-3">

              <!-- Add a style="height: XYZpx" to div.card to limit the card height and display scrollbar instead -->
              <div class="card card-custom bg-white border-white border-0" style="height: 450px">
                <div class="card-custom-img" style="background-image: url(<?php if($row['image_url']) echo ltrim($row['image_url'], './'); else echo 'assets/user_images/user_icon_df.png"';?>);"></div>
                <div class="card-custom-avatar">
                  <img src="<?php if($row['image_url']) echo ltrim($row['image_url'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
                </div>
                <div class="card-body" style="overflow-y: auto">
                  <h5 class="card-subtitle text-muted"><?php if($row['user']) echo $row['user']; else echo "No Username"?></h5>
                  <h4 class="card-title"><?php if($row['title']) echo $row['title'];?></h4>
                  <h6 class="card-subtitle text-muted">Κατηγορία: <?php if($row['category']) echo $row['category']; else echo "No Category"?></h6>
                  <?php
                    if ($row['description']) {
                        $lines = explode("\n", $row['description']); // Split the description into lines
                        foreach ($lines as $line) {
                            echo '<p class="card-text">';
                            echo $line;
                            echo '</p>';
                        }
                    } else {
                        echo '<p class="card-text">No Description</p>';
                    }
                  ?>


                </div>
                <div class="card-footer" style="background: inherit; border-color: inherit;">
                  <a href="<?php echo '../taskbuddynw/dashboard.php?receiverID='.$row['user_id'].'&postID='.$row['id']?>" class="btn btn-primary">Message</a>
                  <a href="<?php echo $row['id']?>" class="btn btn-outline-primary">Read More</a>
                </div>
              </div>
            </div>
        </div>
    </div>

