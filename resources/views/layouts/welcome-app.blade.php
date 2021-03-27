<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Utopians</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ URL::asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ URL::asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="css/vue.css" type="text/javascript"></link>
    <link rel="icon" href="utopians-edu.org/logo.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="utopians-edu.org/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- END THEME LAYOUT STYLES -->
    
    <link href="{{ URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ URL::asset('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css"></link>
    <link href="css/custom.css" rel="stylesheet" type="text/css" />


    <link href="{{ URL::asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <!-- STYLES FOR USER MENU ADDED:15-5-2018 -->

    <link href="{{ URL::asset('assets/global/css/edit-responsive-header.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <!-- STYLES FOR header buttons relocation ADDED:7-2018 -->
    <style>.page-header.navbar .menu-toggler>span, .page-header.navbar .menu-toggler>span:after, .page-header.navbar .menu-toggler>span:before {

    height: 5px; color:grey;}</style>
    
</head>
@yield('style')
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md ">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a>
                        <img src="../utopians_dashboard/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                        <div  class="menu-toggler sidebar-toggler">
                            <span> </span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a id="responsive-toggler-1" href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse" >
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            @if( Auth::user())
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-bell"></i>
                                    @if(auth()->user()->unreadNotifications->count())
                                    <span class="badge badge-default">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu notify-drop">
                                    <li class="external">
                                        <h3>
                                            <span class="bold"></span> notifications</h3>
                                            <a href="markRead">Mark all as Read</a>
                                        </li>
                                        <li>
                                            <ul class="dropdown-menu-list scroller drop-content" data-handle-color="#637283">
                                                @foreach(auth()->user()->unreadnotifications as $notification)
                                                <li>
                                                    <a href={{ $notification->data["link"] }} >
                                                        <span class="details">
                                                            <span class="time">{{ $notification->created_at->format('Y-M-d') }}</span>
                                                            <span class="label label-sm label-icon label-{{ $notification->data["label"] }}">
                                                                <i class="fa fa-{{ $notification->data["icon"] }}"></i>
                                                            </span> {{ $notification->data["Message"] }}

                                                        </span>
                                                    </a>
                                                </li>
                                                @endforeach

                                                @if(auth()->user()->unreadNotifications->count()==0)
                                                <li>
                                                    <a role="button" href="" >
                                                        <span class="details">

                                                            Wow..There is no unread notifications

                                                        </span>
                                                    </a>
                                                </li>
                                                @endif

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                <!-- END NOTIFICATION DROPDOWN -->
                                <li class="dropdown dropdown-user" style="width: 10px important!">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span class="username username-hide-on-mobile"> </span>
                                        <i class="fa fa-user"></i><i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">

                                        @if( Auth::user())
                                        <li>
                                            <a class="dropdown-item" href="profile">
                                                Profile <i class="fa fa-file"></i></a>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>

                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                            <i class="icon-logout"></i></a>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </li>
                                    
                                    @else
                                    <li class="float-right text-right">
                                        <a href="login">
                                            <i class="icon-calendar pull-right"></i> تسجيل الدخول </a>
                                        </li>
                                        <li class="float-right text-right">
                                            <a href="register">
                                                <i class="icon-user pull-right"></i> مستخدم جديد </a>
                                            </li>
                                            @endif

                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                    <div class="clearfix"> </div>

                    <div class="page-container">

                        <div class="page-sidebar-wrapper">

                            <div class="page-sidebar navbar-collapse collapse">

                                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

