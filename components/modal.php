      <!-- Modal HTML -->
      <a href="#myModalTrue" class="trigger-btn" data-toggle="modal"  disabled id='modalToggleTrue'></a>
      <a href="#myModalFalse" class="trigger-btn" data-toggle="modal"  disabled id='modalToggleFalse'></a>
      <div id="myModalTrue" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box">
                <i class="material-icons">&#xE876;</i>
              </div>				
              <h4 class="modal-title w-100">Τέλεια!</h4>	
            </div>
            <div class="modal-body">
              <p class="text-center">Τα στοιχεία σου άλλαξανε επιτυχώς.</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>     
      <div id="myModalFalse" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box" style='background-color:#f44336'>
                <i class="material-icons">close</i>
              </div>				
              <h4 class="modal-title w-100">Κρίμα!</h4>	
            </div>
            <div class="modal-body">
              <p class="text-center">Τα στοιχεία σου δεν αλλάξανε.</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success btn-block" data-dismiss="modal" style='background-color:#f44336'>OK</button>
            </div>
          </div>
        </div>
      </div>  