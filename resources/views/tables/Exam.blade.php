 @extends('layouts.app')
 @section('style')
 <link href="{{ asset('css/dashboard/CP.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('css/dashboard/Exam.css') }}" rel="stylesheet" type="text/css" />

 @endsection
 @section('content')
 <style type="text/css">
 .center_div{
  margin: auto;
  width: 90%;
  
  padding: 20px;
}
img{
  width: 100%;
  max-width: 700px;
  height: auto;
}
#grid { font-size: 18px; }
.freeze{
  margin-right:0;
  position: fixed;
  width: 100%;
  z-index:-1;
}
.mr-auto, .mx-auto {
  margin-right: 10px!important;
}
</style>
<div id="grid" class="container-fluid">
 @include('popup.Exam_Login_Popup')
 
 <div class="row">
  <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='Login'">
    <button type="button" id="Exam_Login" class="btn btn-add btn-md float-left" data-toggle="modal" data-target="#Exam_Login_Popup" data-whatever=" @mdo" data-backdrop="static" data-keyboard="false"> دخول الامتحان </button>
  </div>
</div>
<!--
<h2 style="float: left;color:#014260" v-if="table_buttons=='exam'">Placement Test</h2>
-->
<!--
<h2 style="float: left;color:#014260" v-if="table_buttons=='exam'">Midterm Exam
</h2>
-->
<h2 style="float: left;color:#014260" v-if="table_buttons=='exam'">Final Exam
</h2>

<div class="row freeze " v-if="table_buttons=='exam'">
  <div class="col-10 mb-2 mr-auto ml-auto" >
    <button  class="btn btn-outline-danger half-rounded" type="button" :class="remainingClass" >@{{rhours}} mins @{{rminutes}} secs</button>
    
  </div>
</div>



