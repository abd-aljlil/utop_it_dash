<div id="grid" >
    @php
    /*
    @include('popup.Insert_Exam_NamePopup')    
    @include('popup.Update_Exam_NamePopup')
    <div class="row">
        <div class="col-10 mb-2 mr-auto ml-auto">
            <button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#Insert_Exam_NamePopup" data-whatever="@mdo">أضف</button>
        </div>
    </div>

    */
    @endphp
    @include('popup.Update_User_Level')
    @include('popup.Update_User_Role_Popup')    
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
            <div class="dropdown" >
              <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button type="button" class="dropdown-item" data-toggle="modal"  @click="getUserLevel(props.row.user.id)" data-target="#Update_User_Level_Popup" data-whatever="@mdo">تعديل المستوى<i class="glyphicon glyphicon-name"></i></button>

                <button type="button" class="dropdown-item" data-toggle="modal"  @click="getUserRole(props.row.id)" data-target="#Update_User_Role_Popup" data-whatever="@mdo">تعديل الصلاحية<i class="glyphicon glyphicon-name"></i></button>

                <!--<button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>-->
                <button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal" @click="BlockUser(props.row.user.id)" data-whatever="@mdo" v-if="props.row.user.block==0"> حظر</button>
                <button type="button" class="dropdown-item" data-toggle="modal" @click="BlockUser(props.row.user.id)" data-whatever="@mdo" v-else>إلغاء حظر</button>

            </div>
        </div>
    </td>

    <td style="text-align: center; ">
        <p v-if="props.row.user.previous_student==1">طالب سابق</p>
        <p class="text-success" v-else>مستجد</p>
    </td>

    <!--<td style="text-align: center; " v-if="props.row.user.active==1">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" @click="ActivateUser(props.row.user.id)"  data-whatever="@mdo"> قبول</button>
    </td>

    <td style="text-align: center; " v-if="props.row.user.active==0">
        
    </td>-->
    
</template>
</vue-good-table>
</div>