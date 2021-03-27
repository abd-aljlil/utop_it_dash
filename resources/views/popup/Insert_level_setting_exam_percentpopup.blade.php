 
<div class="modal fade" id="Insert_level_setting_exam_percentpopup">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">إضافة درجة الحد الأدنى للمستوى</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="caption-subject font-yellow-crusta bold uppercase">المستوى</h4>
        <div class="row ">
            
            <div class="col-md-12">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" :options="Levels" ref="select" v-model="Level_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" >@{{ errors.level }}</p>
                </div>
            </div>
            
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">درجة الحد الأدنى للمستوى</label>
          <input type="number" class="form-control" id="recipient-name" v-model="percent">
          <p class="font-red-sunglo">@{{ errors.percent }}</p>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" id="Close_Insert_level_setting_exam_percent" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_level_setting_exam_percent">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->