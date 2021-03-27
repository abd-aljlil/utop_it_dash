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

                <h1 class="page-title text-center" style="color: #014260">Course Enrollment 
                    <small></small>
                </h1>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-check"></i> <h3> Step 1: Rules and Obligations</h3>

            </div>
            <div class="panel-body voulnteer">
              @if(isset($success))
              <div class="alert alert-success">
                  {{ $success }} <i class="fa fa-thumbs-up" aria-hidden="true"></i>
              </div>
              @endif
              <!-- Sorry you can't register now. Enrollment has been closed for this course! wish to see you next course!
               <p></p></br>
                نعتذر ! انتهت فترة التسجيل! نراك الدورة القادمة
               -->
              @if($user_course_count >= 1500 && !isset($success))
               <div class="alert alert-danger">
                 All seats are reserved for today! Please try tomorrow.
               <p></p></br>
               انتهت المقاعد المخصصة لهذا اليوم. حاول التقدم مجدّداً غداً.
              </div>
              @endif
              @if($user_course_count < 1500)
              @if(!isset($success))
              <div class="row">
                  <!-- left column -->
                  <!-- edit form column -->
                  <div class="col-md-9 personal-info" id="grid">

                    <div class="row">
                     <form class="form-horizontal" role="form" method="POST" action="{{('Course_Join')}}" style="padding-left:20%;text-align: left">
                        {{csrf_field()}}
                        <div class="checkbox">
                            <label><input type="checkbox" required>I can commit for at least 6 hours a week.</label></br>
                            <strong>.بإمكاني أن ألتزم ست ساعات أسبوعياً على الأقل</strong>
                        </div></br>
                        <div class="checkbox">
                            <label><input type="checkbox" required>I can attend sessions, participate in discussions, and guarantee that I am never absent unless I have a good excuse. </label></br>
                            <strong>.بإمكاني حضور الجلسات والمشاركة وتقديم الامتحانات وعدم التغيب إلا بعذر</strong>
                        </div></br>
                        <div class="checkbox">
                            <label><input type="checkbox" required>I understand that any absences could negatively impact my grade.</label></br>
                            <strong>.أتفهم أن عدم المشاركة في جلسات المناقشة ستؤثر سلباً على درجاتي</strong>
                        </div>
                        
                        <center><input type="submit" class="btn btn-primary" value="Register"></center>

                    </form>
                </div>
            </div>

            @yield('content')
        </div>
        @endif
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-check"></i> <h3>Step 2: Placement Test (English level assessment) اختبار تحديد المستوى  </h3>
    </div>
    <div class="panel-body voulnteer">
        @if($placement_done >0)
      
          <!-- left column -->
          <!-- edit form column -->
 <div style="text-align: left;">
If you are a new student, when you complete step 1, you will receive a placement test icon. Click on the Exam tab and enter the code. After completing the test, your course level will be decided according to your score.
If you are a returning student who took the sixth course, your course level will be decided according to your final score in the sixth course.
</div></br>
<div style="text-align: right;">

إذا كنت طالباً مستجداً فعند التسجيل في الدورة سيصلك رمز اختبار تحديد المستوى ،انقر على تبويب الامتحان وقم بإدخال الرمز، بعد الانتهاء من الامتحان سيتم تحديد المستوى المتوافق مع نتيجتك.

أما إذا كنت طالباً في الدورة السادسة سيتم تحديد مستواك وفق نتيجتك النهائية في الدورة السادسة
</div></br>
        <div class="alert alert-success">
          This step is completed <i class="fa fa-thumbs-up" aria-hidden="true"></i>
      </div>@else
      <div class="row" style="padding-right:5%;padding-left:5%">
          <!-- left column -->
          <!-- edit form column -->
 <div style="text-align: left;">
If you are a new student, when you complete step 1, you will receive a placement test icon. Click on the Exam tab and enter the code. After completing the test, your course level will be decided according to your score.
If you are a returning student who took the fifth course, your course level will be decided according to your final score in the fifth course.
</div></br>
<div style="text-align: right;">

إذا كنت طالباً مستجداً فعند التسجيل في الدورة سيصلك رمز اختبار تحديد المستوى ،انقر على تبويب الامتحان وقم بإدخال الرمز، بعد الانتهاء من الامتحان سيتم تحديد المستوى المتوافق مع نتيجتك.

أما إذا كنت طالباً في الدورة الخامسة سيتم تحديد مستواك وفق نتيجتك النهائية في الدورة الخامسة
</div></br>
          <div class="col-md-9 personal-info" id="grid">

            <div class="row" style="text-align: center;">
             

             <a href="Exam" class="btn btn-success" role="button" aria-pressed="true">Go to the test <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
         </div>
     </div>

     @yield('content')
 </div>

 <br>
 <div class="alert alert-warning">

  <strong>Note:</strong> we will send your result immediately after you complete the test. You have to check your inbox and spam mail.
</div>
@endif
</div>

</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-check"></i> <h3>Step 3: Check your email and stay connected.</h3>
    </div>
    <div class="panel-body voulnteer">
      <div class="row" style="text-align: left; padding-left: 5%;">

       <p><i class="fa fa-exclamation-triangle"></i> Make sure you have typed your email correctly in order to receive messages and be able to receive all news and notifications. You can double check your email by visiting the profile icon.</p>
       
       <p><i class="fa fa-exclamation-triangle"></i> You will receive an email message when group selection is activated on the website.</p>
   
       <p><i class="fa fa-exclamation-triangle"></i> Places are limited for each group, so you must choose the suitable interactive group as soon as possible after group selection is activated.</p> 
     
       <p><i class="fa fa-exclamation-triangle"></i> After having selected the group most suited for your time, you will find a link to the interactive group on Telegram (app) by visiting the My Group tab. Join your group by clicking on the link.</p>
      
<p><i class="fa fa-exclamation-triangle"></i> Always check the ads and notifications section on the website to stay updated.</p>
     
      
<div style="text-align:right;padding-right: 5%"> <hr>
       <p>.تأكد من انك قد كتبت بريدك الالكتروني بشكل صحيح من ايقونة الملف الشخصي حتى تستلم الرسائل وتتمكن من المتابعة <i class="fa fa-exclamation-triangle"></i></p>
       <p>.ستتلقى رسالة بالبريد إلكتروني عندما يتم تفعيل اختيار المجموعات على الموقع <i class="fa fa-exclamation-triangle"></i></p>
       <p>.المقاعد لكل مجموعة محدودة فعليك اختيار المجموعة المناسبة لك في أقرب وقت بعد تفعيل المجموعات <i class="fa fa-exclamation-triangle"></i></p>
       <p>.بعد اختيارك المجموعة المناسبة لوقتك سيظهر لك رابط المجموعة التفاعلية على برنامج التلغرام عن طريق تبويب My Group، انضم من خلاله لمجموعتك <i class="fa fa-exclamation-triangle"></i></p>
       <p>.تحقق بشكل دائم من قسم الإعلانات والإشعارات على الموقع في حال حصول أي جديد <i class="fa fa-exclamation-triangle"></i></p>
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