 
<div class="modal fade" id="Update_Exam_Name_Index_Questionspopup">
  <div class="modal-dialog" role="document">
    

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinLabel">تعديل سؤال امتحاني</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="caption-subject font-yellow-crusta bold uppercase">نوع السؤال</h4>
        <div class="row ">
            
            <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <v-select style="background-color: #FFF" :options="Question_Types" ref="select" v-model="Question_Types_Id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.question_type_id }}</p>
                </div>
            </div>
            <div class="col-md-10">
              <div class="form-group" v-if="Question_Types_Id['label']=='فيديو'">
                 <label for="recipient-name" class="col-form-label">رابط الفيديو</label>
                 <input type="text" class="form-control" id="recipient-name" v-model="link">
                 <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.link }}</p>
              </div>
            </div>
            <div class="col-md-10">
              <div class="form-group" v-if="Question_Types_Id['label']=='صورة'">
                 <label for="recipient-name" class="col-form-label">ارفع الصورة هنا</label>
                <input type="file" class="form-control" id="recipient-name" ref="file" v-on:change="handleFileUpload">
                 <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.file }}</p>
              </div>
            </div>

        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">نص السؤال:</label>
          <input type="text" class="form-control" id="recipient-name" v-model="text">
          <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.text }}</p>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">ترتيب السؤال</label>
            <input type="number" class="form-control" id="recipient-name" v-model="question_order">
            <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.question_order }}</p>
          </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">درجة السؤال من إجمالي الامتحان</label>
          <input type="number" class="form-control" id="recipient-name" v-model="question_percent">
          <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.question_percent }}</p>
        </div>

        <h4 class="caption-subject font-yellow-crusta bold uppercase">خيارات الاجابة</h4>
        <div class="row ">
            <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">نوع الإجابة</label>
                        <v-select style="background-color: #FFF" :options="Answer_Types" ref="select" v-model="Answer_Type">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.answer_type }}</p>
                </div>
            </div>
        </div>

        <!--Text answer -> one correct answer : zero choices -->
         <div class="row" v-if="Answer_Type=='نص'">
          <div class="col-md-10">
            <div class="form-group">
                 <label for="recipient-name" class="col-form-label">الإجابة الصحيحة</label>
                 <input type="text" class="form-control" id="recipient-name" v-model="Correct_Answer">
                 <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors }}</p>
              </div>
          </div>
        </div>
        <!--True False answer -> one correct answer : zero choices -->
         <div class="row" v-if="Answer_Type=='صح أم خطأ'">
          <div class="col-md-10">
            <div class="form-group">
                    <input type="radio" value="True" v-model="Correct_Answer">
                    <label for="True">True</label>
                    
                    <input type="radio" value="False" v-model="Correct_Answer">
                    <label for="False">False</label>

                    <input type="radio" value="Not given" v-model="Correct_Answer">
                    <label for="Not given">Not Given</label>
                    <br>
                    <p class="list-group-item">Picked Correct Answer: @{{ Correct_Answer }}</p>
                 <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.correct_answer1 }}</p>
              </div>
          </div>
        </div>
        
        <!--MCQ -> Multiple correct answer : 4 choices -->
        <div class="row" v-if="Answer_Type=='اختيار متعدد من متعدد'">
            <div class="col-md-2">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-add btn-md float-righ"  data-toggle="modal" @click="Create_Answer"> 
                        أضف
                    </a>
                </div>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" class="form-control" id="recipient-name" v-model="answer">
                </div>
            </div>
        </div>

     <div class="row " v-if="Answer_Type=='اختيار متعدد من متعدد'">
            

            <div class="col-md-2 ">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-danger " data-toggle="modal" @click = "Remove_Answer"> 
                        حذف
                    </a>
                </div>
                </div>
            </div>

            <div class="col-md-2 ">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-add btn-md "  data-toggle="modal" @click = "Set_Correct_Answer"> 
                        تعيين صحيح
                    </a>
                </div>
                </div>
            </div>

           <div class="col-md-1">
                
            </div>
            
            <div class="col-md-7 ">
                <div class="form-group ">
                    <div class="input-icon ">
                        <v-select style="background-color: #FFF" :options="Answers_Array" ref="select" v-model="Answers">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ entry }}</p>
                </div>
                <br>

            </div>
            
        </div>
        
        <h4 class="caption-subject font-yellow-crusta bold uppercase" v-if="Answer_Type=='اختيار متعدد من متعدد'"> الأجوبة الصحيحة</h4>
                <br>
        <div class="row" v-if="Answer_Type=='اختيار متعدد من متعدد'">

            <div class="col-md-2 ">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-danger " data-toggle="modal" @click = "Remove_Correct_Answer"> 
                        حذف
                    </a>
                </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon ">
                        
                        <v-select style="background-color: #FFF" :options="Correct_Answers" ref="select" v-model="Correct_Answer">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ entry }}</p>
                </div>
            </div>

            
            
        </div>
        <!--MCQ -> Multiple correct answer : 4 choices -->
        <div class="row" v-if="Answer_Type=='اختيار واحد من متعدد'">
            <div class="col-md-2">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-add btn-md float-righ"  data-toggle="modal" @click="Create_Answer"> 
                        أضف
                    </a>
                </div>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="form-group ">
                    <input type="text" class="form-control" id="recipient-name" v-model="answer">
                </div>
            </div>
        </div>

     <div class="row " v-if="Answer_Type=='اختيار واحد من متعدد'">
            

            <div class="col-md-2 ">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-danger " data-toggle="modal" @click = "Remove_Answer"> 
                        حذف
                    </a>
                </div>
                </div>
            </div>

            <div class="col-md-2 ">
                <div class="form-group ">
                    <div class="btn-group">
                    <a  class="btn btn-add btn-md "  data-toggle="modal" @click = "Set_Correct_Answer"> 
                        تعيين صحيح
                    </a>
                </div>
                </div>
            </div>

           <div class="col-md-1">
                
            </div>
            
            <div class="col-md-7 ">
                <div class="form-group ">
                    <div class="input-icon ">
                        <v-select style="background-color: #FFF" :options="Answers_Array" ref="select" v-model="Answers">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="list-group-item">Picked Correct Answer: @{{ Correct_Answer }}</p>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ entry }}</p>
                </div>
                <br>

            </div>
            
        </div>

      <hr>

      <!--<h5 class="modal-title" id="popupWinLabel" >نوع السؤال @{{ Question_Types_Id.label }}</h5>

      <ul class="list-group">
        <li class="list-group-item active" v-if="text">@{{ text }}</li>
        <li class="list-group-item" v-for="item in Answers_Array">@{{ item.label }}</li>
        <li class="list-group-item active" v-if="Correct_Answer">الجواب الصحيح هو : @{{ Correct_Answer }}</li>
        <li class="list-group-item active" v-if="item in Correct_Answers">جواب صحيح : @{{ item.label }}</li>
      </ul>-->
    
      </div>
      <div class="modal-footer">
        <button type="button" id="Close_Update_Exam_Index_Questions" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="updateQuestionDetails">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->