<div class="modal fade" id="updatepopup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel"> تعديل المادة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">اسم الحقل:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name">
            <span  class="label label-warning">@{{ errors.name }}</span>
          </div>
		  
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeupdate" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="update">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->