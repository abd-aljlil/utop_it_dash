
 <div class="modal fade" id="Insert_Announcement_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel"> تعديل الإعلان:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
        <label for="recipient-name" class="col-form-label">نص الإعلان</label>
        <input type="text" class="form-control" id="recipient-name" v-model="announcement">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.announcement }}</p>
      </div>

    </div><!--.modal-body -->
    <div class="modal-footer">
      <button type="button" id="closeInsert_Announcement" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
      <button type="button" class="btn btn-warning" @click="Insert_Announcement">حفظ</button>
    </div><!--.modal-footer -->
  </div><!--.modal-content -->
</div><!--.modal-dialog -->
</div><!--.modal -->