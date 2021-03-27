<div class="modal fade" id="Insert_Question_TypesPopup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">أضف نوع سؤال</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">النوع:</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name">
            <p class="font-red-sunglo">@{{ errors.name }}</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="Close_Insert_Question_Types" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Question_Types">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->