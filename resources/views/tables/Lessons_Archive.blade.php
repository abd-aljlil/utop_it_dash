<div id="grid">
    @include('popup.Insert_Lessons_Index_Popup')
    @include('popup.Update_Lessons_Index_Popup')
   
    <div class="row">
        <div class="col-10 mb-2 mr-auto ml-auto">
			<button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Lessons_Index_Popup" data-whatever="@mdo">أضف</button>
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
    <template slot="table-row-before" slot-scope="props">
    
    <td style="text-align: center; ">
        <button type="button" class="btn btn-danger red-thunderbird btn-sm" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>
    </td>

    <td style="text-align: center; ">
        <button type="button" class="btn btn-add btn-sm" data-toggle="modal" @click="getdata(props.row.id)" data-target="#Update_Lessons_Index_Popup" data-whatever="@mdo"> <i class="fa fa-edit"></i>تعديل</button>
    </td>
    
    </template>
    </vue-good-table>
</div>