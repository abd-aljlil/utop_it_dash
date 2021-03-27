<div id="grid">
    @include('popup.Insert_Lessons_Index_Popup')
    @include('popup.Update_Lessons_Index_Popup')
    @include('popup.Insert_Lessons_Archive_Popup')
    @include('popup.Update_Lessons_Archive_Popup')
    @include('popup.Insert_Lessons_Archive_Files_Popup')
    @include('popup.Update_Lessons_Archive_Files_Popup')
    @include('popup.Choose_Notification_Level_Popup')
    <h4 class="modal-title pull-left" id="popupWinLabel">@{{ Lesson_Index_Name }}</h4>
    <div class="row" >
        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='Lessons_Index'">

            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Lessons_Index_Popup" data-whatever="@mdo">أضف</button>
@if(Auth::user()->email== "heba-abdulelah@hotmail.com" || Auth::user()->id==148 )
            <a type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Choose_Notification_Level_Popup" data-whatever="@mdo">إشعار نشر الدرس للطلاب</a>
@endif
        </div>

        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='Lessons_Archive'">
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Lessons_Archive_Popup" data-whatever="@mdo">أضف</button>
            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            عودة إلى قائمة الدروس
        </button>

        </div>

        <div class="col-10 mb-2 mr-auto ml-auto" v-if="table_buttons=='Lessons_Archive_Files'">
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Lessons_Archive_Files_Popup" data-whatever="@mdo">أضف</button>

            <button type="button" class="btn btn-info btn-md float-right" data-toggle="modal" @click="fetch()" data-whatever="@mdo">
            عودة إلى قائمة الدروس
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
    :styleClass="tableStyle" >
    
    <!-- all the regular row items will be populated here-->
    <template slot="table-row-before" slot-scope="props" >



       <td style="text-align: center; " v-if="table_buttons=='Lessons_Index'">
        <div class="btn-group" style="text-align: center; ">
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
            <button type="button" class="dropdown-item" data-toggle="modal" @click="getdata(props.row.id)" data-target="#Update_Lessons_Index_Popup" data-whatever="@mdo"> <i class="fa fa-edit"></i>تعديل</button>
            <button type="button" class="dropdown-item" data-toggle="modal" @click="Show_Lessons_Archive(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض المواعيد</button>

        </div>
    </div>
</td>

<td style="text-align: center; " v-if="table_buttons=='Lessons_Archive'">
    <div class="btn-group" style="text-align: center; ">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal"  @click="Trash_Lessons_Archive_Data(props.row.id)" data-whatever="@mdo" name="value->id">حذف<i class="glyphicon glyphicon-name"></i></button>
        <button type="button" class="dropdown-item" data-toggle="modal" @click="Get_Lessons_Archive_Data(props.row.id)" data-target="#Update_Lessons_Archive_Popup" data-whatever="@mdo"> <i class="fa fa-edit"></i>تعديل</button>
        <button type="button" class="dropdown-item"  @click="Active_Lessons_Archive(props.row.id)"  data-whatever="@mdo" v-if="props.row.active==0"> <i class="fa fa-edit"></i>أرشفة الدرس</button>
        <button type="button" class="dropdown-item"  @click="Active_Lessons_Archive(props.row.id)"  data-whatever="@mdo" v-else> <i class="fa fa-edit"></i>إلغاء أرشفة الدرس</button>
        <button type="button" class="dropdown-item" data-toggle="modal" @click="Show_Lessons_Archive_Files(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض الملفات</button>

    </div>
</div>
</td>

<td style="text-align: center; " v-if="table_buttons=='Lessons_Archive'">
    <p style="color: red" v-if="props.row.active==1">مؤرشف</p>
    <p class="text-success" v-else>فعال</p>
</td>

<td style="text-align: center; " v-if="table_buttons=='Lessons_Archive_Files'">
    <div class="btn-group" style="text-align: center; ">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button type="button" class="dropdown-item data-toggle dropdown-item-alert" data-toggle="modal"  @click="Trash_Lessons_Archive_File(props.row.id)" data-whatever="@mdo" name="value->id">حذف<i class="glyphicon glyphicon-name"></i></button>
        
    </div>
</div>
</td>
<td style="text-align: center; " v-if="table_buttons=='Lessons_Archive_Files'">
    <p style="color: red" v-if="props.row.active==1">مؤرشف</p>
    <p class="text-success" v-else>فعال</p>
</td>
<td style="text-align: center; " v-if="table_buttons=='Lessons_Archive_Files'">
<a type="button" class="btn btn-add btn-sm"  @click="Get_File(props.row.file)" target="_blank"> @{{props.row.file}}</a>
</td>


</template>


</vue-good-table>
</div>