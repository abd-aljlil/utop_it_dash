@include('popup.updatePopup');
<style>
.table .darkblue{
	background-color:#014260 !important;
	color:#fff !important;
}
.btn-add{
	background-color:#ffe484 !important;
	moz-transition:all 0.3s linear;
	webkit-transition:all 0.3s linear;
	transition:all 0.3s linear;
	color:#014260;
	font-weight:600 !important;
}
.btn-add:hover{
	background-color:#edc949 !important;
}

</style>
<div class="container">
	<div class="row">
		<div class="col-10 mb-2 mr-auto ml-auto">
			<button type="button" class="btn btn-add btn-md float-right" data-toggle="modal" data-target="#popup-win" data-whatever="@mdo">أضف</button>
		</div>
		<div class="w-100"></div>
		<div class="col-10 mr-auto ml-auto">
			<div id="sample_3_wrapper" class="dataTables_wrapper no-footer">
				<div class="table-scrollable ">
					<div id="dataTableDiv ">
						<table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer "  role="grid" aria-describedby="sample_1_info">
							<thead>
								<tr role="row">
									<th class="sorting darkblue" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" خيارات : activate to sort column ascending" style="width: 5px; text-align: center; background-color: #e7505a;"> حذف
									</th>
									<th class="sorting darkblue" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" خيارات : activate to sort column ascending" style="width: 5px; text-align: center; background-color: #e7505a;"> تعديل
									</th>
									<th class="sorting_asc darkblue" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 150px; text-align: center; background-color: #e7505a;"> مواصفات المادة
									</th>
									<th class="sorting_asc darkblue" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 150px; text-align: center; background-color: #e7505a;"> اسم المادة
									</th>

								</tr>
							</thead>
							<tbody >
								<tr class="gradeX odd" role="row" id="linoleum-" v-for="entry in filteredData" >
									<th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" >
										<a class="btn btn-circle red-thunderbird" style="text-align: center; " href="javascript:;" @click="trashdata(entry.id)" name="value->id">
										<i class="fa fa-recycle"></i>  </a>
									</th>
									
									<th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" style="text-align: center; " aria-sort="ascending" aria-label=" Username : activate to sort column descending" >
										<button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#popup-win-update" data-whatever="@mdo"> تعديل</button>
									</th>
									<th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 150px; text-align: center;" > @{{ entry.notes }} 
									</th>
									<th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 150px; text-align: center;" > @{{ entry.name }} 
									</th>
								</tr>
							</tbody>
						</table>
					</div><!--#dataTableDiv -->
				</div><!--.table-scrollable -->
			</div><!--.datatable -->
		</div><!--.col-10 -->
	</div><!--.row -->
</div><!--.container -->
