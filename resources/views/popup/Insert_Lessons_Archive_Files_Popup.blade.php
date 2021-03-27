<div class="modal fade right" id="Insert_Lessons_Archive_Files_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">إضافة ملف</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">الملف</label>
            <input type="file" class="form-control" id="recipient-name" ref="file" @change="handleFileUpload">
            <p class="font-red-sunglo">@{{ errors.file }}</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeInsert_Lessons_Archive_Files" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Lessons_Archive_Files">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->