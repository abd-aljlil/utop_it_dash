<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<div id="grid">
    @include('popup.Update_Group_Timing_Popup')
    @include('popup.Insert_Group_Timing_Popup') 
   @include('popup.Update_Group_Timing_Attendee_Marks_Popup')
   @include('popup.Update_User_Marks_Popup')
    
    
    <h2 v-if="table_buttons=='Group_Timing'">Group: @{{ group_name_label }}</h2>
    <h2 v-if="table_buttons=='Group_Timing'">Level: @{{ group_level_label }}</h2>
    <h2 v-if="table_buttons=='Group_Timing_Attendee'">Group: @{{ group_name_label }}</h2>
    <h2 v-if="table_buttons=='Group_Timing_Attendee'">Level: @{{ group_level_label }}</h2>

    <h2 v-if="table_buttons=='User_Marks'" style="color:red">Final Interview Marks</h2>
    <h2 v-if="table_buttons=='User_Marks'">Group: @{{ group_name_label }}</h2>
    <h2 v-if="table_buttons=='User_Marks'">Level: @{{ group_level_label }}</h2>

    <div class="row" v-if="table_buttons=='Group_Timing'">
        <div class="col-10 mb-2 mr-auto ml-auto">
            <!--<button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Group_Timing_Popup" data-whatever="@mdo">أضف</button>-->
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
                Back to the groups list
            </button>
        </div>
    </div>
    <div class="row" v-if="table_buttons=='Group_Timing_Attendee'">
        <div class="col-10 mb-2 mr-auto ml-auto">
         <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            Back to the groups list
        </button>
         <button type="button" class="btn btn-warning btn-md float-right" data-toggle="modal" @click="fetch_Group_Timing(Group_Id,group_name_label, group_level_label)" data-whatever="@mdo">
                back to the sessions list
            </button>
    </div>
 
</div>
<div class="row" v-if="table_buttons=='User_Marks'">
        <div class="col-10 mb-2 mr-auto ml-auto">
         <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            Back to the groups list
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
:styleClass="tableStyle" 
v-if="table_buttons=='Groups'">

<!-- all the regular row items will be populated here-->

<template slot="table-row-before" slot-scope="props"  >

    <td style="text-align: center; ">
        <div class="dropdown" >
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button type="button" class="dropdown-item" data-toggle="modal" @click="fetch_Group_Timing(props.row.id,props.row.name,props.row.user_level)" data-whatever="@mdo">Display Sessions</button>

            <button type="button" class="dropdown-item" data-toggle="modal" @click="fetch_Student_Marks(props.row.id,props.row.name,props.row.user_level)" data-whatever="@mdo">Oral exam grades</button>
        </div>
    </div>
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

    <td style="text-align: center; ">
        <div class="dropdown" >
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button type="button" class="dropdown-item" @click="getStudents(props.row.id)" data-whatever="@mdo"> Attendance Marking</button>

            <!--<button type="button" class="dropdown-item" data-toggle="modal" @click="getdata(props.row.id)" data-target="#Update_Group_Timing_Popup" data-whatever="@mdo"> تعديل الوقت</button>-->
            
            <div v-if="table_buttons=='Group_Timing'">
            <button type="button" class="dropdown-item"  @click="Active_Group_Timing(props.row.id)" data-whatever="@mdo" v-if="props.row.active==1"> Activate</button>
            <button type="button" class="dropdown-item" @click="Active_Group_Timing(props.row.id)" data-whatever="@mdo" v-else> De-activate</button>
            </div>

            <button class="dropdown-item" type="button" ><a :href='props.row.link' target="_blank" role="button"><i class="fab fa-telegram"></i> Link to Telegram</a></button>
        </div>
    </div>
</td>
<td style="text-align: center; ">
    <p style="color:red" v-if="props.row.active==1">Done</p>
    <p class="text-success" v-else>Active</p>
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
v-if="table_buttons=='Group_Timing_Attendee'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props">

    <!--<td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td><a type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="props.row.link" data-whatever="@mdo"> <i class="fa fa-facebook"></i></a>-->

    <td style="text-align: center; ">
    <div class="dropdown" >
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>

    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Update_Group_Timing_Marks_Popup" @click="getStudentStatus(props.row.id)"  data-whatever="@mdo">Edit Marks</button>
    
    </div>

    </div>
    </td>

    <td style="text-align: center; ">
    <p class="text-success" v-if="props.row.status==1">Present</p>
    <p style="color:red" v-else>Absent</p>
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
v-if="table_buttons=='User_Marks'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props">

    <!--<td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td><a type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="props.row.link" data-whatever="@mdo"> <i class="fa fa-facebook"></i></a>-->

    <td style="text-align: center; ">
    <div class="dropdown" >
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>
@if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Update_User_Marks_Popup" @click="getUserMark(props.row.id)"  data-whatever="@mdo">Interview Marks
        </button>
    </div>
@endif
    </div>
    </td>

    <!--<td style="text-align: center; ">
    <p class="text-success" v-if="props.row.status==1">Present</p>
    <p style="color:red" v-else>Absent</p>
    </td>-->

   
    

    
</template>
</vue-good-table>
</div>

