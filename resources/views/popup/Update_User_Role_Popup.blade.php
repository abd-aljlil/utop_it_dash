<div class="modal fade" id="Update_User_Role_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">تعديل صلاحية اليوزر</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name" disabled>
            <span  class="label label-warning"></span>
          </div>
          <div class="row ">
          <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">Role:</label>
                        <v-select style="background-color: #FFF" :options="Roles" ref="select" v-model="User_Role">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.Role }}</p>
                </div>
            </div>
        </div>
          
      
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeupdateRole" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="updateUserRole">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->