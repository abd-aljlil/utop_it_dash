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
                                <span>@yield('title')</span>

                            </li>
                            <li>
                                <span></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <h1 class="page-title text-center" style="color: #014260">Weekly Discussions
                    <small></small>
                </h1>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users"></i> <h3>My Sessions</h3>

            </div>
            <div class="panel-body voulnteer">
                <div class="row">
                  <!-- left column -->


                  <!-- edit form column -->
                  <div class="col-md-9 personal-info" id="grid">

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover" style="table-layout: auto; width: 100%;">
                                <tbody>
                                    <thead>
                                        <tr class="warning">
                                            <th >Session</th>
                                            <th >Group Name</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Telegram Link</th>
                                        </tr>
                                    </thead>
                                    @foreach($groups as $group)

                                    <tr>
                                        <th>{{ $group->name }}</th>
                                        <td>{{ $group->group_name }}</td>
                                        <td>{{ $group->day }}</td>
                                        <td>{{ date('h:i a', strtotime($group->time)) }}</td>
                                        <td><a href="{{ $group->link }}" target="_blank"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <!--<div class="row">
                       <form action="withdraw" method="get" onsubmit="return confirm('هل أنت متأكد أنك تريد الانسحاب؟ قد لا تجد مقاعد فارغة في المجموعات الأخرى!!');">
                            <div class="form-group">
                               <label class="col-md-3 control-label"></label>
                               <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" value="انسحاب من المجموعة">

                             </div>
                         </div>
                     </form>
                 </div>-->

                </div>



                @yield('content')
            </div>

        </div>
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