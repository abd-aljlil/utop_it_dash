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
        if(Auth::user()->hasRole('Student_Resources'))
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

     public function fetch5102018()
    {
        //
        $this->data["TableData"] = DB::SELECT('select users.id as user_id, users.preferred_time as type, users.previous_student as previous, users.english_name as name, users.level as level, users.email as email , ( SELECT sum( user_marks.interview_average ) FROM user_marks WHERE users.id = user_marks.user_id and user_marks.trash = 0 ) AS interview_average , (select ROUND(SUM(exam_name_index_users.result),2) from exam_name_index_users WHERE users.id = exam_name_index_users.user_id and exam_name_index_users.trash = 0 )  as Midterms , (select ROUND(SUM(group_timing_attendees.available)/2,0) from group_timing_attendees WHERE users.id = group_timing_attendees.user_id and group_timing_attendees.trash = 0 ) AS attendance  , (select ROUND(AVG(group_timing_attendees.average) + AVG(group_timing_attendees.composition_skills),1) from group_timing_attendees WHERE users.id = group_timing_attendees.user_id and group_timing_attendees.trash = 0 ) as Participation , ( SELECT ROUND(AVG(group_timing_attendees.average),1)  from group_timing_attendees where group_timing_attendees.user_id = users.id ) AS total_interaction_mark FROM users where users.trash = 0 order by level asc');
        return $this->data;
    }

    public function fetch()
    {
        //
        
        $first_query = DB::SELECT('select users.id as user_id,users.preferred_time as type, users.previous_student as previous, users.english_name as name, users.level as level, users.email as email , user_marks.interview_average as interview_average, ROUND(SUM(exam_name_index_users.result),2) AS Midterms from user_marks left join users on users.id = user_marks.user_id left join exam_name_index_users on exam_name_index_users.user_id = users.id LEFT JOIN exam_name_index on exam_name_index_users.exam_name_index_id = exam_name_index.id LEFT JOIN exam_name ON exam_name_index.exam_name_id = exam_name.id where exam_name_index_users.trash=0 && users.block=0 group by user_id, users.english_name, type,previous,level, email, interview_average order by level asc,user_id asc');
        $second_query = DB::SELECT('select users.id as user_id , users.preferred_time as type, users.previous_student as previous, users.english_name as name, users.level as level, users.email as email, user_marks.interview_average as interview_average, ROUND(AVG(group_timing_attendees.composition_skills),1) AS composition_skills, ROUND(AVG(group_timing_attendees.average),1) AS total_interaction_mark, ROUND(SUM(group_timing_attendees.available),0) AS attendance, ROUND(AVG(group_timing_attendees.average) + AVG(group_timing_attendees.composition_skills),1) as Participation from user_marks left join users on users.id = user_marks.user_id left join group_timing_attendees on group_timing_attendees.user_id = users.id where users.block=0 group by  user_id , type,previous, name, level, email, interview_average order by level asc,user_id asc');
        $this->data["TableData"] = [];
        foreach ($first_query as $first_query_key => $first_query_value) {
            $this->data["TableData"][$first_query_key] = $first_query_value;
            foreach ($second_query as $second_query_key => $second_query_value) {
                
                if($second_query_value->user_id == $first_query_value->user_id)
                {   
                    $this->data["TableData"][$first_query_key]->interview_average      = $second_query_value->interview_average;
                    $this->data["TableData"][$first_query_key]->composition_skills     = $second_query_value->composition_skills;
                    $this->data["TableData"][$first_query_key]->total_interaction_mark = $second_query_value->total_interaction_mark;
                    $this->data["TableData"][$first_query_key]->attendance             = $second_query_value->attendance;
                    $this->data["TableData"][$first_query_key]->Participation          = $second_query_value->Participation;
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
            //->distinct()
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


        //
        $data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 
        
        User_Marks::where('id',$id)->update($data);
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
