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
                  <h5 class="card-subtitle text-muted" id='username'><?php if($row['user']) echo $row['user']; else echo "No Username"?></h5>
                  <h3 class="card-title" id='title'><?php if($row['title']) echo $row['title'];?></h3>
                  <h6 class="card-subtitle text" id='location'>Περιοχή: <?php if($row['location']) echo $row['location']; else echo "No Location"?></h6>
                  <h6 class="card-subtitle text-muted" id='category'>Κατηγορία: <?php if($row['category']) echo $row['category']; else echo "No Category"?></h6>
                  <h4 class="card-subtitle text-muted" id='price'>Ποσό: <?php if($row['price']) echo $row['price'].'€'; else echo "No Price"?></h4>

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
                  <a id='messageBtn' href="<?php echo '../taskbuddynw/dashboard.php?receiverID='.$row['user_id'].'&postID='.$row['id']?>" class="btn btn-primary">Message</a>
                  <button id='readMoreBtn' class="btn btn-outline-primary">Read More</button>
                </div>
              </div>
            </div>
        </div>
    </div>

