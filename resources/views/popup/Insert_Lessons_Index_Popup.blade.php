<div class="modal fade right " id="Insert_Lessons_Index_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <h5  id="popupWinLabel" class="float-right">أضف درس</h5>
    <div class="modal-content">
      <div class="modal-body float-right">
          <div class="form-group  ">
            @php
            /*
            <label for="recipient-name" class="col-form-label float-right">:اسم الدرس</label>
            <input type="text" class="form-control" id="recipient-name" v-model="name">
            <p class="font-red-sunglo">@{{ errors.name }}</p>
            */
            @endphp
            <h4 for="recipient-name" class="col-form-label ">:المستوى</h4>
            <v-select style="background-color: #FFF" :options="Levels" id="recipient-name" ref="select" v-model="User_Level">
            <script type="text/x-template" id="select2-template1">
            <select>
                <slot></slot>
            </select>
            </script>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeInsert_Lessons_Index" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Insert_Lessons_Index">حفظ</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->