<div class="modal fade" id="Update_Group_User_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">تعيين  مسؤول عن المجموعة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">اسم المجموعة</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name" disabled>
            <span  class="label label-warning">@{{ errors.name }}</span>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">المستوى</label>
            <input type="text" class="form-control" id="recipient-name" v-model="level" disabled>
            <span  class="label label-warning">@{{ errors.user_level }}</span>
          </div>
          <div class="row ">
          <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">الأستاذ المساعد</label>
                        <v-select style="background-color: #FFF" :options="Teachers" ref="select" v-model="user_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.user_id }}</p>
                </div>
            </div>
        </div>
        
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeUpdate" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="updateUser">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->