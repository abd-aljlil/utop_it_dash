@extends('layouts.welcome-app')

@section('body')
<div class="page-content-wrapper">

	<div class="page-content">

		<div class="row">
			<div class="col-lg-12 col-xs-12 col-sm-12">
				<div class="page-bar">

					<div class="page-toolbar">
						<ul class="page-breadcrumb">
							<li>
								<span>certificate</span>

							</li>
							<li>
								<span></span>
							</li>
						</ul>
					</div>
				</div>

				<h1 class="page-title text-center" style="color: #014260">
					<small>print certifiacte</small>
				</h1>

			</div>
		</div>
		<style>
			.cer-bg{
				background: url({{ asset('assets/certificate-bg.jpg') }});
background-repeat: no-repeat;
background-size: cover;
min-height:747px;
}
.heading{
	padding-top:190px;
	font-size: 45px;
	color:#014260;
	font-weight: bold;
}

.text-upper{
	text-transform:uppercase;
}
.text-blue{color:#014260;}
.text-bold{font-weight: bold;}
.name-b:after{
	content:'';
	position:absolute;
	left:35%;
	width:337px;
	height:1px;
	background:#d8d8d8;
	top: 46px;
}
.name-b{position:relative}
.text-sem-bold{font-weight: 500;}
@media (max-width:1024px){
	.cer-bg{background-size: contain;min-height:527px}
	.heading{padding-top:63px;font-size: 29px;}
	.text-blue{    font-size: 22px;}
	.name-b:after{left: 27%;}
}
@media (max-width:475px){
	.cer-bg{min-height:300px}
	.heading{padding-top:36px;font-size: 14px;}
	.name-b{font-size: 14px;}
	.text-blue{    font-size: 12px;}
	h1,h2{margin-top:0 !important}
	.name-b:after{
		top: 18px;
		left: 20%;
		width: 235px;

	}
}
@media (max-width:375px){
	.heading {
		padding-top: 20px;
		font-size: 11px;
	}
	.text-blue {
		font-size: 11px;
	}
}
.thead-dark{
	background: #014260;
	color: #fff;
}
.table{color:#014260;}

</style>
<div class="row">
	<form action="{{('Post_Cert')}}" method="post">
		{{csrf_field()}}
		<button type="submit" class="btn south-btn" target="_blank">print</button>
	</form>
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="cer-bg text-center">
			
			<h1 class="heading">CETIFICATE OF COMPLETION</h1>
			<h2 class="text-upper text-blue">this certificate is awarded to</h2>
			<h1 class="text-upper text-bold name-b">{{$user->english_name}}</h1>
			<h2 class="text-upper text-blue text-sem-bold">
				FOR SUCCESSFULLY COMPLETING Level
				@if(auth()->user()->level==1)
				<span>A1</span>
				@endif
				@if(auth()->user()->level==2)
				<span>A2</span>
				@endif
				@if(auth()->user()->level==3)
				<span>A2-B1</span>
				@endif
				@if(auth()->user()->level==4)
				<span>B1</span>
				@endif
				@if(auth()->user()->level==5)
				<span>B2</span>
				@endif
				@if(auth()->user()->level==6)
				<span>C1</span>
				@endif
				
			</h2>
			<h2 class="text-upper text-blue text-sem-bold">
				AT UTOPIANS ON {{ $current_course->end_date }}						
			</h2>
			<h2 class="text-upper text-blue text-sem-bold">
				WITH A SCORE OF: {{ $total}}				
			</h2>
		</div>
	</div>
</div>
<div class="row ">
	<div class="table-responsive col-md-8 "> 
		<h3 class="text-blue ">
			Dear student,
			Please find below a breakdown of your final grade
		</h3>
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th></th>
					<th>Max. Mark  </th>
					<th>Received Mark</th>	
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Participation</td>
					<td>40</td>
					<td>{{$participation}}</td>	
				</tr>
				<tr>
					<td>Interview</td>
					<td>10</td>
					<td>{{$interview_average}}</td>	
				</tr>
				<tr>
					<td>Midterm exam</td>
					<td>25</td>
					<td>{{$midterm_test_mark}}</td>	
				</tr>	
				<tr>
					<td>Final exam</td>
					<td>25</td>
					<td>{{$final_test_mark}}</td>	
				</tr>	
				<tr>
					<td>Overall score </td>
					<td>100</td>
					<td>{{$total}}</td>	
				</tr>
				
			</tbody>						
		</table>
	</div>
</div>
</div>

@endsection
@extends('layouts.welcome-footer')
@section('content')
<!-- END DASHBOARD STATS 1-->
<div class="portlet light">

	<div class="portlet-body pull-right">

	</div>
</div>
<div class="portlet  bordered ">
	<div class="portlet-body">
		<div class="tiles">
			<div class="row">

			</div>

		</div>
	</div>
</div>
@endsection