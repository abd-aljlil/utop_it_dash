<div class="modal fade right " id="Choose_Notification_Level_Popup" tabindex="-1" role="dialog" aria-labelledby="popupWinLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupWinUpdateLabel">تحديد المستوى المراد إشعاره</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body float-right">
          <div class="form-group  ">
            <h4 for="recipient-name" class="col-form-label ">:المستوى</h4>
            <v-select style="background-color: #FFF" :options="Levels" id="recipient-name" ref="select" v-model="Notify_User_Level">
            <script type="text/x-template" id="select2-template1">
            <select>
                <slot></slot>
            </select>
            </script>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeChoose_level_popup" data-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-warning" @click="Activate(1)">تأكيد</button>
      </div><!--.modal-footer -->
    </div><!--.modal-content -->
  </div><!--.modal-dialog -->
</div><!--.modal -->
