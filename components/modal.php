      <!-- Modal HTML -->
      <a href="#myModalTrue" class="trigger-btn" data-toggle="modal"  disabled id='modalToggleTrue'></a>
      <a href="#myModalFalse" class="trigger-btn" data-toggle="modal"  disabled id='modalToggleFalse'></a>
      <div id="myModalTrue" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box">
              <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="currentColor" class="bi bi-exclamation" viewBox="2.75 3 16 16">
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>
              </svg>
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