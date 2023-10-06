<div id="myModal" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
        <!-- Close button -->
        <span class="close">&times;</span>
        <div class="productModal">
            <?php 
                $mysqli2 = new mysqli("localhost", "root", "", "taskbuddynw");

                if ($mysqli2->connect_error) {
                    die("Connection failed: " . $mysqli2->connect_error);
                }
                $sqlUser = "SELECT * FROM users WHERE id = {$row['user_id']}";
                $resultUser = $mysqli2->query($sqlUser);
                if ($resultUser->num_rows > 0) {
                    while($rowUser = $resultUser->fetch_assoc()) {
                        @include('./components/product_modal.php');
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </div>
    </div>
</div>
