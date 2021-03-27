<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\EndOfCourseSurvey;
use App\Notifications\InterviewStartDate;
use App\User;
use App\Exam_Name_Index_Users;
use App\Notifications\StudentRegistered;
use App\User_Course;
use DB;
class AppController extends Controller
{
    //

   public function __construct()
    {
      $this->middleware('auth');
  }
  public function index()
  {
    if (Auth::user())
      {   $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
  // if( Auth::user()->hasRole("Students") && $user_course_joined!=0)
   //take to my group page 
   //{return $this->course_register();
   
   //take to course register
   //app('App\Http\Controllers\GroupController')->index();}
   //else //if($user_course_joined!=0)
  // {
   return view('home2')->with('course',$course)->with('user_joined',$user_course_joined);
   
   //}
  }   
  else 
    return view('auth.login');
  }
  public function home()
  {
    if (Auth::user())
      {   $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
    $user = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->first();
    return view('home2')->with('course',$course)->with('user_joined',$user_course_joined)->with('user_level',$user->level);
   
  }   
  else 
    return view('auth.login');
  }

  public function Volunteer_Requests_list()
  {

  $this->data["TableData"] = DB::table('volunteer_requests')->orderby('id','desc')->get();
  return $this->data;
  }

  public function Volunteer_Requests()
  {
if(Auth::user()->block==0 && Auth::user()->hasRole("HR")){

  return view('indexes.Volunteer_Requests');}
  }





public function course_register()
{
  $course_id=DB::table('course')->where('active','1')->first()->id;
  $user_course_joined = DB::table('user_course')
  ->where('course_id' , $course_id)
  ->where('user_id' , auth::user()->id)
  ->count();

  $user_course_count = DB::table('user_course')
  ->where('course_id' , $course_id)
    //->where('user_id' , auth::user()->id)
  ->count();

  $placement_done = DB::table('exam_name_index_users')
  ->where('exam_name_index_id' , 1)
  ->where('user_id' , auth::user()->id)
  ->where('active' , 1)
  ->count();
  
 $users = User::find(auth::user()->id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();

  if ($user_course_joined ==0 )
  {  
    return view('course_register')->with('placement_done',$placement_done)->with('user_course_count',$user_course_count)->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
  }   
  else 
    return view('course_register')->with('success','You are registered in the current course')->with('placement_done',$placement_done)->with('user_course_count',$user_course_count)->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
}

public function course_join()
{
  $course_id=DB::table('course')->where('active','1')->first()->id;
  $user_course_joined = DB::table('user_course')
  ->where('course_id' , $course_id)
  ->where('user_id' , auth::user()->id)
  ->count();

  $placement_done = DB::table('exam_name_index_users')
  ->where('exam_name_index_id' , 1)
  ->where('user_id' , auth::user()->id)
  ->where('active' , 1)
  ->count();

  $previous_joined = DB::table('user_course')
  ->where('course_id' , $course_id-1)
  ->where('user_id' , auth::user()->id)
  ->count();

  if ($user_course_joined ==0 && $previous_joined==0)
  {  


    DB::table('user_marks')->insert([
      'user_id' => auth::user()->id
    ]);  


    $exam_name_index_data       = DB::SELECT("SELECT exam_name_index.id as id , exam_name_index.code as exam_code from exam_name_index JOIN exam_name WHERE exam_name.name like '%تحديد مستوى%' and exam_name.trash = 0 and exam_name_index.trash = 0 LIMIT 1");
    $exam_name_index_users_data["exam_name_index_id"] = $exam_name_index_data[0]->id;
    $exam_name_index_users_data["user_id"]            = auth::user()->id;
        //if previous student, don't give him a permission to do the exam.. just assign him to this exam in order to count his in the user_marks interface

    exam_name_index_users::insert($exam_name_index_users_data);

    $notify_data["exam_code"] = $exam_name_index_data[0]->exam_code;
    $notify_user              = User::find(auth::user()->id);
    $notify_user->notify(new StudentRegistered($notify_data));

    $user_course["user_id"]=auth::user()->id;
    $user_course["course_id"]=$course_id;
    User_Course::insert($user_course);

    $user_course_count = DB::table('user_course')
    ->where('course_id' , $course_id)
    //->where('user_id' , auth::user()->id)
    ->count();

    return redirect('Course_Register')->with('success','You are now registered in the current course, you can now go to the next step')->with('user_course_count',$user_course_count)->with('placement_done',0);
  }   
  else if ($user_course_joined ==0 && $previous_joined!=0)
  {
    DB::table('user_marks')->insert([
      'user_id' => auth::user()->id
    ]);  


    $exam_name_index_data       = DB::SELECT("SELECT exam_name_index.id as id , exam_name_index.code as exam_code from exam_name_index JOIN exam_name WHERE exam_name.name like '%تحديد مستوى%' and exam_name.trash = 0 and exam_name_index.trash = 0 LIMIT 1");

   // $notify_data["exam_code"] = $exam_name_index_data[0]->exam_code;
   // $notify_user              = User::find(auth::user()->id);
  //  $notify_user->notify(new StudentRegistered($notify_data));

    $user_course["user_id"]=auth::user()->id;
    $user_course["course_id"]=$course_id;
          // add calculation to count passed
    $user_id = Auth::user()->id;
    $user = User::find($user_id);
    $current_course=DB::table('course')->where('trash' , 0)->where('active', 1)->first();
    DB::enableQueryLog();
    $qaverage = DB::SELECT('SELECT  sum(average) as average FROM group_timing_attendees 
      WHERE user_id = '.$user_id.' group by user_id');
    $qcomposition = DB::SELECT('SELECT  sum(composition_skills) as comskills FROM group_timing_attendees 
      WHERE user_id = '.$user_id.' group by user_id');
    $qavilable  = DB::SELECT('SELECT count(user_id) as available FROM 
      group_timing_attendees WHERE available =1 and user_id= '.$user_id.'');
    $qmarks = DB::SELECT('select user_id ,interview_average,midterm_test_mark,level,
     final_test_mark from user_course
     where 
     user_id ='.$user_id.'');

    foreach($qaverage as $raw){
     $average = $raw->average;
   }

   foreach($qcomposition as $raw){
     $composition = $raw->comskills;
   }

   foreach($qavilable as $raw){
     $avilable = $raw->available;
   }

   foreach($qmarks as $raw){
     $interview_average     = $raw->interview_average;
     $midterm_test_mark     = $raw->midterm_test_mark;
     $final_test_mark   = $raw->final_test_mark;
     $level             = $raw->level;
   }

    if($level == 1 || $level == 2 ){
         $participation1 = ($average)/max($avilable,12);
         $participation = round($participation1*2)/2;
     }	
     else if( $level == 3 || $level == 4){
         $participation1 = ($average + $composition)/max($avilable,12);
         $participation = round($participation1*2)/2;
     }	
     else{
         $participation1 = ($average + $composition)/max($avilable,8);
         $participation = round($participation1*2)/2;
     }

   $total= $participation+$midterm_test_mark+$final_test_mark+$interview_average;


   if($total>66)
    $passed=1;
  else
    $passed=0;

  if($passed==1)
    $user_course["level"]=auth::user()->level + 1;
  else
    $user_course["level"]=auth::user()->level;

  $user["level"]=$user_course["level"];
  User_Course::insert($user_course);
  auth::user()->level=$user_course["level"];
  auth::user()->save();

  $user_course_count = DB::table('user_course')
  ->where('course_id' , $course_id)
    //->where('user_id' , auth::user()->id)
  ->count();
  
  $users = User::find(auth::user()->id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
    
  return redirect('Course_Register')->with('success','You are now registered in the current course')->with('placement_done',1)->with('user_course_count',$user_course_count)->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);



}//end else
}//end function



public function NotifInterview($date)
{

  $users = User::whereHas('user_course', function($q){
    $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
    $q->where('course_id', $course_id);
  })->get();

  $data['date']=$date;
  \Notification::send($users, new InterviewStartDate($data));
  return redirect('Group_User');


}

public function notify()
{

  $users = User::whereHas('user_course', function($q){
    $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
    $q->where('course_id', $course_id);
  })->get();
  \Notification::send($users, new EndOfCourseSurvey());
  return redirect('User_Marks');


}

public function contact()
{
  if (Auth::user())
  {
      $user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
    return view('contact-us')->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
  } else
  return view('auth.login');

}


public function sendmail(Request $request)
{
        //$user_id = Auth::user()->id;
  $data = $request->all();
  $to= "info@utopians-edu.org";
  $group= "not provided";

  if($data["type"]=="Student_Affairs")
    $to = "sa@utopians-edu.org";
  else if ($data["type"]=="Technical")
    $to = "it@utopians-edu.org";
  else if ($data["type"]=="Exams")
    $to = "it@utopians-edu.org, sa@utopians-edu.org";
  else
    $to = "feedback@utopians-edu.org";

  if($data["group"] != null)
    $group = $data["group"];

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: '.$data['email'] . "\r\n";
  $headers .= 'Cc: ceo@utopians-edu.org' . "\r\n";

  $message = '
  <html>
  <head>
  <title></title>
  </head>
  <body>
  <p>User ID: '.Auth::user()->id. '</p>
  <p>User Name: '.$data["english_name"]. '</p>
  <p>User Level: '.$data["level"]. '</p>
  <p>User Email: '.$data["email"]. '</p>
  <p>Group name: '.$group. '</p>
  <p>Message: '.$data["message"]. '</p>

  </body>
  </html>
  ';
        //$txt = "\r\n". "Student Name: ".$data["english_name"]. "\r\n";
        //$txt .= "\r\n". "Student Level: ".$data["level"]. "\r\n";
       // $txt .= $data["message"];
  $subject = $data["type"]." Problem - Level ".$data["level"];


  mail($to,$subject,$message,$headers);
$user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
  return view('contact-us')->with('success','Successfully sent!')->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);


}

}
