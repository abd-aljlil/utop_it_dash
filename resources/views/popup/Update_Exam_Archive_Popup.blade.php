 <div class="modal fade" id="Update_Exam_Index_Popup">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">تعديل موعد امتحاني</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="caption-subject font-yellow-crusta bold uppercase">اختيار الامتحان</h4>
        <div class="row ">
            <div class="col-md-2">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-add btn-md float-righ"  data-target="#Insert_Exam_NamePopup" data-toggle="modal" > 
                        أضف
                    </a>
                </div>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" :options="Exam_Name" ref="select" v-model="Exam_Name_Id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.exam_name_id }}</p>
                </div>
            </div>
        </div>

      <div class="form-group">
        <label for="recipient-name" class="col-form-label">التاريخ:</label>
        <input type="date" class="form-control" id="recipient-name" v-model="date">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.date }}</p>
      </div>

      <div class="form-group">
        <label for="recipient-name" class="col-form-label">المدة / دقيقة:</label>
        <input type="number" class="form-control" id="recipient-name" v-model="period">
        <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.period }}</p> 
      </div>

    
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_Update_Exam_Index" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="updateExamIndex">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->