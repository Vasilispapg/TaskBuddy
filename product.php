<div id="myModal" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
        <!-- Close button -->
        <span class="close">&times;</span>
        <div class="productModal">
            <?php 
                include_once './php/connection.php'; 


                if ($conn2->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sqlUser = "SELECT * FROM users WHERE id = {$row['user_id']}";
                $resultUser = $conn->query($sqlUser);
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
