<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<div id="grid">
    @include('popup.Update_Group_User_Popup')
    @include('popup.Insert_Group_Popup')
    @include('popup.Update_Group_Timing_Popup')
    @include('popup.Update_Group_Timing_Attendee_Popup')
    @include('popup.Update_Student_Group_Popup')
    @include('popup.Insert_Interview_Time_Popup')
    @include('popup.Choose_Notification_Level_Popup')
    <h2 v-if="table_buttons=='Group_Timing'">Group: @{{ group_name_label }}</h2>
    <h2 v-if="table_buttons=='Group_Timing_Attendee'">Group: @{{ group_name_label }}</h2>
    <h2 v-if="table_buttons=='Group_Timing_Attendee'">Session: @{{ group_timing_label }}</h2>
    
    <div class="row" v-if="table_buttons=='Groups'">
        <div class="col-10 mb-2 mr-auto ml-auto">
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal"  data-target="#Insert_Group_Popup" data-whatever="@mdo">أضف</button>
@if(Auth::user()->id== 78 || Auth::user()->id== 123||Auth::user()->email== "heba-abdulelah@hotmail.com")
            <a type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Choose_Notification_Level_Popup" data-whatever="@mdo" >
                تفعيل المجموعات
            </a>

             <a type="button" class="btn btn-add btn-md float-right"  data-toggle="modal"  data-target="#Insert_Interview_Time_Popup" data-whatever="@mdo">
                موعد بدء المقابلة الشفهية
            </a>
@endif
            
        </div>


    </div>

     
    <div class="row" v-if="table_buttons=='Group_Timing'">
        <div class="col-10 mb-2 mr-auto ml-auto">

            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
                عودة لقائمة المجموعات
            </button>
        </div>
    </div>
    <div class="row" v-if="table_buttons=='Group_Timing_Attendee'">
        <div class="col-md-9  mb-2 mr-auto ml-auto">
            
        </div>
        <div class="col-md-1  mb-2 mr-auto ml-auto">
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
                عودة لقائمة المجموعات
            </button>
        </div>

        <div class="col-md-1  mb-2 mr-auto ml-auto">
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch_Group_Timing(Group_Id,group_name_label)" data-whatever="@mdo">
                عودة  للجلسات
            </button>
        </div>

        <div class="col-md-1  mb-2 mr-auto ml-auto">
            
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
    v-if="table_buttons=='Groups'" >
    
    <!-- all the regular row items will be populated here-->
    <template slot="table-row-before" slot-scope="props">

    <!--<td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td>-->

    

    <td style="text-align: center; ">
        <div class="dropdown" >
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item" type="button" data-toggle="modal" @click="getUserdata(props.row.id)" data-target="#Update_Group_User_Popup" data-whatever="@mdo"> تعيين / تعديل الأستاذ </button>
            <button class="dropdown-item" type="button" @click="fetch_Group_Timing(props.row.id, props.row.group_name)" data-whatever="@mdo">استعراض الجلسات</button>
            <button class="dropdown-item" type="button" ><a :href='props.row.link' target="_blank" role="button" style='font-size:15px'><i class="fab fa-telegram"></i> Link to Telegram</a></button>
            <button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>

        </div>
    </div>
</td>

<td style="text-align: center; ">
    <p v-if="props.row.active==1">غير مفعلة</p>
    <p class="text-success" v-else>مفعلة</p>
</td>

<td style="text-align: center; ">
    <p style="color:red" v-if="props.row.female_only==1">للإناث فقط</p>
    <p style="color:blue" v-else>مختلط</p>
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
:paginate="paginate"
:styleClass="tableStyle" 
v-if="table_buttons=='Group_Timing'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props">

    <!--<td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td><a type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="props.row.link" data-whatever="@mdo"> <i class="fa fa-facebook"></i></a>-->
    
    <td>
        <div class="btn-group" style="text-align: center; ">
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button type="button" class="dropdown-item" @click="getStudents(props.row.id, props.row.name)" data-whatever="@mdo"> استعراض الطلاب </button>
            <button type="button" class="dropdown-item" data-toggle="modal" @click="getTimingdata(props.row.id)" data-target="#Update_Group_Timing_Popup" data-whatever="@mdo"> تعديل الوقت</button>

        </div>
    </div>
</td>
<td style="text-align: center; ">
    <p v-if="props.row.active==1">انتهت</p>
    <p class="text-success" v-else>مفعلة</p>
</td>
    <!--<td style="text-align: center; " v-if="table_buttons=='Group_Timing'">
        <button type="button" class="btn btn-warning btn-sm"  @click="Active_Group_Timing(props.row.id)" data-whatever="@mdo" v-if="props.row.active"> تفعيل</button>
        <button type="button" class="btn btn-info btn-sm" @click="Active_Group_Timing(props.row.id)" data-whatever="@mdo" v-else> إلغاء تفعيل</button>
    </td>
    <td>
        <a :href='props.row.link' target="_blank" role="button" style='font-size:20px'><i class="fab fa-telegram"></i></a>
    </td>-->
    

    
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
:paginate="paginate"
:styleClass="tableStyle" 
v-if="table_buttons=='Group_Timing_Attendee'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props">

    <!--<td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td><a type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="props.row.link" data-whatever="@mdo"> <i class="fa fa-facebook"></i></a>-->
    <td style="text-align: center; ">
        <div class="dropdown" style="text-align: center; ">
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

            <button type="button" class="dropdown-item" @click="getStudentSession(props.row.id)"  data-whatever="@mdo" data-toggle="modal"
            data-target="#Update_Group_Timing_Attendee_Popup">نقل جلسة الطالب</button> 
            <button type="button" class="dropdown-item" @click="getStudentSession(props.row.id)"  data-whatever="@mdo" data-toggle="modal"
            data-target="#Update_Student_Group_Popup">نقل مجموعة الطالب</button>

        </div>
       
    </div>
   </td>



   <td style="text-align: center; ">
    <p class="text-success" v-if="props.row.status==1">حاضر</p>
    <p style="color:red" v-else>لم يحضر</p>
    </td>


</template>
</vue-good-table>

</div>
