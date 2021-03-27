<div id="grid">
    <h4 class="modal-title pull-right" id="popupWinLabel">@{{ Lesson_Index_Name }}</h4>
   
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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" @click="Show_Lessons_Archive(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض المواعيد</button>
    </td>
    <td style="text-align: center; " v-if="table_buttons=='Lessons_Archive'">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" @click="Show_Lessons_Archive_Files(props.row.id)"  data-whatever="@mdo"> <i class="fa fa-edit"></i>عرض الملفات</button>
    </td>
    <td style="text-align: center; " v-if="table_buttons=='Lessons_Archive_Files'">
        <a type="button" class="btn btn-add btn-sm"  @click="Get_File(props.row.file)" > @{{props.row.file}}</a>
    </td>
    </template>
    </vue-good-table>
</div>