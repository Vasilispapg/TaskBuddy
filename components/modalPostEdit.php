

<div id="myModalEdit" class="modal custom-modal">
  <a href="#myModalFalse" class="trigger-btn" data-toggle="modal"  id='modalToggleFalse'></a>

  <div class="modal-dialog modal-edit">
    <div class="modal-content">
      <div class="modal-header">
      
        <h4 class="modal-title w-100">Επεξεργασία</h4>
        <div class="row mb-3 px-3">
            <button class="btn btn-danger btn-block exit" data-dismiss="modal">Έξοδος</button>
        </div>
      </div>
      <div class="modal-body">
        

        <!-- Add your edit form here -->
        <form action="php/updatePost.php" method="POST" enctype="multipart/form-data">
          <!-- Your edit form fields go here -->
          <div class="form-group">
            <input  hidden id="post_id" name="post_id" required>
              <label class="mb-1" for="edit_title"><h6 class="mb-0 text">Τίτλος</h6></label>
              <input class="mb-4" type="text" id='edit_title' name="edit_title" required placeholder="Enter a title">
            
              <label class="mb-1"><h6 class="mb-0 text">Περιγραφή</h6></label>
              <textarea class="mb-4" type="text" id="edit_desc" name="edit_desc" placeholder="Enter your Description"></textarea>
          
              <label class="mb-1"><h6 class="mb-0 text">Τιμή</h6></label>
              <input class="mb-4" type="price" id='edit_price' required name="edit_price" placeholder="Enter a Price">
          
              <label class="mb-1"><h6 class="mb-0 text">Κατηγορία</h6></label>
              <select id="edit_category" name="edit_category" class="custom-select"></select>

              <label class="mb-1 photo" for='image'><h6 class="mb-0 text">Άλλαξε την φωτογραφία</h6></label>
              <input type="file" class="form-control-file" id="image" name="image">
            
          </div>
          <div class="row mb-3 px-3">
            <button class="btn btn-success btn-block" type='submit' data-dismiss="modal">Αποθήκευση</button>
        </div>

        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  document.querySelector('.exit').addEventListener('click',function(){
    document.querySelector('#myModalEdit').style.display='none';
  })
</script>
<script src='scripts/addExpireAndCategoryField.js'></script>
<script src='scripts/getPostDetails.js'></script>
