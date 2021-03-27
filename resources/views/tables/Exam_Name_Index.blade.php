<div id="grid">
    @include('popup.Insert_Exam_NamePopup')
    @include('popup.Update_Exam_Index_Popup')
    @include('popup.Insert_Question_TypesPopup')
    @include('popup.Insert_Exam_Name_Indexpopup')
    @include('popup.Update_Exam_Index_Questions_Popup')
    @include('popup.Insert_Exam_Name_Index_Users_Popup')
    @include('popup.Insert_Exam_Name_Index_Questionspopup')
    @include('popup.Set_Exam_Name_Index_Questions_Percent_popup')
    @include('popup.Set_Exam_Name_Index_Questions_Order_popup')
    @include('popup.Insert_level_setting_exam_percentpopup')
    
    <h2 v-if="table_buttons=='Exam_Name_Index_Users'">فحص @{{ exam_name_label }}</h2>
    <h2 v-if="table_buttons=='Exam_Name_Index_Questions'">فحص @{{ exam_name_label }}</h2>
    <h5 v-if="table_buttons=='Exam_Name_Index_Questions'">مجموع درجات الأسئلة @{{ Exam_Index_Sum_Questions_Percents }}</h5>
    <h5 v-if="table_buttons=='Exam_Name_Index_Questions'">من أصل @{{ exam_index_percent }}</h5>
    @php
    /*
    @include('popup.Insert_Exam_Name_Indexpopup')
    @include('popup.UpdateExamNamePopup')
    */
    @endphp
   
    <div class="row" v-if="table_buttons=='Exam_Name_Index'">
        <div class="col-10 mb-2 mr-auto ml-auto" >
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Exam_Name_Indexpopup" data-whatever="@mdo">أضف </button>
        </div>
    </div>

    <div class="row" v-if="table_buttons=='level_setting_exam_percent'">
        <div class="col-10 mb-2 mr-auto ml-auto" >
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_level_setting_exam_percentpopup" data-whatever="@mdo">أضف </button>
            
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            عودة لقائمة الامتحانات 
            </button>
        </div>
    </div>

    <div class="row" v-if="table_buttons=='Exam_Name_Index_Questions'">
        <div class="col-10 mb-2 mr-auto ml-auto" >
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Exam_Name_Index_Questionspopup" data-whatever="@mdo">
            أضف 
            </button>
            
            <button type="button" class="btn btn-warning btn-md float-right" data-toggle="modal" @click="SetQuestionspercent(Exam_Name_Index_Id)" data-target="#Set_Exam_Name_Index_Questions_percent_popup" data-whatever="@mdo">
            تعيين نسب الأجوبة  
            </button>
            <button type="button" class="btn btn-warning btn-md float-right" data-toggle="modal" @click="SetQuestionspercent(Exam_Name_Index_Id)" data-target="#Set_Exam_Name_Index_Questions_order_popup" data-whatever="@mdo">
            تعيين ترتيب الأجوبة  
            </button>
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            عودة لقائمة الامتحانات 
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='Exam_Name_Index_Users'">
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Exam_Name_Index_Users_Popup" data-whatever="@mdo">أضف </button>
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            عودة لقائمة الامتحانات 
            </button>
        </div>
    </div>

    <vue-good-table 
    id="testTable"
    data-tableName="Test Table 1"
    :title="TableTitle"
    :columns="columns"
    :rows="rows"
    :lineNumbers="true" 
    :globalSearch="true"
    :paginate="paginate"
    :styleClass="tableStyle" 
    v-if="table_buttons=='Exam_Name_Index'">
    <!-- all the regular row items will be populated here-->
    <template slot="table-row-before" slot-scope="props" v-if="table_buttons=='Exam_Name_Index'" >
  

   <td style="text-align: center; ">
       <div class="btn-group">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            عمليات
          </button>
          <div class="dropdown-menu">
            

            <a class="dropdown-item" href="#"  data-toggle="modal" @click="Get_Questions_data(props.row.id,props.row.exam__name.name,props.row.exam_percent,props.row.exam_type)" data-whatever="@mdo"> عرض الاسئلة </a>
        
        <a class="dropdown-item" href="#"  data-toggle="modal"  @click="Fetch_Exam_Name_Index_Users(props.row.id,props.row.exam__name.name)" data-whatever="@mdo"> عرض الطلاب  
        </a>
        
        <a class="dropdown-item" href="#"   data-toggle="modal" data-target="#Insert_Exam_Name_Index_Users_Popup" @click="SetExam_Name_Index(props.row.id,props.row.exam__name.name)" data-whatever="@mdo"> تخصيص الطلاب 
        </a>

        <a class="dropdown-item" href="#"   data-toggle="modal"  @click="Fetch_level_setting_exam_percent(props.row.id)" data-whatever="@mdo" v-if="props.row.exam__name.name=='تحديد مستوى'">تخصيص المستويات
        </a>
        
        <a class="dropdown-item" href="#"   data-toggle="modal" @click="getExamIndexdata(props.row.id)" data-target="#Update_Exam_Index_Popup" data-whatever="@mdo" > <i class="fa fa-edit"></i>تعديل  الامتحان  
        </a>
        
        <a class="dropdown-item dropdown-item-alert" href="#"  data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id" > حذف الامتحان <i class="glyphicon glyphicon-name"></i>
        </a>
        <a class="dropdown-item" href="#"   data-toggle="modal" @click="SetQuestionsorder(props.row.id)" data-target="#Set_Exam_Name_Index_Questions_order_popup" data-whatever="@mdo" > <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;تعديل ترتيب الأسئلة &nbsp;&nbsp;&nbsp;&nbsp;
        </a>

          </div>
        </div>
        @php
        /*
    <div class="btn-group" >
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
        <a class="dropdown-item" href="#" type="button" data-toggle="modal" @click="Get_Questions_data(props.row.id,props.row.exam__name.name,props.row.exam_percent,props.row.exam_type)" data-whatever="@mdo"> <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;عرض الاسئلة &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        
        <a class="dropdown-item" href="#" type="button"  data-toggle="modal"  @click="Fetch_Exam_Name_Index_Users(props.row.id,props.row.exam__name.name)" data-whatever="@mdo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; عرض الطلاب  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </a>
        
        <a class="dropdown-item" href="#" type="button"  data-toggle="modal" data-target="#Insert_Exam_Name_Index_Users_Popup" @click="SetExam_Name_Index(props.row.id,props.row.exam__name.name)" data-whatever="@mdo"> &nbsp;&nbsp;&nbsp;&nbsp;تخصيص الطلاب &nbsp;&nbsp;&nbsp;
        </a>

        <a class="dropdown-item" href="#" type="button"  data-toggle="modal"  @click="Fetch_level_setting_exam_percent(props.row.id)" data-whatever="@mdo" v-if="props.row.exam__name.name=='تحديد مستوى'">&nbsp;تخصيص المستويات&nbsp;&nbsp;
        </a>
        
        <a class="dropdown-item" href="#" type="button"  data-toggle="modal" @click="getExamIndexdata(props.row.id)" data-target="#Update_Exam_Index_Popup" data-whatever="@mdo" > <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;تعديل  الامتحان  &nbsp;&nbsp;&nbsp;&nbsp;
        </a>
         <a class="dropdown-item" href="#" type="button"  data-toggle="modal" @click="SetQuestionspercent(props.row.id)" data-target="#Set_Exam_Name_Index_Questions_order_popup" data-whatever="@mdo" > <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;تعديل  الامتحان 1 &nbsp;&nbsp;&nbsp;&nbsp;
        </a>
       
        <a class="dropdown-item" href="#" type="button" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; حذف الامتحان &nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-name"></i>
        </a>
    </div>
  </div>
  */
  @endphp
    </td>

    <td style="text-align: center; ">
        
        <button type="button" class="btn btn-warning btn-md float-right" data-toggle="modal" @click="SetQuestionspercent(props.row.id)" data-target="#Set_Exam_Name_Index_Questions_percent_popup" data-whatever="@mdo"  v-if="props.row.active==1">
            تعيين نسب الأجوبة  
            </button>
        <p class="text-success" v-else>جاهز</p>

    </td>


    </template>
    </vue-good-table>

    <vue-good-table 
    id="testTable"
    data-tableName="Test Table 1"
    :title="TableTitle"
    :columns="columns"
    :rows="rows"
    :lineNumbers="true"
    :globalSearch="true"
    :styleClass="tableStyle" 
    v-if="table_buttons=='Exam_Name_Index_Questions'">
    
    <!-- all the regular row items will be populated here-->

    <template slot="table-row-before" slot-scope="props"  v-if="table_buttons=='Exam_Name_Index_Questions'">
    
    <td style="text-align: center; " >
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashQuestionData(props.row.id)" data-whatever="@mdo" name="value->id" > حذف<i class="glyphicon glyphicon-name"></i></button>
    </td>

    <td style="text-align: center; ">
        <button type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="getOneQuestionDetails(props.row.id)" data-target="#Update_Exam_Name_Index_Questionspopup" data-whatever="@mdo" > <i class="fa fa-edit"></i>تعديل</button>
    </td>

    </template>
    </vue-good-table>
    <vue-good-table 
    id="testTable"
    data-tableName="Test Table 1"
    :title="TableTitle"
    :columns="columns"
    :rows="rows"
    :lineNumbers="true"
    :globalSearch="true"
    :styleClass="tableStyle" 
    v-if="table_buttons=='Exam_Name_Index_Users'">

    <template slot="table-row-before" slot-scope="props"  v-if="table_buttons=='Exam_Name_Index_Users'">
        
    <td style="text-align: center; " >
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trash_Exam_Name_Index_Users(props.row.id)" data-whatever="@mdo" name="value->id" > حذف<i class="glyphicon glyphicon-name"></i></button>
    </td>

    </template>
    </vue-good-table>


     <vue-good-table 
    id="testTable"
    data-tableName="Test Table 1"
    :title="TableTitle"
    :columns="columns"
    :rows="rows"
    :lineNumbers="true"
    :globalSearch="true"
    :styleClass="tableStyle" 
    v-if="table_buttons=='level_setting_exam_percent'">

    <template slot="table-row-before" slot-scope="props"  v-if="table_buttons=='level_setting_exam_percent'">
        
    <td style="text-align: center; " >
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  @click="trash_level_setting_exam_percent(props.row.id)" data-whatever="@mdo" name="value->id" >حذف<i class="glyphicon glyphicon-name"></i></button>
    </td>

    </template>
    </vue-good-table>

</div>