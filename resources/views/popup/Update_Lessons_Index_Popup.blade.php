<div class="modal fade right" id="Update_Lessons_Index_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">أضف درس</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">اسم الدرس:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name">
            <p class="font-red-sunglo">@{{ errors.name }}</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeUpdate_Lessons_Index" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Update_Lessons_Index">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->