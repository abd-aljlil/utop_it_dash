 
<div class="modal fade" id="Insert_Exam_Name_Index_Users_Popup">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">تخصيص طلاب لامتحان @{{ exam_name_label }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="caption-subject font-yellow-crusta bold uppercase">المستوى</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" multiple :options="Levels" ref="select" v-model="Level_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id"></p>
                </div>
            </div>
        </div>

        <h4 class="caption-subject font-yellow-crusta bold uppercase">المجموعة</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" multiple :options="Groups" ref="select" v-model="Group_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id"></p>
                </div>
            </div>
        </div>

        <h4 class="caption-subject font-yellow-crusta bold uppercase">الطلاب</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" multiple :options="Users" ref="select" v-model="User_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id"></p>
                </div>
            </div>
        </div>

       <div class="modal-footer">
        <button type="button" id="Close_Insert_Exam_Name_Index_Users" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Exam_Name_Index_Users">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->
</div>