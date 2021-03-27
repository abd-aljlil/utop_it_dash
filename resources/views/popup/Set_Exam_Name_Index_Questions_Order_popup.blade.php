 
<div class="modal fade" id="Set_Exam_Name_Index_Questions_order_popup">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">تعيين ترتيب الاسئلة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group" v-for="(question , index) in Questions">
          <div class="slidecontainer">
              <p> %@{{ question.text }} - @{{ question.question_order }}  </p>
              <input type="range" min="1"  max="100"   v-model="temporary_question_percent[index]"  class="slider" id="myRange" @change="Setpeorder(index)" >
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="Close_updateQuestionOrder" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="updateQuestionOrder">حفظ</button>
      </div><!--.modal-footer -->


    </div><!--.modal-content -->


  </div><!--.modal-dialog -->
</div><!--.modal -->