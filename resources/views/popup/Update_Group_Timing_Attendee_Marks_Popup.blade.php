<div class="modal fade" id="Update_Group_Timing_Marks_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="popupWinUpdateLabel">Edit Student Marks</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Student Name:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="user_name" disabled>
            <span  class="label label-warning"></span>
          </div>   
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status:</label>
            <input type="radio" id="0" value="0" v-model="status">
            <label for="recipient-name" class="col-form-label">absent</label>
            <input type="radio" id="1" value="1" v-model="status">
            <label for="recipient-name" class="col-form-label">present</label>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Fluency:</label>
            <input onkeyup="if(this.value > 10) this.value = 0;" v-if="group_level_label==2 || group_level_label==1" type="number" class="form-control" id="recipient-name" v-model="fluency" max="10" step="0.5" min="0.0">
            <input onkeyup="if(this.value > 8) this.value = 0;" v-else type="number" class="form-control" id="recipient-name" v-model="fluency" max="8" step="0.5" min="0.0">
            <span  class="label label-warning">@{{ errors.fluency }}</span>
            <span  class="label label-warning" style="color:red" v-if="fluency>10 && (group_level_label==2 || group_level_label==1)">Error: it shouldn't be more than 10</span>
            <span  class="label label-warning" style="color:red" v-if="fluency>8 && (group_level_label==3 || group_level_label==4 || group_level_label==5|| group_level_label==6)">Error: it shouldn't be more than 8</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Grammar:</label>
            <input onkeyup="if(this.value > 10) this.value = 0;" v-if="group_level_label==2 || group_level_label==1" type="number"  class="form-control" id="recipient-name" v-model="grammar" max="10" step="0.5" min="0.0">
            <input onkeyup="if(this.value > 8) this.value = 0;" v-else type="number"  class="form-control" id="recipient-name" v-model="grammar" max="8" step="0.5" min="0.0">
            <span  class="label label-warning">@{{ errors.grammar }}</span>
            <span  class="label label-warning" style="color:red" v-if="grammar>10 && (group_level_label==2 || group_level_label==1)">Error: it shouldn't be more than 10</span>
            <span  class="label label-warning" style="color:red" v-if="grammar>8 && (group_level_label==3 || group_level_label==4 || group_level_label==5|| group_level_label==6)">Error: it shouldn't be more than 8</span>  
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Pronunciation:</label>
            <input  onkeyup="if(this.value > 10) this.value = 0;" v-if="group_level_label==2 || group_level_label==1" type="number" class="form-control" id="recipient-name" v-model="pronunciation" max="10" step="0.5" min="0.0">
            <input onkeyup="if(this.value > 8) this.value = 0;" v-else type="number" class="form-control" id="recipient-name" v-model="pronunciation" max="8" step="0.5" min="0.0">
            <span  class="label label-warning">@{{ errors.pronunciation }}</span>
            <span  class="label label-warning" style="color:red" v-if="pronunciation>10 && (group_level_label==2 || group_level_label==1)">Error: it shouldn't be more than 10</span>
            <span  class="label label-warning" style="color:red" v-if="pronunciation>8 && (group_level_label==3 || group_level_label==4 || group_level_label==5|| group_level_label==6)">Error: it shouldn't be more than 8</span>
          </div>
          <div class="form-group" v-if="group_level_label==3 || group_level_label==4 || group_level_label==5 || group_level_label==6">
            <label for="recipient-name" class="col-form-label">Composition Skills:</label>
            <input onkeyup="if(this.value > 10) this.value = 0;"  v-if="group_level_label==2 || group_level_label==1" type="number" class="form-control" id="recipient-name" v-model="composition_skills" max="10" step="0.5" min="0.0">
            <input onkeyup="if(this.value > 8) this.value = 0;"v-else type="number" class="form-control" id="recipient-name" v-model="composition_skills" max="8" step="0.5" min="0.0">
            <span  class="label label-warning">@{{ errors.composition_skills }}</span>
            <span  class="label label-warning" style="color:red" v-if="composition_skills>10 && (group_level_label==2 || group_level_label==1)">Error: it shouldn't be more than 10</span>
            <span  class="label label-warning" style="color:red" v-if="composition_skills>8 && (group_level_label==3 || group_level_label==4 || group_level_label==5|| group_level_label==6)">Error: it shouldn't be more than 8</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Over All Achievement:</label>
            <input onkeyup="if(this.value > 10) this.value = 0;" v-if="group_level_label==2 || group_level_label==1" type="number" class="form-control" id="recipient-name" v-model="over_all_achievement" max="10" step="0.5" min="0.0">
            <input onkeyup="if(this.value > 8) this.value = 0;" v-else type="number" class="form-control" id="recipient-name" v-model="over_all_achievement" max="8" step="0.5" min="0.0">
            <span  class="label label-warning">@{{ errors.over_all_achievement }}</span>
            <span  class="label label-warning" style="color:red" v-if="over_all_achievement>10 && (group_level_label==2 || group_level_label==1)">Error: it shouldn't be more than 10</span>
            <span  class="label label-warning" style="color:red" v-if="over_all_achievement>8 && (group_level_label==3 || group_level_label==4 || group_level_label==5|| group_level_label==6)">Error: it shouldn't be more than 8</span>
          </div>
      
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeupdateAttendee" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-warning" @click="updateStudentStatus">Save</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->
