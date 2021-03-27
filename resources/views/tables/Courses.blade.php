<div id="grid">

    @include('popup.Update_Course_Info_Popup')
    <h2 v-if="table_buttons=='courses_levels'">Course: @{{ course_id }}</h2>
    <h2 v-if="table_buttons=='courses_levels_students'">Course: @{{ course_id }}</h2>
    <h2 v-if="table_buttons=='courses_levels_students'">Level: @{{ level_id }}</h2>

    <h2 v-if="table_buttons=='courses_levels_groups'">Course: @{{ course_id }}</h2>
    <h2 v-if="table_buttons=='courses_levels_groups'">Level: @{{ level_id }}</h2>

    <h4 class="modal-title pull-left" id="popupWinLabel"></h4>
    <div class="row" >
        <div class="col-10 mb-2 mr-auto ml-auto" >
         
    </div>
</div>
<div class="row">
        <div class=" pull-left" id="tableToExcel">
        <div class="col-md-3">
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                خيارات
                </button>

                <div class="dropdown-menu">

                <a class="dropdown-item" href="#"  id="exportToButton" onclick="tableToExcel('testTable', 'W3C Example Table')">
                    <i class="icon-doc"></i> تصدير إلى اكسل &nbsp;&nbsp;
                </a>
                
                <a class="dropdown-item" href="#" onclick="StoreStyle()">إلغاء تجهيز التقرير  
                </a>
               

                </div>
            </div>
        </div>
    </div>

    <div class=" pull-left" id="ReportStyle">
        <div class="col-md-3">
            <div class="btn-group">
                
                <button type="button" class="btn  btn-success " data-style="contract" data-spinner-color="#333"  onclick="ReportStyle()" tabindex="-1">
                <span class="ladda-label">
                <i class="icon-doc"></i> تجهيز التقرير للتصدير</span>
                <span class="ladda-spinner"></span></button>
            </div>
        </div>
    </div>

    <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='courses_levels'">
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
                عودة للدورات
            </button>
        </div>
        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='courses_levels_students'">
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch_levels(course_id)" data-whatever="@mdo">
                عودة للمستويات
            </button>
        </div>
        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='courses_levels_groups'">
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch_levels(course_id)" data-whatever="@mdo">
                عودة للمستويات
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
v-if="table_buttons=='courses'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props" >



 <td style="text-align: center; " >
    <div class="btn-group" style="text-align: center; ">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

        <button type="button" class="dropdown-item" data-toggle="modal" @click="getdata(props.row.id)" data-target="#Update_Course_Info_Popup" data-whatever="@mdo"> <i class="fa fa-edit"></i>تعديل المعلومات</button>
        @if(Auth::user()->id== 76 || Auth::user()->id== 123 || Auth::user()->id== 8888 || Auth::user()->email== "heba-abdulelah@hotmail.com")
        <button type="button" class="dropdown-item" data-toggle="modal" @click="Activate(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>تفعيل</button>
        @endif
        <button type="button" class="dropdown-item" data-toggle="modal" @click="fetch_levels(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض المستويات</button>
        <button type="button" class="dropdown-item" data-toggle="modal" @click="calculate_success(props.row.id)" data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض نسبة النجاح</button>

    </div>
</div>
</td>

<td style="text-align: center; ">
    <p v-if="props.row.active==0">غير فاعلة</p>
    <p class="text-success" v-else>فاعلة </p>
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
v-if="table_buttons=='courses_levels'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props" >



 <td style="text-align: center; " >
    <div class="btn-group" style="text-align: center; ">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

        <button type="button" class="dropdown-item" data-toggle="modal" @click="fetch_students(props.row.level)" data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض محصلة الطلاب</button>
        <button type="button" class="dropdown-item" data-toggle="modal" @click="fetch_students_groups(props.row.level)" data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض مجموعة الطالب</button>
@if(Auth::user()->id== 76 || Auth::user()->id== 8888 ||  Auth::user()->email== "heba-abdulelah@hotmail.com")
        <button type="button" class="dropdown-item" data-toggle="modal" @click="calculate_students_totals(props.row.level)" data-whatever="@mdo"> <i class="fa fa-edit"></i>حساب مجموع الطلاب </button>
@endif
      
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
v-if="table_buttons=='courses_levels_groups'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props" >

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
v-if="table_buttons=='courses_levels_students'">

<!-- all the regular row items will be populated here-->
<template slot="table-row-before" slot-scope="props" >

</template>

</vue-good-table>


</div>