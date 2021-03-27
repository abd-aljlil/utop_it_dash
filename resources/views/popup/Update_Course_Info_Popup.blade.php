<div class="modal fade" id="Update_Course_Info_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">تعديل معلومات الكورس</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
        <label for="recipient-name" class="col-form-label">وصف الدورة</label>
        <input type="text" class="form-control" id="recipient-name" v-model="name">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.name }}</p>
      </div>
       <div class="form-group">
        <label for="recipient-name" class="col-form-label">فيديو الدورة</label>
        <input type="text" class="form-control" id="recipient-name" v-model="video_intro">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.video_intro }}</p>
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">تاريخ بداية الدورة</label>
        <input type="date" class="form-control" id="recipient-name" v-model="start_date">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.start_date }}</p>
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">تاريخ نهاية الدورة</label>
        <input type="date" class="form-control" id="recipient-name" v-model="end_date">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.end_date }}</p>
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">تاريخ الامتحان النصفي</label>
        <input type="date" class="form-control" id="recipient-name" v-model="mid_term_test_date">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.mid_term_test_date }}</p>
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">تاريخ الامتحان النهائي</label>
        <input type="date" class="form-control" id="recipient-name" v-model="final_test_date">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.final_test_date }}</p>
      </div>

    </div><!--.modal-body -->
    <div class="modal-footer">
      <button type="button" id="Close_Update_Course" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
      <button type="button" class="btn btn-warning" @click="Update_Course">حفظ</button>
    </div><!--.modal-footer -->
  </div><!--.modal-content -->
</div><!--.modal-dialog -->
</div><!--.modal -->