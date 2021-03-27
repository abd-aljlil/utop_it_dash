<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Group_Timing_attendees;
use App\Group_Timing;
use App\User;
use Response;
use DB;
use App\Notifications\Update_Student_Session;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StudentGroupUpdated;


class Group_Timing_attendeeController extends Controller
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
        //return view('indexes.Group');
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
        //
        if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'user_id' => 'required',
                ],[
                'user_id.required' => 'الرجاء إدخال رقم المستخدم',
               ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            //$data["created_by"] = Auth::user()->id;
            Group_Timing_attendees::insert($data);
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
        //retrieve student data
        $this->data["RecordData"] = DB::table('group_timing_attendees')
            ->leftJoin('users', 'group_timing_attendees.user_id', '=', 'users.id')
            ->leftJoin('group_timing', 'group_timing.id', '=', 'group_timing_attendees.group_timing_id')
            ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
            ->where('group_timing_attendees.id' , $id)
            ->get(['group_timing_attendees.id AS id','users.english_name AS user_name', 'users.id AS user_id', 
                'groups.user_level As level','group_timing.name AS timing_name'])
            ->first();

        $course=DB::table('course')->where('active','1')->first();

        //retrieve rest active sessions for same user level 
        $this->data["LevelActiveSessions"] = DB::table('group_timing')
            ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
            ->where('group_timing.active' , 0)
            ->where('groups.trash' , 0)
            ->where('group_timing.name' , $this->data["RecordData"]->timing_name)
            ->where('groups.user_level' , $this->data["RecordData"]->level)
            ->where('groups.course_id' , $course->id)
            ->select("group_timing.id AS value",DB::raw('CONCAT(groups.name, " ",group_timing.day, " ", group_timing.time) AS label'))
            ->get();


        
        return $this->data;

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
       // $this->data["RecordData"] = Group_Timing_attendees::find($id);
        $this->data["RecordData"] = DB::table('group_timing_attendees')
            ->leftJoin('users', 'group_timing_attendees.user_id', '=', 'users.id')
            ->where('group_timing_attendees.group_timing_id' , $id)
            ->where('group_timing_attendees.trash' , 0)
            ->get(['group_timing_attendees.id AS id','users.english_name AS user_name', 'users.id AS user_id', 
                'group_timing_attendees.available AS status','group_timing_attendees.fluency AS fluency','group_timing_attendees.pronunciation AS pronunciation','group_timing_attendees.over_all_achievement AS over_all_achievement','group_timing_attendees.grammar AS grammar','group_timing_attendees.composition_skills AS composition_skills','group_timing_attendees.average AS average'])
            ->toArray();


        
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
        //update attendee session 
        
            $data = $request->all();
            $validator =  Validator::make($data, [
                
                'group_timing_id' => 'required'
                ],[
                
                'group_timing_id.required' => 'قم الجلسة مطلوب',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }


            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 
           
            Group_Timing_attendees::where('id',$id)->update($data);

            $user = Group_Timing_attendees::select('user_id')->where('id',$id)->get();
            $gid= Group_Timing_attendees::select('group_timing_id')->where('id',$id)->get();
            $info=Group_Timing::find( $data['group_timing_id']);

           // return $this->info;
           
          return $this->notifStudentSessionChange($user,$info);
       
        
        
    }

        public function updateStudentGroup(Request $request, $id)
    {
        //update attendee session 
            $course_id=DB::table('course')->where('active','1')->first()->id;
            $data = $request->all();
            $validator =  Validator::make($data, [
                
                'group_timing_id' => 'required'
                ],[
                
                'group_timing_id.required' => 'قم الجلسة مطلوب',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }


            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 

            $student_id=Group_Timing_attendees::where('id',$id)->get(['user_id'])->first();

            $new_group_id['group_id']=DB::table('groups')
            ->leftJoin('group_timing', 'group_timing.group_id', '=', 'groups.id')
            ->where('group_timing.id' , $data['group_timing_id'])
            ->get(['groups.id as id'])
            ->first();

            $old_group_sessions=DB::table('group_timing_attendees')
            ->where('user_id' , $student_id->user_id)
            ->where('course_id',$course_id)
            ->orderby('id')
            ->get(['group_timing_id','id'])
            ->toArray();

            $new_group_sessions=DB::table('group_timing')
            ->leftJoin('groups', 'group_timing.group_id', '=', 'groups.id')
            ->where('group_timing.group_id' , $new_group_id['group_id']->id)
            //->where('group_timing.active' , 0)
            ->orderby('group_timing.name')
            ->get(['group_timing.id as group_timing_id', 'group_timing.name as name'])
            ->toArray();


            foreach ($new_group_sessions as $session) {
            DB::table('group_timing_attendees')
            ->leftJoin('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
            ->where('group_timing.name' , $session->name)
            ->where('group_timing.active' , 0)
            ->where('user_id' , $student_id->user_id)
            ->update(['group_timing_id' => $session->group_timing_id]);
            }
        $user = Group_Timing_attendees::select('user_id')->where('id',$id)->get();
        return $this->notifStudentGroupChange($user);
        
    }

    public function notifStudentSessionChange($id,$info)
    {
        
        $user=User::find($id);
        \Notification::send($user, new Update_Student_Session($info));

        
    }

    public function notifStudentGroupChange($id)
    {
        
        $user=User::find($id);
        \Notification::send($user, new StudentGroupUpdated());

        
    }

    public function getMarks($id)
    {
        //
        if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
        {
       // $this->data["RecordData"] = Group_Timing_attendees::find($id);
        $this->data["RecordData"] = DB::table('group_timing_attendees')
            ->leftJoin('users', 'group_timing_attendees.user_id', '=', 'users.id')
            ->where('group_timing_attendees.id' , $id)
            //->where('group_timing_attendees.user_id' , $id)
            ->get(['group_timing_attendees.id AS id','users.english_name AS user_name',
                'group_timing_attendees.available AS status','group_timing_attendees.fluency AS fluency','group_timing_attendees.pronunciation AS pronunciation','group_timing_attendees.over_all_achievement AS over_all_achievement','group_timing_attendees.grammar AS grammar','group_timing_attendees.composition_skills AS composition_skills','group_timing_attendees.average AS average'])
            ->first();


        
        return $this->data;
    }
    }



    public function updateMarks(Request $request, $id)
    {
        //
        
        $data = $request->all();
        $validator =  Validator::make($data, [
            'available' => 'required',
            'fluency' => 'required',
            'composition_skills' => 'required',
            'over_all_achievement' => 'required',
            'grammar' => 'required',
            'pronunciation' => 'required',
            
            ],[
            
            'available.required' => 'It is required',
            'fluency.required' => 'It is required',
            'composition_skills.required' => 'It is required',
            'over_all_achievement.required' => 'It is required',
            'grammar.required' => 'It is required',
            'pronunciation.required' => 'It is required',
           
        ]);
         
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        $data['average']=($data['pronunciation']+$data['grammar']+$data['fluency']+$data['over_all_achievement']);


        $data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 
       
        Group_Timing_attendees::where('id',$id)->update($data);
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
        $this->data["TableData"] = Group_Timing_attendees::where('trash' , 0)->get();
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
        Group_Timing_attendees::where('id',$id)->update(['trash' => 1]);
    }
}
