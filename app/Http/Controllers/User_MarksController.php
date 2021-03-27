<?php

namespace App\Http\Controllers;

use App\User_Marks;
use Illuminate\Http\Request;
use DB;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class User_MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //
        if(Auth::user()->hasRole('Student_Resources') || Auth::user()->hasRole('SysAdministrator'))
        {
            return view('indexes.User_Marks');
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

     public function fetchSi()
    {
       

    $this->data["TableData"] = DB::table('user_course')
         //->select('user_id','english_name','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'interview_average')
         ->leftJoin('users', 'users.id', '=', 'user_course.user_id')
         ->orderBy('user_course.course_id', 'desc')
         ->orderBy('user_course.level', 'asc')
         ->orderBy('user_course.user_id')
         ->get(['user_course.course_id','user_course.user_id','user_course.level','users.english_name','users.preferred_time as type', 'users.email','users.preferred_time',
            'placement_test_mark' ]);
      
           // return $this->data;
        
        
    return $this->data;
    }

    public function fetch()
    {
        //
         //
        /*
        $first_query = DB::SELECT('select users.id as user_id,users.preferred_time as type, users.previous_student as previous, users.english_name as name, users.level as level, users.email as email , user_marks.interview_average as interview_average, ROUND(SUM(exam_name_index_users.result),2) AS Midterms from user_marks left join users on users.id = user_marks.user_id left join exam_name_index_users on exam_name_index_users.user_id = users.id LEFT JOIN exam_name_index on exam_name_index_users.exam_name_index_id = exam_name_index.id LEFT JOIN exam_name ON exam_name_index.exam_name_id = exam_name.id 
            join group_timing_attendees on group_timing_attendees.user_id = users.id left join group_timing on group_timing.id=group_timing_attendees.group_timing_id left join groups on groups.id = group_timing.group_id
            where exam_name_index_users.trash=0 && users.block=0 group by user_id, users.english_name, type,previous,level, email, interview_average order by level asc,user_id asc');
        $second_query = DB::SELECT('select users.id as user_id , users.preferred_time as type, users.previous_student as previous, users.english_name as name, users.level as level, users.email as email, groups.name as group_name,user_marks.interview_average as interview_average, ROUND(AVG(group_timing_attendees.composition_skills),1) AS composition_skills, ROUND(AVG(group_timing_attendees.average),1) AS total_interaction_mark, ROUND(SUM(group_timing_attendees.available),0) AS attendance, ROUND(AVG(group_timing_attendees.average) + AVG(group_timing_attendees.composition_skills),1) as Participation from user_marks left join users on users.id = user_marks.user_id left join group_timing_attendees on group_timing_attendees.user_id = users.id left join group_timing on group_timing.id=group_timing_attendees.group_timing_id left join groups on groups.id = group_timing.group_id where users.block=0 and group_timing.name=\'12\' group by user_id , type,previous, name, level, email, group_name,interview_average order by level asc,users.id asc');
        $this->data["TableData"] = [];
        foreach ($first_query as $first_query_key => $first_query_value) {
            $this->data["TableData"][$first_query_key] = $first_query_value;
            foreach ($second_query as $second_query_key => $second_query_value) {
                
                if($second_query_value->user_id == $first_query_value->user_id)
                {   
                    $this->data["TableData"][$first_query_key]->interview_average      = $second_query_value->interview_average;
                    $this->data["TableData"][$first_query_key]->group_name      = $second_query_value->group_name;
                    $this->data["TableData"][$first_query_key]->composition_skills     = $second_query_value->composition_skills;
                    $this->data["TableData"][$first_query_key]->total_interaction_mark = $second_query_value->total_interaction_mark;
                    $this->data["TableData"][$first_query_key]->attendance             = $second_query_value->attendance;
                    $this->data["TableData"][$first_query_key]->Participation          = $second_query_value->Participation;
                }
            }
        }
        */
        $first_query =DB::table('user_course')
         //->select('user_id','english_name','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'interview_average')
    ->leftJoin('users', 'users.id', '=', 'user_course.user_id')
    ->leftJoin('group_timing_attendees', 'group_timing_attendees.user_id', '=', 'user_course.user_id')
    ->leftJoin('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
    ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
    //->where('user_course.level',$level)
    ->where('groups.course_id',7)
    ->where('user_course.course_id',7)
    ->where('group_timing.name','12')
  
    ->orderBy('user_course.course_id','desc')
    ->orderBy('user_course.level','asc')
    ->orderBy('user_course.user_id')
    ->get(['user_course.course_id','user_course.level','user_course.user_id', 'users.english_name', 'users.email', 
        'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark' , 'groups.name as group_name' ]);

     $second_query = DB::table('user_course')
         //->select('user_id','english_name','placement_test_mark', 'midterm_test_mark', 'final_test_mark', 'interview_average')
         ->leftJoin('users', 'users.id', '=', 'user_course.user_id')
         ->leftJoin('group_timing_attendees', 'group_timing_attendees.user_id', '=', 'user_course.user_id')
         ->leftJoin('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
         ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
         ->where('group_timing_attendees.available','1')
         ->where('group_timing_attendees.course_id',7)
         ->where('user_course.course_id',7)
         ->groupBy('user_course.user_id','users.english_name', 'users.email','user_course.level','user_course.course_id',
            'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark','total')
        
         ->orderBy('user_course.course_id', 'desc')
         ->orderBy('user_course.level', 'asc')
         ->orderBy('user_course.user_id')
         ->get(['user_course.user_id','users.english_name', 'users.email',
            'interview_average','placement_test_mark', 'midterm_test_mark', 'final_test_mark','total' ,DB::raw('sum(average) as sum_part') , DB::raw('sum(composition_skills) as sum_composition'), DB::raw('count(available) as 
             available_sessions_no') ]);
      
           // return $this->data;
        $this->data["TableData"] = [];
        foreach ($first_query as $first_query_key => $first_query_value) {
            $this->data["TableData"][$first_query_key] = $first_query_value;
            foreach ($second_query as $second_query_key => $second_query_value) {
                
                if($second_query_value->user_id == $first_query_value->user_id)
                {   
                    
                    $this->data["TableData"][$first_query_key]->available_sessions_no      = $second_query_value->available_sessions_no;
                    $this->data["TableData"][$first_query_key]->sum_part      = $second_query_value->sum_part;
                    $this->data["TableData"][$first_query_key]->total      = $second_query_value->total;

                    $this->data["TableData"][$first_query_key]->sum_composition = $second_query_value->sum_composition;
                }
            }
        }
    return $this->data;
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_marks  $user_marks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->data["RecordData"] = DB::table('user_marks')
        ->LeftJoin('users', 'user_marks.user_id', '=', 'users.id')
        ->where('user_marks.id' , $id)
            //->distinct();
            //->where('group_timing_attendees.trash' , 0)
        ->get(['user_marks.id AS id','users.english_name AS user_name', 'users.id AS user_id', 
            'user_marks.interview_fluency AS interview_fluency', 'user_marks.interview_grammar AS interview_grammar', 'user_marks.interview_comprehension AS interview_comprehension', 'user_marks.interview_vocabulary AS interview_vocabulary','user_marks.interview_pronunciation AS interview_pronunciation','user_marks.interview_average AS interview_average'  ])
        ->first();
        
        return $this->data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_marks  $user_marks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->data["RecordData"] = DB::table('user_marks')
        ->Join('users', 'user_marks.user_id', '=', 'users.id')
        ->leftJoin('group_timing_attendees', 'group_timing_attendees.user_id', '=', 'users.id')
        ->leftJoin('group_timing', 'group_timing.id', '=', 'group_timing_attendees.group_timing_id')
        ->Join('groups', 'groups.id', '=', 'group_timing.group_id')
        ->where('groups.id' , $id)
        ->distinct()
            //->where('group_timing_attendees.trash' , 0)
        ->get(['user_marks.id AS id','users.english_name AS user_name', 'users.id AS user_id', 
            'user_marks.interview_fluency AS interview_fluency', 'user_marks.interview_grammar AS interview_grammar', 'user_marks.interview_comprehension AS interview_comprehension', 'user_marks.interview_vocabulary AS interview_vocabulary','user_marks.interview_pronunciation AS interview_pronunciation','user_marks.interview_average AS interview_average'  ])
        ->toArray();


        
        return $this->data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_marks  $user_marks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $validator =  Validator::make($data, [
            //'available' => 'required',
            'interview_fluency' => 'required',
            'interview_vocabulary' => 'required',
            'interview_comprehension' => 'required',
            'interview_grammar' => 'required',
            'interview_pronunciation' => 'required',
            
        ],[
            
            //'available.required' => 'It is required',
            'interview_fluency.required' => 'It is required',
            'interview_vocabulary.required' => 'It is required',
            'interview_comprehension.required' => 'It is required',
            'interview_grammar.required' => 'It is required',
            'interview_pronunciation.required' => 'It is required',
            
        ]);
        
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        $data['interview_average']=($data['interview_pronunciation']+$data['interview_grammar']+$data['interview_fluency']+$data['interview_vocabulary']+$data['interview_comprehension'])*10/25;

        $AverageMark['interview_average'] =$data['interview_average'];

        //
        $data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 
        //ensure it works successfully when you add students to the course_user table
        User_Marks::where('id',$id)->update($data);
        $user=DB::table('user_marks')->where('id',$id)->first();
        $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
        DB::table('user_course')->where('user_id',$user->user_id)->where('course_id',$course_id)->update($AverageMark);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_marks  $user_marks
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_marks $user_marks)
    {
        //
    }
}
