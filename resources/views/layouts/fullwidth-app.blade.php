<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>شركة لوكستر</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ URL::asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ URL::asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="css/vue.css" type="text/javascript"></link>
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="{{ URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ URL::asset('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
      
        <link href="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css"></link>
         <!--  CHANGE THEME COLOR TO UTOPIANS THEME COLORS -->
        <link href="css/custom.css" rel="stylesheet" type="text/css" />
        <!-- Custom CSS For fullwidth page -->
        <link href="css/fullwidth-custom.css" rel="stylesheet" type="text/css" />
        
        <link href="{{ URL::asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
       
        
        
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
                        <a href="/">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                        <div  class="menu-toggler sidebar-toggler">
                            <span > </span>
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
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"> قائمة المستخدم </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    
                                    @if( Auth::user())
                                    <li>
                                        <a href="\logout">
                                        <i class="icon-logout"></i> تسجيل الخروج </a>
                                    </li>
                                    
                                    @else
                                    <li>
                                        <a href="\login">
                                        <i class="icon-calendar"></i> تسجيل الدخول </a>
                                    </li>
                                    <li>
                                        <a href="\register">
                                        <i class="icon-user"></i> مستخدم جديد </a>
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
                    
                </div>
                
                <div class="page-content-wrapper">
                    
                    <div class="page-content">
                        
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                <div class="page-bar">
                                    
                                    <div class="page-toolbar">
                                        <ul class="page-breadcrumb">
                                            <li>
                                                <span>@yield('title')</span>
                                                <i class="fa fa-circle"></i>
                                            </li>
                                            <li>
                                                <span>Home Page</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <h1 class="page-title pull-right"> Utopians Dashboard
                                <small>.......</small>
                                </h1>
                                
                            </div>
                        </div>
                        @yield('content')
                    </div>
                    
                </div>
                
                
                
            </div>
            
        </div>
        
        <script src="{{ URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="js/vue.js" type="text/javascript"></script>
       
        <script src="js/axios.min.js" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
            $('#menu-toggler').trigger('click');
        </script>
        @yield('scripts')

    </body>
</html>
