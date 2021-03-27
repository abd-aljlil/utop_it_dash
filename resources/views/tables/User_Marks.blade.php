<div id="grid" >
    
   

    <div class="form-group pull-left" id="tableToExcel">
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

    <div class="form-group pull-left" id="ReportStyle">
        <div class="col-md-3">
            <div class="btn-group">
                
                <button type="button" class="btn  btn-success " data-style="contract" data-spinner-color="#333"  onclick="ReportStyle()" tabindex="-1">
                <span class="ladda-label">
                <i class="icon-doc"></i> تجهيز التقرير للتصدير</span>
                <span class="ladda-spinner"></span></button>
            </div>
        </div>
    </div>

    <div class="form-group pull-right" id="ReportStyle">
        <div class="col-md-3">
            <div class="btn-group">
                @if(Auth::user()->email== "mohammad.almoshantaf@gmail.com")
                <a type="button" class="btn btn-add btn-md float-right" href="EndOfCourse" data-whatever="@mdo">إرسال استبيان نهاية الدورة للطلاب</a>
                @endif
            </div>
        </div>
    </div>

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



      <!--  <td style="text-align: center; ">
            <div class="dropdown" >
              <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button type="button" class="dropdown-item" data-toggle="modal"  @click="getUserLevel(props.row.user.id)" data-target="#Update_User_Level_Popup" data-whatever="@mdo">تعديل المستوى<i class="glyphicon glyphicon-name"></i></button>

                

            </div>
        </div>
    </td>

    <td style="text-align: center; ">
        <p v-if="props.row.user.previous_student==1">طالب سابق</p>
        <p class="text-success" v-else>مستجد</p>
    </td>

    <td style="text-align: center; " v-if="props.row.user.active==1">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" @click="ActivateUser(props.row.user.id)"  data-whatever="@mdo"> قبول</button>
    </td>

    <td style="text-align: center; " v-if="props.row.user.active==0">
        
    </td>-->
    
</template>
</vue-good-table>
</div>