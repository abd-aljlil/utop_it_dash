 <div class="modal fade" id="Insert_Group_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinUpdateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">إضافة مجموعة طلابية</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @php
          /*
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">اسم المجموعة</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name" >
            <span  class="label label-warning">@{{ errors.name }}</span>
          </div>
          */
          @endphp
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">المستوى</label>
            <v-select style="background-color: #FFF" :options="Levels" ref="select" v-model="level">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
            <span  class="label label-warning">@{{ errors.user_level }}</span>
          </div>
          
          <div class="form-group">
            <input type="radio" id="1" value="1" v-model="female_only">
            <label for="recipient-name" class="col-form-label">للبنات فقط</label>
            <br>
            <input type="radio" id="0" value="0" v-model="female_only">
            <label for="recipient-name" class="col-form-label">مختلط</label>
          </div>

          <div class="row ">
          <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">الأستاذ المساعد</label>
                        <v-select style="background-color: #FFF" :options="Teachers" ref="select" v-model="user_id">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.user_id }}</p>
                </div>
            </div>
        </div>
        <div class="row ">
        <div class="col-md-10">
                <div class="form-group ">
                    <div class="input-icon left">
                        <label for="recipient-name" class="col-form-label">يوم اللقاء</label>
                        <v-select style="background-color: #FFF" :options="Days" ref="select" v-model="day">
                        <script type="text/x-template" id="select2-template1">
                        <select>
                            <slot></slot>
                        </select>
                        </script>
                    </div>
                    <p class="font-red-sunglo" v-for="entry in errors.linoleum_linoleum_id">@{{ errors.day }}</p>
                </div>
        </div>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">وقت اللقاء</label>
            <input type="time" class="form-control" id="recipient-name" v-model="time" >
            <span  class="label label-warning">@{{ errors.time }}</span>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">رابط المجموعة للتواصل</label>
            <input type="text" class="form-control" id="recipient-name" v-model="group_timing_link" >
            <span  class="label label-warning">@{{ errors.group_timing_link }}</span>
        </div>
        
      </div><!--.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeInsert" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Group">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->