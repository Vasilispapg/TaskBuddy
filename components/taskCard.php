

<div class="container">
        <div class="row pt-4 m-auto">
            <div class="col-md-6 col-lg-10 pb-3">

              <!-- Add a style="height: XYZpx" to div.card to limit the card height and display scrollbar instead -->
              <div class="card card-custom bg-white border-white border-0" style="height: 500px">
                <div class="card-custom-img" style="background-image: url(<?php if($row['image_url']) echo ltrim($row['image_url'], './'); else echo 'assets/user_images/user_icon_df.png"';?>);"></div>
                <div class="card-custom-avatar">
                  <img src="<?php if($row['user_image']) echo ltrim($row['user_image'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
                </div>
                <div class="card-body" style="overflow-y: auto">
                  <h5 class="card-subtitle text-dark" id='username'><?php if($row['user']) echo $row['user']; else echo "No Username"?></h5>
                  <div class='location_category'>
                    <h6 class="card-subtitle text" id='location'><?php if($row['location']) echo $row['location']; else echo "No Location"?></h6>
                    •
                    <h6 class="card-subtitle text" id='category'><?php if($row['category']) echo $row['category']; else echo "No Category"?></h6>

                  </div>
                  <h4 class="card-title text-primary" id='title'><?php if($row['title']) echo $row['title'];?></h4>
                  <h6 class="card-subtitle text-muted" id='created_at' value='<?php echo $row['created_at']?>'><?php if($row['created_at']) echo timeAgo($row['created_at']);?></h6>

                  <h6 class="card-subtitle text-dark status-circle <?php echo $row['status'];?>" value='<?php echo $row['status'];?>' id='status'></h6>
                
                  <?php
                    if ($row['description']) {
                        $lines = explode("\n", $row['description']); // Split the description into lines
                        foreach ($lines as $line) {
                            echo '<p class="description card-text text-dark">';
                            echo $line;
                            echo '</p>';
                        }
                    } else {
                        echo '<p class="card-text">No Description</p>';
                    }
                  ?>

                </div>
                <div class="card-footer" >
                    <div>
                      <?php if($_SESSION['id']!=$row['user_id'])
                        echo "<a id='messageBtn' href='../taskbuddynw/dashboard.php?message=true&receiverID=".$row['user_id']."&postID=".$row['id']."' class='btn btn-primary'>Message</a>";
                        ?>
                        <!-- <button id='readMoreBtn' class="btn btn-outline-primary">Read More</button>  ΦΤΙΑΞΕ ΤΟ ΚΑΙ ΞΑΝΑ ΑΝΟΙΞΕ ΤΟ-->
                    </div>
                  <h4 class="card-subtitle text-primary" id='price'><?php if($row['price']) echo $row['price'].'€'; else echo "No Price"?></h4>
                </div>
              </div>
            </div>
        </div>
    </div>

