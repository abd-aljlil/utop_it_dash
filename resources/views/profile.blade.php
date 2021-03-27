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
                                
                                <h1 class="page-title text-center" style="color: #014260">User Profile
                                <small></small>
                                </h1>
                                
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-users"></i> <h3>Update My Data</h3>
                                
                            </div>
                            <div class="panel-body voulnteer">
                                <div class="row">
      <!-- left column -->
      
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info" id="grid">
            
            <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="profile">
               @csrf
                <div class="form-group">
                    <label class="col-lg-3 control-label">English Name:</label>
                    <div class="col-lg-8">
                        <input id="english_name" type="text" class="form-control{{ $errors->has('english_name') ? ' is-invalid' : '' }}" name="english_name" value="{{$users->english_name }}" required readonly>
                    </div>
                                @if ($errors->has('english_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('english_name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Arabic Name:</label>
                    <div class="col-lg-8">
                        <input id="arabic_name" type="text" class="form-control{{ $errors->has('arabic_name') ? ' is-invalid' : '' }}" name="arabic_name" value="{{$users->arabic_name }}" required >
                    </div>
                                @if ($errors->has('arabic_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('arabic_name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$users->email }}" required >
                    </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                @if(Auth::user()->hasRole("Teacher_Assistant"))
                <div class="form-group">
                    <label class="col-lg-3 control-label">Bio:</label>
                    <div class="col-lg-8">
                        <input id="bio" type="text" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio" value="{{$users->bio }}" required >
                    </div>
                                @if ($errors->has('bio'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                </div>
                @endif
                <div class="form-group">
                    <label class="col-lg-3 control-label">Specialization:</label>
                    <div class="col-lg-8">
                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{$users->specialization }}" required >
                    </div>
                                @if ($errors->has('specialization'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('specialization') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Birthdate:</label>
                    <div class="col-lg-8">
                        <input id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" value="{{$users->birthdate }}" required >
                    </div>
                                @if ($errors->has('birthdate'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Country:</label>
                    <div class="col-lg-8">
                        <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{$users->country }}" required >
                    </div>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                </div>
                
                <div class="form-group">
                    <label class="col-lg-3 control-label">City:</label>
                    <div class="col-lg-8">
                        <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{$users->city }}" required >
                    </div>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                </div>
@if(Auth::user()->hasRole("Students"))
                <div class="form-group">
                    <label class="col-lg-3 control-label">Group Type Desired:</label>
                    <div class="col-lg-8">
                        <select id="preferred_time" class="form-control{{ $errors->has('preferred_time') ? ' is-invalid' : '' }}" name="preferred_time" value="{{$users->preferred_time }}" >
 <option value="إناث فقط"
    @if($users->preferred_time== "إناث فقط")
        selected="selected"
    @endif>إناث فقط</option>
    <option value="مختلط" 
    @if($users->preferred_time== "مختلط")
        selected="selected"
    @endif
    >مختلط</option>
    <option value="0" 
    @if($users->preferred_time== "0")
        selected="selected"
    @endif
    >Not a student</option>
                        </select>
                    </div>
@endif
                                @if ($errors->has('preferred_time'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('preferred_time') }}</strong>
                                    </span>
                                @endif
                </div>

               <div class="form-group">
                 <label class="col-md-3 control-label"></label>
                 <div class="col-md-8">
                   <input type="submit" class="btn btn-primary" value="Save Changes">

               </div>
           </div>
       </form>
                                </div>
                                
                        </div>
                        
                        
                        
                        @yield('content')
                    </div>
                    
                </div>  </div>
                 <!--new section for certificates-->
                 @if(Auth::user()->hasRole("Students"))
        <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-trophy"></i> <h3>My Certificates</h3>
    </div>
    <div class="panel-body voulnteer">
      <div class="row" style="text-align: left; padding-left: 5%;">
          
@foreach($user_courses as $course) 
       <p><i class="fa fa-arrow-right"></i> <a href="https://certificates.utopians-edu.org/certificate.php?id={{$users->id}}&course_id={{ $course->course_id }}" target="_break">{{ $course->course_id }}th course certificate <i class="fa fa-file"></i></a></p>
       @endforeach
      @if($user_courses->count()==0)
      <p>There is no published certificated for you yet</p>
      @endif
   </div>
  

</div>

</div> @endif
<!--end certificates section-->
                
                
          
            
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