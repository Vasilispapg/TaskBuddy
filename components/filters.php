<div class="categoryCont">
<?php 
         include_once './php/connection.php'; 

  ?>
      <div class="tags price">
          <h5>Price</h5>
          <?php include('./components/priceSlider.php');?>
      </div>
      <div class="tags date">
          <h5>Ημερομηνια</h5>
            <a href="#" data-filter-type='date' data-filter-value='asc' class="tag radius">Αύξουσα</a>
            <a href="#" data-filter-type='date' data-filter-value='desc' class="tag radius active">Φθίνουσα</a>
      </div>
      <div class="tags price_b">
          <h5>Τιμή</h5>
            <a href="#" data-filter-type='price' data-filter-value='asc' class="tag radius">Αύξουσα</a>
            <a href="#" data-filter-type='price' data-filter-value='desc' class="tag radius">Φθίνουσα</a>
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
            $query = 'SELECT category, COUNT(*) AS count
            FROM posts
            WHERE status != "disabled"
            AND end_time > NOW()
            GROUP BY category';

            $result = mysqli_query($conn, $query);
            if (!$result) {
              echo "Could not successfully run query ($query) from DB: " . mysqli_error($conn);
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