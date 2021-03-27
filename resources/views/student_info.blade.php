<meta name="_token" content="{{ csrf_token() }}">
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

                <h1 class="page-title text-center" style="color: #014260">Search depending on ID 
                    <small>.......</small>
                </h1>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                 <h3>Please enter student id </h3>

            </div>
            <div class="panel-body voulnteer">
                <div class="row">

                  <div class="col-md-9 personal-info" id="grid">

                    <div class="row">
                        <div class="col-xs-7">

                            <div class="form-group">

                                <input type="text" class="form-controller" id="search" name="search">

                            </div>
                        </div>                        

                    </div>

                  <div class="search-result">
                  </div>
                </div>



                @yield('content')
            </div>

        </div>



    </div>

</div>
       <script type="text/javascript">
 
            $('#search').on('keyup',function(){
               
            $value=$(this).val();

            $.ajax({

                type : 'get',

                url : '{{URL::to('search')}}',

                data:{'search':$value},

                success:function(data){

                $('.search-result').html(data);

                }

            });



            })

        </script>
        <script type="text/javascript">
 
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script>
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