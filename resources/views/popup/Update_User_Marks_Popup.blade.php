<div class="modal fade" id="Update_User_Marks_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">Edit Interview Marks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Student Name:</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="text" class="form-control" id="recipient-name" v-model="user_name" disabled>
            <span  class="label label-warning"></span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Interview Fluency:</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="number" class="form-control" id="recipient-name" v-model="fluency" >
            <span  class="label label-warning">@{{ errors.interview_fluency }}</span>
            <span  class="label label-warning" style="color:red" v-if="fluency>5">Error: it shouldn't be more than 5</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Interview Grammar:</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="number" class="form-control" id="recipient-name" v-model="grammar" >
            <span  class="label label-warning">@{{ errors.interview_grammar }}</span>
            <span  class="label label-warning" style="color:red" v-if="grammar>5">Error: it shouldn't be more than 5</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Interview Pronunciation:</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="number" class="form-control" id="recipient-name" v-model="pronunciation" >
            <span  class="label label-warning">@{{ errors.interview_pronunciation }}</span>
            <span  class="label label-warning" style="color:red" v-if="pronunciation>5">Error: it shouldn't be more than 5</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Interview Vocabulary</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="number" class="form-control" id="recipient-name" v-model="vocabulary" >
            <span  class="label label-warning">@{{ errors.interview_vocabulary }}</span>
            <span  class="label label-warning" style="color:red" v-if="vocabulary>5">Error: it shouldn't be more than 5</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Interview Comprehension:</label>
            <input onkeyup="if(this.value > 5) this.value = 0;" max="5" step="0.5" min="0.0" type="number" class="form-control" id="recipient-name" v-model="comprehension" >
            <span  class="label label-warning">@{{ errors.interview_comprehension }}</span>
            <span  class="label label-warning" style="color:red" v-if="comprehension>5">Error: it shouldn't be more than 5</span>
          </div>
          
		  
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeupdateMarks" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-warning" @click="updateUserMarks">Save</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->