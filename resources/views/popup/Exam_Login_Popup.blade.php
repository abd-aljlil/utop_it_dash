<div class="modal fade right " id="Exam_Login_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <h5  id="popupWinLabel" class="float-right"></h5>
    <div class="modal-content">
      <div class="modal-body float-right">
          <div class="form-group  ">
            <label for="recipient-name" class="float-left">Enter Exam Code:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="code" >
            <p class="text-danger">The code was sent to your email <br> @{{ errors.code }}</p> 
          </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-info" @click="Exam_Login">GO!</button>
        <button type="button" class="btn " ><a href="/utopians_dashboard" style="color:white">Cancel</a>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->