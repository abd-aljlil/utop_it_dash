<div class="modal fade" id="Insert_Group_Timing_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">إضافة موعد  أسبوعي جديد</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row ">
          <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">يوم اللقاء</label>
                        <v-select style="background-color: #FFF" :options="Days" ref="select" v-model="day">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.day }}</p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">وقت اللقاء</label>
            <input type="time" class="form-control" id="recipient-name" v-model="time" >
            <span  class="label label-warning">@{{ errors.time }}</span>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">رابط المجموعة للتواصل</label>
            <input type="text" class="form-control" id="recipient-name" v-model="group_timing_link" >
            <span  class="label label-warning">@{{ errors.group_timing_link }}</span>
        </div>
		  
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeInsertTiming" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Group_Timing">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->