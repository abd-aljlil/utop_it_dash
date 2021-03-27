<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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



    <td style="text-align: center; ">
    <button class="dropdown-item" type="button" ><a :href='props.row.fb_link' target="_blank" role="button" style='font-size:15px'><i class="fab fa-facebook"></i></a></button>
</td>
    
</template>
</vue-good-table>
</div>