@extends('layouts.welcome-app')

@section('body')

<style type="text/css">
.our_group .panel-body .row .pic_gp img {
	height: 40%;
	width: 100%;
	display: block;
}

</style>

<div class="page-content-wrapper">

	<div class="page-content">

		<div class="row">
			<div class="col-lg-12 col-xs-12 col-sm-12">
				
				<h1 class="page-title text-center" style="color: #014260">Join Groups
					<small></small>
				</h1>

			</div>
		</div>

		<div class="panel our_group panel-default">
			<div class="panel-heading">
				Utopians Groups
			</div>
			<div class="panel-body text-center">
				@if ($error != null)
				<div class="row">
					<div class="alert alert-danger">
						{{$error}}
					</div>
				</div>
				@endif
				
				@if ($groups->count()==0 && $error == null)
				<div class="row">
					<div class="alert alert-info">
						Interactive groups will be activated soon. Stay tuned
					</div>
				</div>
				@endif
				
				@if ($groups->count()>0 && $error == null)
				<div class="row">
					@if (session('failed'))
					<div class="alert alert-danger">
						<b>{{ session('failed') }}</b>
					</div>
				        @endif
					<div class="alert alert-warning"><b>
						يرجى اختيار المجموعة المناسبة لك والانضمام إليها، الرجاء الانتباه لا يمكنك الانتقال إلى مجموعة أخرى بعد تثبيت الاختيار
					</b> </div>
					<div class="alert alert-warning"><b>
						أوقات جلسات المناقشة بحسب توقيت سورية
					</b> </div>
				</div>
				@endif
				<div class="row">
					@if($groups->count()>0 && $error == null)
					@foreach ($groups as $group )
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="pic_gp">
							
							<div class="desc">
								
								<div class="media">
									<div class="media-left">
										<i class="fa fa-users media-object"></i>
									</div>
									@if($group->female_only==1)
									<div class="media-body label-danger">
										<h5 class="media-heading">Females only</h5>
									</div>       
									@endif
									@if($group->female_only==0)
									<div class="media-body label-success">
										<h5 class="media-heading">Males & females</h5>
									</div>       
									@endif
								</div>
								<div class="media">
									<div class="media-left">
										<i class="fa fa-calendar fa-lg media-object"></i>
									</div>
									
									<div class="media-body label-success">
										<h5 class="media-heading">Timing: {{$group->day}} {{date('h:i a',strtotime($group->time))}}</h5>
									</div>
								</div>
								
								<!--
								@if($group->teacher_bio !='N/A')
								<div class="media">
									<div class="media-left">
										<i class="fa fa-edit"></i>
									</div>
									
									<div class="media-body label-success">
										<h5 style="font-size:x-small;"> Teacher's Bio: {{$group->teacher_bio}}</h5>
									</div>
								</div>
								@endif
								-->
								
								<form method="POST" action="{{ route('join_group') }}" id="form{{$group->id}}" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to join this group? You can\'t change it later! ');">
									{{ csrf_field() }}

									<input id="group_id" type="hidden" name="group_id"  value="{{$group->id}}" ><br>
									<button type="submit" form="form{{$group->id}}" value="JOIN" >JOIN</button>
								</form>
							</div>
						</div>
						<div class="num_gp">
							<span><a style="color:white" data-toggle="collapse" data-parent="#accordion" href="#{{$group->id}}" class="collapsed" aria-expanded="false">
        Group {{$group->group_name}} <i class="fa fa-angle-double-right"></i></a></span>
							<div id="{{$group->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
      <div class="panel-body">Teacher: {{$group->user_name}}<br>@if($group->teacher_bio !='N/A')Teacher's bio: {{$group->teacher_bio}}@endif</div>
    </div>
						</div>
						<!--<div class="num_gp">
							<span>Group {{$group->group_name}}</span>
							<p class="tooltip"><i class="fa fa-edit"></i> Teacher: {{$group->user_name}}<span class="tooltiptext">{{$group->teacher_bio}}</span></p>
						</div>-->
					</div>

					@endforeach
					@endif


				</div>
				


			</div>
		</div>

		@yield('content')
	</div>

</div>



</div>

</div>
@endsection


@extends('layouts.welcome-footer')
