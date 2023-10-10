
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div id="myModalEdit" class="modal custom-modal">
<a href="#myModalFalse" class="trigger-btn" data-toggle="modal"  id='modalToggleFalse'></a>

  <div class="modal-dialog modal-edit">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-box">
          <i class="material-icons">&#xE254;</i>
        </div>
        <h4 class="modal-title w-100">Επεξεργασία</h4>
      </div>
      <div class="modal-body">
        

        <!-- Add your edit form here -->
        <form action="php/updatePost.php" method="POST">
          <!-- Your edit form fields go here -->
          <div class="form-group">
            <input  hidden id="post_id" name="post_id" required>

            <label for="edit_title">Title:</label>
            <input type="text" id="edit_title" name="edit_title" required>
            
            <label for="edit_desc">Description:</label>
            <textarea id="edit_desc" name="edit_desc" required></textarea>
            
            <label for="edit_price">Price:</label>
            <input type="number" id="edit_price" name="edit_price" required>
            
            <label for="edit_category">Category:</label>
            <input type="text" id="edit_category" name="edit_category" required>
            
            <label for="edit_expireDate">Expire Date:</label>
            <input type="text" id="edit_expireDate" name="edit_expireDate" required>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-block" type='submit' data-dismiss="modal">Αποθήκευση</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