<br>
<br>
<!--<form  @on-complete="Insert_Exam_Name_Index_Questions_Users"  @on-change="Update_Exam_Name_Index_Questions_Users" >-->

  <div class="center_div">

   <div title="Personal details" v-for="( entry , index ) in Questions">
    <div class="form-group  " style="white-space: pre-line;">
      <div v-if="entry.question_types.name=='صورة'">
        <img :src="'/utopians_dashboard/uploads/exam_questions_files/' + entry.file"  class="img-rounded" height="300" width="300"><br>
        <a v-bind:href="'/utopians_dashboard/uploads/exam_questions_files/' + entry.file" target="_blank">Open the picture in another tap</a>
        <h3 for="recipient-name"> @{{ entry.text }}</h3>
      </div>

      <div v-if="entry.question_types.name=='فيديو'">
        <iframe height="200" width="auto" :src="entry.link" style="z-index: 1" frameborder="0" id="myVideo" @focusout="myFunction()" allow="encrypted-media" allowfullscreen=""></iframe>
        <h3 for="recipient-name" style="white-space: pre-line;"> @{{ entry.text }}</h3>

      </div>

      <div v-if="entry.question_types.name=='نص'">
        <h3 for="recipient-name" > @{{ entry.text }}</h3>
      </div>

      <div v-if="entry.answer_type=='اختيار واحد من متعدد'">
        <div class="radio" v-if="entry.answer1!='محجوز يرجى حذفه'">
          <label><input type="radio" v-bind:name="entry.text" v-bind:value="entry.answer1" v-model="answers[entry.id]" > @{{ entry.answer1 }}</label>
        </div>

        <div class="radio" v-if="entry.answer2!='محجوز يرجى حذفه'">
          <label><input type="radio" v-bind:name="entry.text" v-bind:value="entry.answer2" v-model="answers[entry.id]"> @{{ entry.answer2 }}</label>
        </div>

        <div class="radio" v-if="entry.answer3!='محجوز يرجى حذفه'">
          <label><input type="radio" v-bind:name="entry.text" v-bind:value="entry.answer3" v-model="answers[entry.id]"> @{{ entry.answer3 }}</label>
        </div>

        <div class="radio" v-if="entry.answer4!='محجوز يرجى حذفه'">
          <label><input type="radio" v-bind:name="entry.text" v-bind:value="entry.answer4" v-model="answers[entry.id]"> @{{ entry.answer4 }}</label>
        </div>
        <br>
      </div>

      <div v-if="entry.answer_type =='صح أم خطأ'">
        <div class="radio" v-if="entry.answer1">
          <label><input type="radio" v-bind:name="entry.text" value="True" v-model="answers[entry.id]"  @click="writeC"> True</label>
        </div>

        <div class="radio" v-if="entry.answer2">
          <label><input type="radio" v-bind:name="entry.text" value="False" v-model="answers[entry.id]"> False</label>
        </div>

        <div class="radio" v-if="entry.answer3">
          <label><input type="radio" v-bind:name="entry.text" v-bind:value="entry.answer3" v-model="answers[entry.id]"> @{{ entry.answer3 }}</label>
        </div>
        <br>
      </div>

      <div v-if="entry.answer_type=='اختيار متعدد من متعدد'">

        <div class="radio" v-if="entry.answer1!='محجوز يرجى حذفه'">
          <label><input type="checkbox" v-bind:name="entry.text" v-bind:value="entry.answer1" v-model="prepared_answers[entry.id][1]"  @click="push(entry.id,1,entry.answer1)"> @{{ entry.answer1 }}</label>
        </div>

        <div class="radio" v-if="entry.answer2!='محجوز يرجى حذفه'">
          <label><input type="checkbox" v-bind:name="entry.text" v-bind:value="entry.answer2" v-model="prepared_answers[entry.id][2]"  @click="push(entry.id,2,entry.answer2)"> @{{ entry.answer2 }}</label>
        </div>

        <div class="radio" v-if="entry.answer3!='محجوز يرجى حذفه'">
          <label><input type="checkbox" v-bind:name="entry.text" v-bind:value="entry.answer3" v-model="prepared_answers[entry.id][3]"  @click="push(entry.id,3,entry.answer3)"> @{{ entry.answer3 }}</label>
        </div>

        <div class="radio" v-if="entry.answer4!='محجوز يرجى حذفه'">
          <label><input type="checkbox" v-bind:name="entry.text" v-bind:value="entry.answer4" v-model="prepared_answers[entry.id][4]"  @click="push(entry.id,4,entry.answer4)"> @{{ entry.answer4 }}</label>
        </div>
        <br>

      </div>

      <div v-if="entry.answer_type=='نص'">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="answers[entry.id]"></textarea>
        <br>
      </div>

      <div v-if="entry.answer_type=='ملف'">
        <!--input type="file" class="form-control" id="recipient-name" ref="file"  @change="handleFileUpload(entry.id)"-->
        <input type="file" class="form-control" id="recipient-name" ref="file"  @change="handleFileUpload(entry.id)">
        <div class="list-group" v-for="file , index in UploadedFiles">
          <a href="#"  @click="removeFile(file.id,index)" class="btn btn-outline-danger"> @{{ file.name }} - Click To Delete....</a>
        </div>
        <br>
      </div>

    </div>
  </div>

  <center><button type="button" class="btn btn-warning" style="font-size: 20px;" @click="Confirm()">Finish</button><br><p>ملاحظة : بعد الضغط على زر إنهاء لا تغلق النافذة إلى أن يتم نقلك إلى الصفحة الرئيسية</p></center>
  <!--</form>-->
</div>

</div>

@endsection
@section('script')
<script type="text/javascript">
  // locate the DOM element

 
</script>
<script src="{{ URL::asset('js/vue-good-table.js') }}" type="text/javascript"></script>
<!--<script src="{{ URL::asset('js/dashboard/vue-form-wizard.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/dashboard/ExamVue.js') }}" type="text/javascript"></script>

@endsection