<!--href="/utopians_dashboard{{ asset('home') }}"-->
                                 <li class="nav-item start active open">
                                    <a href="{{ asset('home') }}" class="nav-link nav-toggle">
                                        <i class="icon-home"></i>
                                        <span class="title">Home Page</span>
                                        <span class="selected"></span>
                                        <span class="arrow open"></span>
                                    </a>
                                    
                                </li>

                                

                                @if(Auth::user()->hasRole("Student_Resources") || Auth::user()->hasRole('SysAdministrator'))
                                <li class="heading">
                                    <h3 class="uppercase">index</h3>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Students</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @if(Auth::user()->hasRole("Student_Resources") || Auth::user()->hasRole('SysAdministrator'))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('User_Marks') }}" class="nav-link ">

                                                <span class="title">Students Marks</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Announcement') }}" class="nav-link ">

                                                <span class="title">Announcements Management</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @if(Auth::user()->hasRole("Student_Resources") || Auth::user()->hasRole("Exam_Management"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Student_Info') }}" class="nav-link ">
                                                <span class="title">Student Info</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                        
                                        
                                    </ul>                                 
                                </li>
                                @endif

                                @if(Auth::user()->hasRole("Student_Resources") || Auth::user()->hasRole("Teacher_Assistant") || Auth::user()->hasRole("Students"))
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Interactive Groups</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @if(Auth::user()->hasRole("Student_Resources"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Group_User') }}" class="nav-link ">
                                                <span class="title">Groups Management</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::user()->hasRole("Teacher_Assistant"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Group_Timing') }}" class="nav-link ">
                                                <span class="title">Groups and Students</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::user()->hasRole("Student_Resources") || Auth::user()->hasRole("Students"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('My_Group') }}" class="nav-link ">
                                                <span class="title">My Group</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif

                                @if(Auth::user()->hasRole("SysAdministrator")||Auth::user()->hasRole("Student_Resources"))
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Users</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('User_Manag') }}" class="nav-link ">
                                                <span class="title">Manage Users</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>   
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole("Coordinator") || Auth::user()->hasRole("Students") || Auth::user()->hasRole("Teacher_Assistant") )
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Lessons</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @if(Auth::user()->hasRole("Coordinator"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Lessons_Index') }}" class="nav-link ">
                                                <span class="title">Lessons Management</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif     
                                        @if(Auth::user()->hasRole("Students") || Auth::user()->hasRole("Teacher_Assistant"))
                                        <li class="nav-item start active open">
                                            <a href="My_Lessons" class="nav-link ">
                                                <span class="title">My Lessons</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif                                    
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole("SysAdministrator") || Auth::user()->hasRole("Student_Resources"))
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Courses</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Courses') }}" class="nav-link ">
                                                <span class="title">Manage Courses</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>   
                                    </ul>
                                </li>
                                @endif
                                
                                <!--( Auth::user()->hasRole("Students") ||  Auth::user()->email=='heba-abdulelah@hotmail.com' )
                                -->
                                @if( Auth::user()->email=='heba-abdulelah@hotmail.com' || Auth::user()->email=='abd.aljlil@hotmail.com' )
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">New Course</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Course_Register') }}" class="nav-link ">
                                                <span class="title">Register</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>   
                                    </ul>
                                </li>
                                @endif

                                @if(Auth::user()->hasRole("Exam_Management") || Auth::user()->hasRole("Students") )
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Exams</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @if(Auth::user()->hasRole("Students")|| Auth::user()->id==76 || Auth::user()->hasRole("Exam_Management") || Auth::user()->id==124)
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('ExamPage') }}" class="nav-link ">

                                                <!--<span class="title">Placement Test</span>-->
                                                <!--<span class="title">Midterm Exam</span>-->
                                                <span class="title">Final Exam</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                        @if(Auth::user()->hasRole("Students")|| Auth::user()->id==76 || Auth::user()->hasRole("Exam_Management") || Auth::user()->id==124)
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('My_Exams_Mistakes') }}" class="nav-link ">

                                                <span class="title">My Exams Mistakes</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                        @if(Auth::user()->hasRole("Exam_Management"))
                                        <li class="nav-item start active open">
                                            <a href="{{ asset('/Exam_Name_Index') }}" class="nav-link ">

                                                <span class="title">Exams Management</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                        @endif
                                        
                                    </ul>                                 
                                </li>
                                @endif





                                @php
                                /*
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">

                                        <span class="title">Indexes</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">

                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Exam_Nam" class="nav-link ">

                                                <span class="title">Exam Name</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>

                                        <li class="nav-item start active open">
                                            <a href="{{ asset('Question_Types" class="nav-link ">

                                                <span class="title">Question Types</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                */
                                @endphp
                            @if(Auth::user()->hasRole("Students")  && isset($user_joined) || Auth::user()->id==76)
                                @if($user_joined>0)
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Final Certificate</span>
                                        <span class="arrow"></span>
                                    </a>
                                    
                                    <ul class="sub-menu">
                                        <li class="nav-item start active open">
                                            <a href="https://certificates.utopians-edu.org/certificate.php?id={{Auth::user()->id}}&course_id=7" target="_blank" class="nav-link ">
                                                <span class="title">Show My Course Results</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            @endif
                              
                                
                                
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Contact us</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start active open">
                                            <a href="Contact_us" class="nav-link ">
                                                <span class="title">Contact Form</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                               
                            </ul>


                        </div>
                    </div>
                    @yield('body')
                </div>

            </div>