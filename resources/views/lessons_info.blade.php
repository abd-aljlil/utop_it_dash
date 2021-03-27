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

                <h1 class="page-title text-center" style="color: #014260">My Lessons
                    <small></small>
                </h1>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
  <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/YJyIP3uzg8w"></iframe>
  </div>
            </div>
            
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users"></i> <h3>Lessons & Homework</h3>

            </div>
            <div class="panel-body voulnteer">
                <div class="row">
                  <!-- left column -->


                  <!-- edit form column -->
                  <div class="col-md-9 personal-info" id="grid">

                    <div class="row">
                        <div class="container">
                            <table class="table table-hover" style="table-layout: auto; width: auto;">
                                <tbody>
                                    <thead>
                                        <tr class="success">
                                            <th>Lesson No.</th>
                                            <th>Published on</th>
                                            <th>Files</th>
                                            
                                        </tr>
                                    </thead>
                                    @foreach($lessons as $k => $v)
                                    <tr>
                                        <th>
                                            {{$v->name}}
                                        </th>
                                        <td>
                                            {{ date('d-M-Y', strtotime($v->date)) }}
                                        </td>
                                        <!--<td><a href="lesson_files\{{ $v->id }}" target="_blank">Files <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></td>-->
                                        <td>   
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Files List
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <!--<li class="dropdown-header">Dropdown header 1</li>-->
                                                  @foreach($files as $key => $value)
                                                  @if($v->id == $value->id)
                                                  <li>
                                                    <a class="dropdown-item" target="_blank" href="/utopians_dashboard/uploads/lessons_files/{{ $value->file }}"><i class="fa fa-file" aria-hidden="true"></i> View file</a>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($lessons->count()==0)
                                <tr class="warning"><td colspan="3"><center>No Current Units</center></td></tr>
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                </div>
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