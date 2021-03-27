<div id="grid" >

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
                <button type="button" class="dropdown-item" data-toggle="modal"  @click="getUserLevel(props.row.user_id)" data-target="#Update_User_Level_Popup" data-whatever="@mdo">تعديل المستوى<i class="glyphicon glyphicon-name"></i></button>

                <button type="button" class="dropdown-item" data-toggle="modal"  @click="getUserRole(props.row.role_user)" data-target="#Update_User_Role_Popup" data-whatever="@mdo">تعديل الصلاحية<i class="glyphicon glyphicon-name"></i></button>

                <!--<button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal"  @click="trashdata(props.row.id)" data-whatever="@mdo" name="value->id"> حذف<i class="glyphicon glyphicon-name"></i></button>-->
                <button type="button" class="dropdown-item dropdown-item-alert" data-toggle="modal" @click="BlockUser(props.row.user_id)" data-whatever="@mdo" v-if="props.row.user_block==0"> حظر</button>
                <button type="button" class="dropdown-item" data-toggle="modal" @click="BlockUser(props.row.user_id)" data-whatever="@mdo" v-else>إلغاء حظر</button>

            </div>
        </div>
    </td>

    <td style="text-align: center; ">
        <p v-if="props.row.previous_student==1">طالب سابق</p>
        <p class="text-success" v-else>مستجد</p>
    </td>
        
    
    </template>
</vue-good-table>
</div>