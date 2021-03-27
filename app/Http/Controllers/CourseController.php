<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Course;
use App\User_Course;
use DB;

class CourseController extends Controller
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
        //
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {


            return view('indexes.Courses');

        }
    }
    public function calculate_totals($level,$course_id)
    { //select this level's students in the specified course
      // loop through student id and calculate his total and save it in the db
    $students = DB::table('user_course')
    ->where('user_course.level',$level)
->where('user_course.block',0)
    ->where('user_course.course_id',$course_id)
    ->get(['user_course.user_id']);

    foreach ($students as $user) {
        $qaverage = DB::SELECT('SELECT  sum(average) as average FROM group_timing_attendees 
            WHERE user_id = '.$user->user_id.' and course_id='.$course_id.' group by user_id');
        $qcomposition = DB::SELECT('SELECT  sum(composition_skills) as comskills FROM group_timing_attendees 
            WHERE user_id = '.$user->user_id.' and course_id='.$course_id.' group by user_id');
        $qavilable  = DB::SELECT('SELECT count(user_id) as available FROM 
            group_timing_attendees WHERE available =1 and user_id= '.$user->user_id.' and course_id='.$course_id.'');
        $qmarks = DB::SELECT('select user_id ,interview_average,midterm_test_mark,level,
         final_test_mark from user_course
         where 
         user_id ='.$user->user_id.' and course_id='.$course_id.'');
        $average=0;
        $composition=0;
        $avilable=0;
        $interview_average=0;
        $midterm_test_mark=0;
        $final_test_mark=0;
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

       User_Course::where('user_id', $user->user_id)->where('course_id', $course_id)->update(array('total' => $total));
       User_Course::where('user_id', $user->user_id)->where('course_id', $course_id)->update(array('participation_average' => $participation));
   }

}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchLevelStudents($course,$level)
    {
        //
       $this->data["TableData"] = DB::table('user_course')
         //->select('user_id','english_name','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'interview_average')
       ->leftJoin('users', 'users.id', '=', 'user_course.user_id')
       ->leftJoin('group_timing_attendees', 'group_timing_attendees.user_id', '=', 'user_course.user_id')
       ->leftJoin('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
       ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
       ->where('user_course.level',$level)
       ->where('user_course.course_id',$course)
       ->where('user_course.block',0)
       ->where('group_timing_attendees.available','1')
       ->where('groups.course_id',$course)
       ->groupBy('user_course.user_id','users.english_name', 'users.email',
        'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark',  'total')
       ->orderBy('user_course.user_id')
       ->get(['user_course.user_id','users.english_name', 'users.email',
        'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'total' , DB::raw('sum(average) as sum_part') , DB::raw('sum(composition_skills) as sum_composition'), DB::raw('count(available) as available_sessions_no') ]);

       return $this->data;

   }

   public function fetchLevelStudentsGroups($course,$level)
   {
        //

    $this->data["TableData"] =DB::table('user_course')
         //->select('user_id','english_name','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'interview_average')
    ->leftJoin('users', 'users.id', '=', 'user_course.user_id')
    ->leftJoin('group_timing_attendees', 'group_timing_attendees.user_id', '=', 'user_course.user_id')
    ->leftJoin('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
    ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
    ->where('user_course.level',$level)
    ->where('user_course.course_id',$course)
    ->where('user_course.block',0)
    ->where('group_timing.name','12')
    ->where('groups.course_id',$course)
    ->orderBy('user_course.user_id')
    ->get(['user_course.user_id','users.english_name', 'users.email',
        'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark' , 'groups.name as group_name' ]);

    return $this->data;



}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $data = $request->all();
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources') )
        {
            //


            $data = $request->all();
            $validator =  Validator::make($data, [
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'mid_term_test_date' => 'required',
                'final_test_date' => 'required',
            ],[
                'name.required' => 'المسمى مطلوب',
                'start_date.required' => 'تاريخ بداية الكورس مطلوب',
                'end_date.required' => 'تاريخ نهاية الكورس مطلوب',
                'mid_term_test_date.required' => 'تاريخ الامتحان النصفي مطلوب',
                'final_test_date.required' => 'تاريخ الامتحان النهائي مطلب',
            ]);

            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            $data["created_by"] = Auth::user()->id;
            $data["created_at"] = now();

            Announcement::create($data);

        }
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {   
           $this->data["TableData"] = DB::table('user_course')
           ->select('level', DB::raw('count(user_id) as user_count'))
           ->where('course_id',$id)
           ->groupBy('level')
           ->get();

           return $this->data;

       }
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
        $this->data["RecordData"] = Course::find($id);
        return $this->data;
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'mid_term_test_date' => 'required',
                'final_test_date' => 'required',
            ],[
                'name.required' => 'المسمى مطلوب',
                'start_date.required' => 'تاريخ بداية الكورس مطلوب',
                'end_date.required' => 'تاريخ نهاية الكورس مطلوب',
                'mid_term_test_date.required' => 'تاريخ الامتحان النصفي مطلوب',
                'final_test_date.required' => 'تاريخ الامتحان النهائي مطلب',
            ]);

            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            

            Course::where('id',$id)->update($data);
        }
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
       if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
       {
        $this->data["Courses"] = DB::table('course')
        ->where('trash' , 0)
        ->orderBy('id', 'desc')
        ->get();

        return $this->data;

    }


}

public function calculate_success_percent($id)
    {
        //
       
        $count_success = DB::table('user_course')
        ->where('course_id' , $id)
        ->where('total' ,">=", 67)
        ->count();

        $count_all = DB::table('user_course')
        ->where('course_id' , $id)
        //->where('total' ,">=", 67)
        ->count();

        $final_count = $count_success / $count_all * 100;

         $count = round($final_count*2)/2;

        $this->data["RecordData"]= array('percent' => $count , 'count_all' => $count_all,  'count_success' => $count_success);

        return $this->data;

    


}
     /**
     * Trash the specified resource from view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function trash($id)
     {
        //
        Course::where('id',$id)->update(['trash' => 1]);
    }

    public function active($id)
    {
        //
        DB::table('course')->update(array('active' => 0));
        DB::table('course')->where('id' , $id)->update(array('active' => 1));
       //return $this->notifStudents();
        
        
    }

    
}
