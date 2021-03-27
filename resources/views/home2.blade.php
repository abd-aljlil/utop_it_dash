@extends('layouts.welcome-app')
@section('body')
<style>
.dashboard-stat.purple{
    background-color: #F1C40F;
}
.dashboard-stat.blue {
    background-color: #03608c;
}
.accordion {

    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: left;
    border: none;
    outline: none;
    transition: 0.4s;
    color:#95A5A6;
    font-size: 18px;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {

}

/* Style the accordion panel. Note: hidden by default */
.panel {
    padding: 18 18px;
    text-align: left;
    font-size: 15px;
    display: none;
    overflow: hidden;
}
.align-right{
text-align: right;
}
/* answers Style */
    .table{
        margin: auto;
        text-align: center;
        width: 60%;
        border: 1px solid #eee !important;
    }
    .table thead th{
        text-align: center
    }
    .answer-img{
        height: 400px;
        width: 100%
    }
    li{
        margin-top: 5px
    }

</style>
<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb caption-subject font-dark bold uppercase" >

                <li> 
                    @if(isset($user_level) && Auth::user()->hasRole("Students") )
                    <span style="font-size:20px;">Your English Level:</span>

                </li>
                <li style="background-color: #f4d7ab;">
                    @if($user_level==1)
                    <span style="font-size:20px;">A1</span>
                    @endif
                    @if($user_level==2)
                    <span style="font-size:20px;">A2</span>
                    @endif
                    @if($user_level==3)
                    <span style="font-size:20px;">A2-B1</span>
                    @endif
                    @if($user_level==4)
                    <span style="font-size:20px;">B1</span>
                    @endif
                    @if($user_level==5)
                    <span style="font-size:20px;">B2</span>
                    @endif
                    @if($user_level==6)
                    <span style="font-size:20px;">C1</span>
                    @endif
                    @endif
                </li>                   
            </ul>
        </div>
        <div class="row">
            <!-- BEGIN PAGE TITLE-->

            <!-- END PAGE TITLE-->
            <div class="col-lg-12 col-xs-12 col-sm-12" >
                <div class="col-md-8">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">Video Intro</span>
                            </div>
                        </div><!--.portlet-title-->
                        <div class="portlet-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $course->video_intro }}" height="300" allowfullscreen="false"></iframe>

                            </div>
                        </div><!--.portlet-body-->
                    </div><!--.portlet-->                
                </div><!--.col-md-8-->       
                <div class="col-md-4">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-globe font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase"></span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" class="active caption-subject font-dark bold uppercase" data-toggle="tab" aria-expanded="true">Announcements</a>
                                </li>
                                <li class="">
                                    <a href="#tab_1_2" class="caption-subject font-dark bold uppercase" data-toggle="tab" aria-expanded="false">Course Rules</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="scroller" style="overflow-y:auto;height: 339px;" data-always-visible="1" data-rail-visible="0">
                                        <ul class="feeds">
                                            
                                            @foreach (DB::table('announcement')->where('trash','0')->orderBy('created_at','desc')->get() as $announcement)
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2" >
                                                                <div class="desc" dir="rtl">{{ $announcement->announcement }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2" style=" float: left; width: 100px; margin-left: -100px;">
                                                        <div class="date">{{ date("d-m-Y", strtotime($announcement->created_at)) }}</div>
                                                    </div>
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <div class="scroller" style="overflow-y:auto;height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="feeds" style="direction: rtl;">
                                            <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">يجب على جميع المنتسبين للمبادرة من متطوعين وطلاب الالتزام بما يلي:</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                            </li>

                                              <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- اتباع نهج الحياد الإيديولوجي والسياسي والديني والعرقي، ويمنع القيام بأية أنشطة أو أعمال مخالفة أو إثارة مواضيع تتعلق بذلك.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                              
                                            </li>

                                            <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                               
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- يتمتع جميع الطلاب والمتطوعين بحرية التفكير والتعبير، في إطار كل ما هو تربوي تعليمي وكل ما يخدم هذه المبادرة.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                            </li>
                                            <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                             
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- يتم التواصل داخل المبادرة وفق مبادئ الاحترام حيث يلتزم الجميع بالابتعاد عن أي سلوك يتسم بالعنف أو كل ما من شأنه أن يتسبب بأي ضرر للغير، ويمنع التلفظ بالكلمات النابية المشينة وسيتم طرد كل من يقوم بذلك.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                               
                                            </li>
                                            <li>
                                               
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                               
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- يمنع منعاً باتاً نشر الدروس والفيديوهات الخاصة بالمبادرة في أية مجموعات أو مواقع أخرى، أو استخدامها لأغراض تجارية، تحت طائلة المسؤولية والملاحقة القانونية.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                               
                                            </li>
                                            <li>
                                             
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- في حال حصول خلاف صغير، يقوم المسؤول من قسم شؤون الطلاب بمحاولة حله، ويتم تسجيل المشكلة ورفعها للإدارة بعد توجيه إنذار للطالب المخطئ، أما في حال حصول خلاف كبير وخلق أسباب الفوضى أو المساهمة في ذلك، فيعاقب عليها بالتوقيف عن الدراسة بشكل نهائي.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                               
                                            </li>
                                            <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- يعاقب بالفصل فوراً من الدراسة والحظر من موقع وجميع صفحات المبادرة كل من حاول بشكل مباشر أو غير مباشر إهانة أحد زملائه أو أستاذه أو أي شخص آخر من الكادر التطوعي، أو من ساعد على ذلك.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                            </li>
                                            <li>
                                                
                                                    <div class="">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">- على الطلاب احترام الضوابط التنظيمية للدراسة والمتابعة المستمرة للاختبارات ومختلف الأنشطة.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END TABS-->
                        </div><!--.portlet-body-->
                    </div> <!--.portlet-->             
                </div><!-- .col-md-4-->
            </div>                             
        </div><!-- .row-->
        <!-- BEGIN : STEPS -->

        <div class="row">
            @if(Auth::user()->hasRole("Students"))
            <div class="col-md-8">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">My shortcuts</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-element-step">
                            <div class="row step-default">

                                <a href="My_Group">    
                                    <div class="col-md-4 bg-grey mt-step-col">
                                        <div class="mt-step-number bg-white font-grey">1</div>
                                        <div class="mt-step-title  font-grey-cascade">My Group</div>
                                        <div class="mt-step-content font-grey-cascade">Check out your group information</div>
                                    </div>
                                </a>
                                <a href="Latest_Lesson">
                                    <div class="col-md-4 bg-grey mt-step-col active" style="background-color: #32c5d2!important;">
                                        <div class="mt-step-number bg-white font-grey">2</div>
                                        <div class="mt-step-title font-grey-cascade">Newest Lesson</div>
                                        <div class="mt-step-content font-grey-cascade">Check out the most recent lesson</div>
                                    </div>
                                </a>
                                <a href="Previous_Lesson">
                                    <div class="col-md-4 bg-grey mt-step-col ">
                                        <div class="mt-step-number bg-white font-grey">3</div>
                                        <div class="mt-step-title  font-grey-cascade">Last Lesson</div>
                                        <div class="mt-step-content font-grey-cascade">Check out the answer key</div>
                                    </div>
                                </a>                                                                                    
                            </div>   
                        </div>                        
                    </div>            
                </div><!-- .col-md-8 -->  
            </div> <!-- END Steps -->  
            @endif
            <div class="col-md-4">
                <div class="portlet-body">
                    <div class="mt-element-list">
                        <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                            <div class="list-head-title-container">
                                <div class="list-date"></div>
                                <h3 class="list-title">Course Calendar</h3>
                            </div>
                        </div>
                       
                        <div class="mt-list-container list-simple ext-1">
                            <ul style="font-size:10px;">
                                <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <i class="icon-check"></i>
                                    </div>
                                    <div class="list-datetime">{{ $course->start_date }}</div>
                                    <div class="list-item-content">
                                        <h3 class="">
                                            <a href="javascript:;">{{ $course->name }} Begins</a>
                                        </h3>
                                    </div>
                                </li>
                                <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <i class="icon-check"></i>
                                    </div>
                                    <div class="list-datetime">{{ $course->mid_term_test_date }}</div>
                                    <div class="list-item-content">
                                        <h3 class="">
                                            <a href="javascript:;">Midterm Exam</a>
                                        </h3>
                                    </div>
                                </li>
                                <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <i class="icon-check"></i>
                                    </div>
                                    <div class="list-datetime">{{ $course->final_test_date }}</div>
                                    <div class="list-item-content">
                                        <h3 class="">
                                            <a href="javascript:;">Interviews & final Exam</a>
                                        </h3>
                                    </div>
                                </li>
                                <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <i class="icon-check"></i>
                                    </div>
                                    <div class="list-datetime">{{ $course->end_date }}</div>
                                    <div class="list-item-content">
                                        <h3 class="">
                                            <a href="javascript:;">{{ $course->name }} Ends</a>
                                        </h3>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>            
            </div><!-- .col-md-4 -->  
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" fa fa-question-circle font-green"></i>
                            <span class="caption-subject font-green bold uppercase">FAQ</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="">
                            <div class="row step-default">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " href="#English" role="tab" data-toggle="tab">English</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="#Arabic" role="tab" data-toggle="tab">الأسئلة الشائعة</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                 <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade" id="English" style="background-color:transparent;">
                                        <button class="accordion align-left" ><li>  How is the learning process accomplished?    </li></button>
                                        <div class="panel align-left" style="display:block;">
                                            <ul class="list-unstyled">
                                                <li>  1-    Lessons are published on the website     </li>
                                                <li>    2-  Students download their lessons to study them and listen to the audio files attached to the lesson’s main file. </li>
                                                <li>    3-  Students are required to attend lesson discussions in the interactive groups.</li>
                                                <li>    4-  Discussion is made through voice and typed messages on Telegram. </li>
                                            </ul>
                                        </div>

                                        <button class="accordion align-left"><li>Which English language levels are covered in the courses as per the results of the assessment test?  </li></button>
                                        <div class="panel align-left">
                                            <p>  Each course is divided into six levels. The Interchange book series is used in beginner and intermediate levels, while the Passages book series is used in high-intermediate and advanced levels as follows:  </p>
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr class="info">
                                                        <th>Level Test Result </th>
                                                        <th>Level  </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>0% – 46%</td>
                                                        <td>A1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>48% – 58%</td>
                                                        <td>A2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>60% – 70%</td>
                                                        <td>A2-B1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>72% – 82%</td>
                                                        <td>B1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>84% – 94%</td>
                                                        <td>B2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>96% - 100%</td>
                                                        <td>C1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <button class="accordion align-left"><li>   Why Interchange and Passages?  </li></button>
                                        <div class="panel align-left">
                                            <p> The Interchange series is one of the best English curricula for adult and young-adult learners from the beginning to the high-intermediate level. It is a four-level series that provides comprehensive coverage of learning skills (grammar, vocabulary, reading, writing, speaking and listening) with a focus on listening and practical speaking skills in American English.  </p>
                                            <p>This curriculum is followed by Passages, which covers the fifth and sixth levels. Thus, both curricula provide a series of six levels that transforms students from beginners to advanced English learners.</p>
                                        </div>
                                        <button class="accordion align-left"><li>   Where can I find what my level is?    </li> </button>
                                        <div class="panel align-left">
                                            <p> In the upper-left corner of the home page  </p>
                                            <img class="" src="{{URL::asset('/assets/layouts/layout/img/answer.png')}}" height="90px" width="400px">
                                        </div> 
                                        <button class="accordion align-left"><li>   How many lessons are published per week?     </li></button>
                                        <div class="panel align-left">
                                            <p> One lesson is published every Saturday </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>Where will discussions take place in the interactive groups (interactive classes)? </li> </button>
                                        <div class="panel align-left">
                                            <p>   Discussions are conducted remotely using Telegram chat groups  </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>  Can I request a makeup lesson if circumstances prevented me from attending? </li> </button>
                                        <div class="panel align-left">
                                            <p>Yes, a student can request makeup lessons four times, provided that s/he submits her/his request to the Students Affair departments through the Contact Us page within 24 hours after the end of the discussion s/he missed.  </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>   What if a student has an inquiry or a question? </li> </button>
                                        <div class="panel align-left">
                                            <h4>If the question is related to the course content: </h4>
                                            <p>Any question related to the lesson and its content should be asked during the discussion session in the interactive group.</p>
                                            <h4> If the question is related to regulatory and administrative matters: </h4>
                                            <p> In the “Contact Us” page, you can find the accounts of those in charge of answering your questions and helping you with any problem you may encounter. 
                                                Select the required department and send your inquiry. You should receive a response by email within 24 hours. 
                                            </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li> How many absences is a student allowed? </li> </button>
                                        <div class="panel align-left">
                                            <p> A student is not allowed to be absent for more than half the number of sessions for each semester. Levels 1-4 comprise 16 lessons divided over two semesters (8*8). Levels 5 and 6 comprise 12 lessons divided over two semesters (6*6). </p>
                                            <p>A student is not allowed to be absent for the first three sessions, and in case one of these was missed, the student will be contacted and notified of this and then expelled from the course if s/he did not respond. </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li> What if a student exhausts the number of allowed absences?  </li> </button>
                                        <div class="panel align-left">
                                            <p> The student is first contacted and notified that s/he must attend the discussions, and in case s/he exhausts the number of allowed absences, her/his account on the website gets suspended and s/he is removed from the interactive group.  </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>   Is it important to attend discussions?  </li></button>
                                        <div class="panel align-left">
                                            <p>Indeed it is, there is a grade for participation, and it isn’t enough to be online—a student must participate during the session.  </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li> Can I find out the right and wrong answers after taking the exam? </li></button>
                                        <div class="panel align-left">
                                            <p>After taking the exam, you can view the correct answers for your wrong ones by visiting My Exams Mistakes in the Exams tab.  </p>
                                        </div>
                                        <button class="accordion align-left"><li>   How can a student attend the makeup class?  </li></button>
                                        <div class="panel align-left">
                                            <ul>
                                                <li>    After selecting the suitable time for the makeup class, the student will receive a notification and an email message stating that the interactive group has been changed temporarily. The student joins the temporary group by visiting the Telegram link found through visiting the My Group tab.  </li>
                                                <li>    The student must leave the temporary group (Telegram) as soon as the makeup lesson ends.   </li>
                                            <img class="" src="{{URL::asset('/assets/layouts/layout/img/session.png')}}" width="100%" height="auto">
                                            </ul>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>What is the minimum final score for passing the course and moving to the next level? </li> </button>
                                        <div class="panel align-left">
                                            <p> In order to move to the next level, a student should be dedicated throughout the course and achieve a final score of at least 70/100. In case a dedicated student scores 67, 68 or 69, the administration will grant her/him three extra marks.  </p>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>Are there certificates upon completing every level?  </li> </button>
                                        <div class="panel align-left">
                                            <ul>
                                                <li>    At the end of the course, every student receives an attendance certificate from Utopians, stating that s/he has passed the level, provided that the student was committed to attending lessons, studying and taking all exams, and achieved a final score of at least 70/100. </li>
                                                <li>    Utopians will also give the top five students certificates of appreciation. </li>
                                                <li>    Completion certificates can be viewed at the end of the course by visiting the Final Certificate tab. </li>
                                            </ul>
                                        </div>
                                        
                                        <button class="accordion align-left"><li>How is the final score calculated?     </li> </button>
                                        <div class="panel align-left">
                                            <ul class="list-unstyled">
                                                <li>1-   40 marks for participation and composition, distributed as follows: 
                                                    <ul>
                                                        <li>Fluency in speaking English.</li>
                                                        <li>Using correct grammar. It is acceptable if a student makes mistakes and gets corrected several times; what matters most is participation.</li>
                                                        <li>Correct pronunciation: This is seen in every word a student pronounces and how much s/he improves after the teacher corrects her/him. </li>
                                                        <li>    Overall achievement: This depends on overall participation as well as the speed and accuracy of the student’s response.  </li>
                                                        <li>    Composition skills (excluding A1 and A2): This is related to writing assignments requested by the teacher. 
                                                        Students must submit short essays based on the teacher’s instructions and in a timely manner (meeting the deadlines). </li>
                                                    </ul>
                                                </li>
                                                <li>2-  10 marks for the oral exam:  
                                                    <p> The oral exam aims to help students improve their final score and encourage them to speak English. </p>
                                                    <p> The teacher conducts short interviews with the students at the end of each course before the final exam. The duration of the oral exam is 3-10 minutes, during which students are asked general questions based on their level.</p></li>
                                                <li>3- 25 marks for the midterm exam:This exam takes place after students finish half of the course load.  </li>
                                                <li>4-25 marks for the final exam: This exam takes place after all lessons are completed. </li>
                                             </ul>
                                        </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade active in" id="Arabic" dir="rtl">
                                            <button class="accordion align-right" ><li>كيف تتم العملية التعليمية؟</li></button>
                                            <div class="panel align-right" style="display:block;">
                                                <ul class="list-unstyled" dir="rtl">
                                                    <li>  1-    يتم نشر الدروس على الموقع التعليمي    </li>
                                                    <li>    2-  تقوم بتحميل الدروس ومن ثم دراستها والاستماع للتسجيلات الصوتية الموجودة بروابط خاصة ضمن ملف الدرس الأساسي.</li>
                                                    <li>    3-      يتوجب عليك حضور المناقشة لكل درس في المجموعات التفاعلية.</li>
                                                    <li> 4- تتم المناقشة عن طريق الرسائل الصوتية والنصية باستخدام تطبيق تلغرام.</li>
                                                </ul>
                                            </div>

                                            <button class="accordion align-right"><li>ما هي المستويات الدّراسية التي تغطيها دورات المبادرة حسب نتيجة تحديد المستوى؟ </li></button>
                                            <div class="panel align-right" dir="rtl">
                                                <p> تُقسم الدورة إلى ستّة مستوياتٍ دراسيّة، ويتم تدريس سلسلة Interchange للمستوى المبتدئ حتى المتوسط وسلسلةPassages  للمستويين فوق المتوسط والمتقدم، على الشّكل التالي: </p>
                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr class="info">
                                                            <th>المستوى</th>
                                                            <th>نتيجة امتحان تحديد المستوى</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>A1</td>
                                                            <td>0 – 46 %</td>
                                                        </tr>
                                                        <tr>
                                                            <td>A2</td>
                                                            <td>48 – 58 %</td>
                                                        </tr>
                                                        <tr>
                                                            <td>A2-B1</td>
                                                            <td>60 – 70 %</td>
                                                        </tr>
                                                        <tr>
                                                            <td>B1</td>
                                                            <td>72 – 82 %</td>
                                                        </tr>
                                                        <tr>
                                                            <td>B2</td>
                                                            <td>84 – 94 %</td>
                                                        </tr>
                                                        <tr>
                                                            <td>C1</td>
                                                            <td>96 - 100 %</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button class="accordion align-right"><li>  لماذا سلسلة Interchange وسلسلة Passages؟ </li></button>
                                            <div class="panel align-right">
                                                <p>سلسلة interchange من أفضل مناهج تعليم اللغة الإنكليزية للبالغين للمستويات الأولى والمتوسطة، تحتوي على أربع مستويات تزوّد تغطية شاملة لمهارات التعلم ( القواعد والمفردات والقراءة والكتابة والتكلم والاستماع) مع تركيز على مهارات الاستماع ومهارات التكلم العملية في اللغة الإنكليزية الأمريكية. ويتبع هذا المنهج منهج passages، يحتوي passages على مستويين (الخامس والسادس) وهكذا يوفر كلا المنهجين سلسلة من ست مستويات تنقل الطالب من المستوى المبتدئ الى المتقدم.</p>
                                            </div>

                                            <button class="accordion align-right"><li>كيف يمكنني معرفة مستوى اللغة الإنكليزية الخاص بي؟ </li> </button>
                                            <div class="panel align-right">
                                                <p> من الصفحة الرئيسية أعلى يسار الشاشة  </p>
                                                <img class="" src="{{URL::asset('/assets/layouts/layout/img/answer.png')}}" height="90px" width="400px">
                                            </div> 
                                            <button class="accordion align-right"><li>كم عدد الدروس التي تنشر أسبوعيًّا؟  </li></button>
                                            <div class="panel align-right">
                                                <p>يتم نشر الدّروس على الموقع بمعدّل درس واحد أسبوعيًّا كلّ يوم سبت. </p>
                                            </div>
                                            <button class="accordion align-right"><li>أين تتم مناقشة الدروس (الصف التفاعلي)؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <p>تتم المناقشات عن بعد، عن طريق التواصل بشكل مجموعات في برنامج Telegram.  </p>
                                            </div>

                                            <button class="accordion align-right"><li>  هل بإمكاني طلب تعويض حصة دراسية في حال وجود ظرف يمنعني من الحضور؟  </li> </button>
                                            <div class="panel align-right">
                                                <p> نعم، بإمكانك طلب تعويض حصّة دراسية لـ 4 مرات فقط، وذلك عن طريق التواصل مع مسؤول شؤون الطلاب في مجموعتك التفاعلية وطلب حضور حصة تعويضية للجلسة التي فاتتك أو الجلسة التي لن تتمكن من حضورها. </p>
                                            </div>

                                            <button class="accordion align-right"><li> ماذا لو كان لدى الطالب استفسار أو تساؤل؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <h4>في حال كان الاستفسار  متعلقًا بالمادة العلمية:</h4>
                                                <p>أي سؤال متعلق بالدرس وقواعده يُسأل أثناء جلسة المناقشة على المجموعة التفاعلية.</p>
                                                <h4>في حال كان استفساراً عاماً متعلقًا بالأمور التنظيمية أو الإدارية: </h4>
                                                <p>في صفحة التواصل Contact us، ستجد الحسابات الخاصة بالمسؤولين عن الإجابة على الاستفسارات أو حل أية مشكلة قد تواجهك. اختر القسم المطلوب ووضّح استفسارك، وسيتم الرد عليك خلال 24 ساعة عبر البريد الإلكتروني المستخدم عند التسجيل. </p>
                                            </div>

                                            <button class="accordion align-right"><li>ما هو عدد الغيابات المسموحة ؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <p> لا يُسمح بالغياب لأكثر من نصف عدد الجلسات في الفصل الواحد، حيث أن المستويات من الأول للرابع تحتوي على 16 درس، ثمانية دروس لكل فصل، والمستويان الخامس والسادس 12 درس، ستّة دروس لكل فصل. </p>
                                                <p> لا يُسمح بالغياب لأول ثلاث جلسات، في حال تغيّبك يتم التواصل معك لإشعارك بذلك ومن ثم الفصل في حال عدم التجاوب.</p>
                                            </div>

                                            <button class="accordion align-right"><li>  ما هو الإجراء المُتّخذ بحال تجاوزي عدد الغيابات المسموح لي بها؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <p>     بحال تكرر غيابك يتم التواصل معك وإشعارك بضرورة الحضور، وفي حال تجاوزت الحد المسموح للغياب يتم تجميد حسابك من الموقع وإزالتك من مجموعتك التفاعلية.</p>
                                            </div>

                                            <button class="accordion align-right"><li> هل لحضور المناقشات أهمية؟  </li></button>
                                            <div class="panel align-right">
                                                <p> بالتأكيد، فهنالك علامة للمشاركة ولا يقتصر الحضور على تواجدك "أون لاين"، بل عليك التفاعل والمشاركة أثناء الجلسة. </p>
                                            </div>

                                            <button class="accordion align-right"><li> هل يمكنني معرفة الإجابات الصحيحة من الخاطئة بعد تقديمي للامتحان؟  </li></button>
                                            <div class="panel align-right">
                                                <p> يمكنك الحصول على تصحيح إجاباتك الخاطئة عن طريق خيار my exams mistakes من تبويب exams بعد تقديمك للامتحان. </p>
                                            </div>

                                            <button class="accordion align-right"><li>كيف يتم حضور الجلسة التعويضية؟  </li></button>
                                            <div class="panel align-right" dir="rtl">
                                                <ul>
                                                    <li>    بعد تثبيت الوقت المناسب للدّرس التّعويضي، يصلك إشعار وإيميل بتغيير مجموعة المناقشة التّفاعلية للدّرس المطلوب مؤقتًا، ومن ثم تنضم للمجموعة المؤقتة عبر رابط التلغرام الخاص بالدرس من تبويب  My group.</li>
                                                    <li>   وعليك الخروج من مجموعة التعويض (التلغرام ) فور انتهاء الدرس الذي قمت بتعويضه.</li>
                                                    <img class="" src="{{URL::asset('/assets/layouts/layout/img/session.png')}}" width="100%" height="auto">
                                                </ul>
                                            </div>

                                            <button class="accordion align-right"><li> ما هو الحد الأدنى للنجاح في الدورة وانتقال الطالب للمستوى التالي؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <p>للانتقال للمستوى التالي يُشترط الالتزام بالحضور والدراسة، والحصول على تقييم عام في نهاية الدورة أعلى من 70/100، مع إمكانية منح درجة لثلاث درجات في حال حصولك على 69 - 68 - 67 درجة في حال تبيّن اهتمامك والتزامك خلال فترة الدراسة.</p>
                                            </div>

                                            <button class="accordion align-right"><li>  هل المبادرة تمنح للطلاب شهادة إتمام المستوى في نهاية الدورة؟ </li> </button>
                                            <div class="panel align-right" dir="rtl">
                                                <ul>
                                                    <li>    في نهاية الدورة يُمنح كل طالب شهادة حضور باسم المبادرة، تثبت اجتيازه للمستوى، شريطة الالتزام بالحضور والدّراسة وإجراء الإمتحان والحصول على تقييمٍ عام أعلى من 70/100.</li>
                                                    <li>    يتم توزيع شهادات تقدير باسم المبادرة للطّلاب الخمسة الأوائل من كل مستوى. </li>
                                                    <li>    يمكنك استعراض شهادة إتمام المستوى في نهاية الدورة عن طريق تبويب Final Certificate .</li>
                                                </ul>
                                            </div>

                                            <button class="accordion align-right"><li>كيف يتم احتساب الدرجات؟ </li> </button>
                                            <div class="panel align-right">
                                                <ul class="list-unstyled" dir="rtl">
                                                    <li>-   40 درجة للمشاركة والمهارات الإنشائيّة، تُوزّع على النّحو التّالي:
                                                        <ul>
                                                            <li>    الطّلاقة باللّغة الإنكليزية وسلاسة التّحدّث بها.</li>
                                                            <li>    اِستخدام القواعد بشكلٍ سليم، علمًا أنّ الخطأ مردود وقابل للتّصحيح عدّة مرّات، فالمهم هو المشاركة والتّفاعل.</li>
                                                            <li>    سلامة اللفظ: سلامة اللّفظ تتّضح بتأكيدك كطالب على كل كلمة تستخدمها، ومدى تجاوبك عندما يصحّح له المدرس اللفظ و يطلب منك إعادته.</li>
                                                            <li>    الإنجاز العام: والذي يعتمد على إجمالي المشاركات ودقّة وسرعة إجابتك.</li>
                                                            <li>    المهارات الإنشائية: (تُستثنى منها المستويات A1,A2) 
                                                                تتعلّق بكتابة المواضيع التي سيطلبها المدرس لاحقًا منك .
                                                                عليك تقديم مواضيع قصيرة وفقًا لتعليمات المدرس، مع الالتزام بالفترة الزّمنية المحددة للتسليم.  
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>-    10 درجات للمقابلة الشفهية: 
                                                        <p>هدف هذه المقابلة هو مساعدتك على رفع درجة المحصّلة النّهائيّة، وتشجيعًا لك للتّحدث باللغة الإنكليزية.</p>
                                                         <p>يقوم المدرس بإجراء مقابلة قصيرة لطلاب مجموعته نهاية الدّورة قبل الإمتحان، وتتراوح مدّتها بين 3 و10 دقائق، يختبرك فيها بشكلٍ عام بأسئلة من ضمن المنهج تبعًا للمستوى الذي كان فيه .   
                                                        </p></li>
                                                        <li>-    25 درجة للامتحان النّصفي: الذي يتم بعد إنهاء مناقشة نصف عدد الدّروس.</li>
                                                        <li>-    25 درجة للامتحان النهائي: الذي يتم بعد إنهاء جميع الدّروس المقرّرة.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>


                            </div>   
                        </div>                        
                    </div>            
                </div><!-- .col-md-8 --> 

            </div>
        </div>   
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <script type="text/javascript">
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
/* Toggle between adding and removing the "active" class,
to highlight the button that controls the panel this.classList.toggle("active");*/


/* Toggle between hiding and showing the active panel */
var panel = this.nextElementSibling;
if (panel.style.display === "block") {
    panel.style.display = "none";
} else {
    panel.style.display = "block";
}
});
            }
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