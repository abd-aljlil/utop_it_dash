<div id="grid">
    @include('popup.Insert_Announcement_Popup')    
    @include('popup.Update_Announcement_Popup')
    <div class="row">
        <div class="col-10 mb-2 mr-auto ml-auto">
         <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Announcement_Popup" data-whatever="@mdo">أضف</button>
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
 :styleClass="tableStyle">
 
 <!-- all the regular row items will be populated here-->
 <template slot="table-row-before" slot-scope="props">
   <td style="text-align: center; ">
       <div class="dropdown" >
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button type="button" class="dropdown-item" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo">حذف</button>
            <button class="dropdown-item" type="button" data-toggle="modal" @click="getdata(props.row.id)" data-target="#Update_Announcement_Popup" data-whatever="@mdo"> <i class="fa fa-edit"></i>تعديل</button>
            
        </div>
    </div>
</td>

</template>
</vue-good-table>
</div>