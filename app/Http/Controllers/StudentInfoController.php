<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Group_User;
use Illuminate\Http\Request;
use App\Groups;
use App\Group_Timing;
use App\Group_Timing_attendees;
use App\Notifications\Groups_Activation;
use Response;
use App\User;
use DB;

class StudentInfoController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
        return view('student_info')->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);        




    }
    
    public function search(Request $request){

        if($request->ajax()){

            $output="";

            $students= Group_Timing_attendees::where('user_id','LIKE',''.$request->search.'')
            ->first();
            $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
            if($students){

                $output .= "Student name : ".$students->user->english_name."    Level : ".$students->user->level."";

                $results = DB::table('groups')
                ->select('groups.name AS group_name','group_timing.name AS group_timing_name','group_timing_attendees.average AS total',
                    'group_timing_attendees.composition_skills AS composition_skills',
                    'groups.user_level AS level')
                ->join('group_timing','group_timing.group_id','=','groups.id')
                ->join('group_timing_attendees','group_timing_attendees.group_timing_id','=','group_timing.id')
                ->where('user_id','=',$students->user->id)
                ->where('group_timing_attendees.course_id','=', $course_id)
                ->orderby('group_timing.name')->get();

                if($results){
                    $output .= "<table class='table'><tbody>
                    <thead>
                    <th>Session number</th>
                    <th>Group name</th>                                
                    <th>total mark</th>
                    <th>Composition skills</th>
                    </thead>";
                }

                foreach ($results as $result) {
                   // dd($result->group_name);

                    $output .= "<tr><td>".$result->group_timing_name."</td>
                    <td>".$result->group_name."</td>
                    <td>".$result->total."</td>
                    <td>".$result->composition_skills."</td></tr>";
                }
                
                $exam_results = DB::table('exam_name_index_users')
                ->select('exam_name_index.code AS code','exam_name.name AS exam_name','exam_name_index_users.result AS result')
                ->join('exam_name_index','exam_name_index.id','=','exam_name_index_users.exam_name_index_id')
                ->join('exam_name','exam_name_index.exam_name_id','=','exam_name.id')
                ->where('user_id','=',$students->user->id)->where('exam_name_index.course_id','=',$course_id)->where('exam_name_index_users.trash','=',0)
                ->get();
                
                $output .= "</tbody></table>";

                $output .= "<table class='table'><thead>
                <th>Exam code</th>
                <th>Exam name</th>
                <th>Result</th>
                </thead><tbody>";
                foreach ($exam_results as $result) {

                    $output .= "<tr><td>".$result->code."</td>
                    <td>".$result->exam_name."</td>
                    <td>".$result->result."</td></tr>";
                }
                $output .= "</tbody></table>";
                return Response($output);
            }
            else{
                $output="There is no student has this ID";
                return Response($output);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        //

    }

     /**
     * Trash the specified resource from view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function print_cert()
     {
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
         $interview_average 	= $raw->interview_average;
         $midterm_test_mark 	= $raw->midterm_test_mark;
         $final_test_mark	= $raw->final_test_mark;
         $level				= $raw->level;
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
		//var_dump($level);
     return view('student_certificate')->with(['participation' => $participation])->with(['final_test_mark' => $final_test_mark])->with(['midterm_test_mark' => $midterm_test_mark])->with(['interview_average' => $interview_average])->with(['user' => $user])->with(['total' => $total])->with(['current_course' => $current_course]);
 }
 public function post_print()
 {
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

    $html = '<div style="background:url('.public_path('assets/certificate-bg.jpg').');
    background-repeat:no-repeat;height:600px;width:600px;">
    <h1>test print</h1></div>';
       // return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
        //return PDF::loadHTML($html)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
    $img = public_path("assets\certificate-bg.jpg");             
    $html = '<html>
    <head>
    <style>
    .img{margin-top:-40px;margin-left:-40px}
    .container{position:absolute;top:0;left:0}
    .sub-container{padding-top:100px;text-align:center}
    .text-up{text-transform:uppercase;}
    .text-blue{color:#014260}
    .text-normal{font-weight:normal}
    </style>
    </head>
    <body>
    <img src="'.$img.'"class="img">
    <div class="container">
    <div class="sub-container">
    <h1 class="text-blue">CETIFICATE OF COMPLETION</h1>
    <h2 class="text-blue text-normal text-up">this certificate is awarded to</h2>
    <h2 class="text-up">'.$user->english_name.'</h3>
    <h3 class="text-blue text-normal text-up">for successfully completing Level
    '.$user->level.'
    </h3>
    <h4 class="text-blue text-normal text-up">
    at utopians on 15/01/2019   
    </h4>
    <h4 class="text-blue text-normal text-up">
    with a score of: '.$total.'
    </h4>
    <div style="padding-top:50px">
    <h5 style="font-size:18px;padding-left:300px;text-align:left;text-transform:uppercase;color:#014260;font-weight:normal">
    date:'.$current_course->end_date.'<br/>
    '.$current_course->name.'
    </h5></div></div></div></body>
    </html>';              

    $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
    $pdf->loadHTML($html);
    return $pdf->download('certificate.pdf');

}

}
