@extends('layouts.welcome-app')
            @section('body')
            <style>
            .dashboard-stat.purple{
                background-color: #F1C40F;
            }
            .dashboard-stat.blue {
            background-color: #03608c;
            }
            </style>
                <div class="page-content-wrapper">
                    
                    <div class="page-content">
                        
                                <!-- BEGIN PAGE BAR -->
                                <div class="page-bar">
                                    <ul class="page-breadcrumb">
                                        <li>
                                            <a href="index.html">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Dashboard</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                            <h1 class="page-title" style="font-family:Droid Arabic Kufi"> عدد الطلاب 
                                <small>لكل مستوى من المستويات</small>
                             </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1349">20</span>
                                            </div>
                                            <div class="desc"> level1 </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="12,5"></span>30 </div>
                                            <div class="desc"> level2</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="549">20</span>
                                            </div>
                                            <div class="desc"> level3 </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number"> 
                                                <span data-counter="counterup" data-value="89"></span>60 </div>
                                            <div class="desc"> level4 </div>
                                        </div>
                                    </a>
                                </div>
                            </div><!--.row-->
                            <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->                       
                            <div class="row">
                                <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption ">
                                                    <i class="icon-share font-red-sunglo hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase" style="font-family:Droid Arabic Kufi">عدد الحضور لكل مستوى</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div id="site_activities_content" class="display-none">
                                                    <div id="site_activities" style="height: 228px;"> </div>
                                                </div>
                                                <div style="margin: 20px 0 10px 30px">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-info"> Level1: </span>
                                                            <h3>12</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-danger"> Level2: </span>
                                                            <h3>20</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-success"> Level3: </span>
                                                            <h3>5</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-warning"> Level4: </span>
                                                            <h3>0</h3>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PORTLET-->
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption ">
                                                    <i class="icon-share font-red-sunglo hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase" style="font-family:Droid Arabic Kufi"> 
                                                        Student Groups Appointment Preferences
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div id="site_activities_content" class="display-none">
                                                    <div id="site_activities" style="height: 228px;"> </div>
                                                </div>
                                                <div style="margin: 20px 0 10px 30px">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-info"> Level1: </span>
                                                            <h3>08:00AM</h3>
                                                            <h3>12:00PM</h3>
                                                            <h3>16:00PM</h3>
                                                            <h3>20:00PM</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-danger"> Level2: </span>
                                                            <h3>6:00PM</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-success"> Level3: </span>
                                                            <h3>10:00PM</h3>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                            <span class="label label-sm label-warning"> Level4: </span>
                                                            <h3>9:00AM</h3>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PORTLET-->
                                    </div>
                             </div> <!-- row-->                                                                      
                             <div class="row">
                                    <!-- BEGIN PAGE TITLE-->
                                <h1 class="page-title" style="font-family:Droid Arabic Kufi"> للطلاب 
                                    <small>معلومات عن المجموعة</small>
                                </h1>
                                <!-- END PAGE TITLE-->
                             <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-bubbles font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase" style="font-family:Droid Arabic Kufi">
                                            مجموعة الأستاذ مهند المستوى الأول
                                            </span>
                                        </div>
                                        <ul class="nav nav-tabs" style="font-family:Droid Arabic Kufi">
                                            <li class="active" >
                                                <a href="#portlet_comments_1" data-toggle="tab" > الدروس القادمة </a>
                                            </li>
                                            <li>
                                                <a href="#portlet_comments_2" data-toggle="tab"> أنشطة </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="portlet_comments_1">
                                                <!-- BEGIN: Comments -->
                                                <div class="mt-comments">
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="../assets/global/user4.jpg" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">Michael Baker</span>
                                                                <span class="mt-comment-date">26 Feb, 10:30AM</span>
                                                            </div>
                                                            <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>

                                                        </div>
                                                    </div>
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="../assets/global/user4.jpg" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">Michael Baker</span>
                                                                <span class="mt-comment-date">26 Feb, 10:30AM</span>
                                                            </div>
                                                            <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END: Comments -->
                                            </div>
                                            <div class="tab-pane" id="portlet_comments_2">
                                                <!-- BEGIN: Comments -->
                                                <div class="mt-comments">
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="../assets/global/user4.jpg" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">Michael Baker</span>
                                                                <span class="mt-comment-date">26 Feb, 10:30AM</span>
                                                            </div>
                                                            <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy. </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-comment">
                                                        <div class="mt-comment-img">
                                                            <img src="../assets/global/user4.jpg" /> </div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author">Michael Baker</span>
                                                                <span class="mt-comment-date">26 Feb, 10:30AM</span>
                                                            </div>
                                                            <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END: Comments -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                             
                             </div><!-- .row-->       
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