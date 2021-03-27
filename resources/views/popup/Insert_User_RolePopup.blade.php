 
<div class="modal fade" id="Insert_User_RolePopup">
  <div class="modal-dialog" role="document">
   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">إضافة صلاحية</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="caption-subject font-yellow-crusta bold uppercase">اختيار المستخدم</h4>
        <div class="row ">
            
            <div class="col-md-12">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" :options="users_data" ref="select" v-model="user_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" >@{{ errors.user_id }}</p>
                </div>
            </div>

            <div class="col-md-12">
              <h4 class="caption-subject font-yellow-crusta bold uppercase">اختيار الصلاحية</h4>
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" :options="roles_data" ref="select" v-model="role_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" >@{{ errors.role_id }}</p>
                </div>
            </div>
        </div>

   

		
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_Insert_Role_User" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Role_User">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->