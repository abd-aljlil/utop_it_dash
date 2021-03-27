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

                <h1 class="page-title text-center" style="color: #014260">Contact us
                    <small></small>
                </h1>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <h3>Send an email</h3>

            </div>
            <div class="panel-body voulnteer">
            @if(isset($success))
            <div class="alert alert-success">
  Sent successfully.
</div>@endif
                <div class="row">
                  <!-- left column -->
                  <!-- edit form column -->
                  <div class="col-md-9 personal-info" id="grid">

                    <div class="row">
                        <form class="form-horizontal" role="form" method="POST" action="Contact_us">
                         @csrf
                         <div class="form-group">
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-8">
                                <input id="english_name" name="english_name" type="hidden" class="form-control{{ $errors->has('english_name') ? ' is-invalid' : '' }}" value="{{auth()->user()->english_name }}" >
<input id="name" name="name" type="text" class="form-control{{ $errors->has('english_name') ? ' is-invalid' : '' }}" value="{{auth()->user()->english_name }}" disabled>
                            </div>     
                        </div>

                        <input id="level" name="level" type="hidden" value="{{auth()->user()->level }}"  >

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                                <input id="email" type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{auth()->user()->email  }}"  >
<input id="student-email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="student-email" value="{{auth()->user()->email  }}" disabled >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-lg-3 control-label">Title:</label>

                            <div class="col-md-8">

                              <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" required>
                                <option value="Technical"> Technical Problem - مشكلة تقنية </option>
                                <option value="Student_Affairs">Inquiries related to your interactive group - 
استفسارات متعلقة بالمجموعة الدراسية</option>
                                <option value="Exams">Exams Inquiries - استفسارات الامتحان باستخدام كود الامتحان</option>
                                <option value="Suggestions">Suggestions and complaints - شكاوي و اقتراحات</option>
                            </select>
                        </div>
                    </div>
                    @if(Auth::user()->hasRole("Student"))
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Your Group Number:</label>
                            <div class="col-lg-8">
                                <input id="group" type="text" class="form-control{{ $errors->has('group') ? ' is-invalid' : '' }}" name="group">
                           </div>
                        </div>
                        @else
                       
                                <input id="group" type="hidden" class="form-control{{ $errors->has('group') ? ' is-invalid' : '' }}" name="group" value="not provided">
                           
                         @endif
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Message:</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" rows="5" id="message" name="message" placeholder="ملاحظة: اختيار نوع المشكلة بشكل صحيح يضمن وصول رسالتك للفريق المختص - يرجى توضيح كود الامتحان أو رقم المجموعة عند الاستفسار" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                       <label class="col-md-3 control-label"></label>
                       <div class="col-md-8">
                         <input type="submit" class="btn btn-primary" value="Send">

                     </div>
                 </div>
             </form>
         </div>
     </div>






    @yield('content')
</div>
  <div class="alert alert-warning">
  <strong>Note:</strong> we will reply within 24 hours. You have to check your inbox and spam mail.
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