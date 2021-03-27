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

class GroupController extends Controller
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
        //to be updated to students
      if(Auth::user()->block==0 && Auth::user()->hasRole("Students"))
        {   $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
      $user_level = DB::table('user_course')->where('user_id' , Auth::user()->id)->where('course_id', $course_id)->first()->level; //Auth::user()->level;

      $user_group_joined = DB::table('group_timing_attendees')

      ->leftJoin('group_timing', 'group_timing.id', '=', 'group_timing_attendees.group_timing_id')
      ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')

      ->where('groups.course_id' , $course_id)
      ->where('group_timing_attendees.user_id' , auth::user()->id)
      ->count();

      $user_course_joined = DB::table('user_course')
      ->where('course_id' , $course_id)
      ->where('user_id' , auth::user()->id)
      ->count();


      if($user_group_joined==0 && $user_course_joined==1)
      {
        if(auth()->user()->gender==2){
          $this->data["Groups"] = DB::table('groups')
          ->leftJoin('group_user', 'groups.id', '=', 'group_user.group_id')
          ->leftJoin('users', 'group_user.user_id', '=', 'users.id')
          ->leftJoin('group_timing', 'group_timing.group_id', '=', 'groups.id')
          ->where('groups.trash' , 0)
          ->where('groups.course_id' , $course_id)
          ->where('groups.active' , 0)
          ->where('groups.user_level' , $user_level)
          //->where('groups.female_only' , 1)
          ->distinct()
          ->orderBy('groups.name', 'asc')
          ->get(['groups.name AS group_name','groups.active AS active', 'groups.female_only AS female_only',  'groups.user_level AS level','users.english_name AS user_name', 'users.bio AS teacher_bio',
           'group_timing.group_timing_link AS link', 'group_timing.day AS day','group_timing.time AS time', 'groups.id AS id']);
        }else{
          $this->data["Groups"] = DB::table('groups')
          ->leftJoin('group_user', 'groups.id', '=', 'group_user.group_id')
          ->leftJoin('users', 'group_user.user_id', '=', 'users.id')
          ->leftJoin('group_timing', 'group_timing.group_id', '=', 'groups.id')
          ->where('groups.trash' , 0)
          ->where('groups.course_id' , $course_id)
          ->where('groups.active' , 0)
          ->where('groups.user_level' , $user_level)
          ->where('groups.female_only' , 0)
          ->distinct()
          ->orderBy('groups.name', 'asc')
          ->get(['groups.name AS group_name','groups.active AS active', 'groups.female_only AS female_only',  'groups.user_level AS level','users.english_name AS user_name','users.bio AS teacher_bio',
           'group_timing.group_timing_link AS link', 'group_timing.day AS day','group_timing.time AS time', 'groups.id AS id']);

        }

        return view('indexes.Join_Group')->with('groups',$this->data["Groups"])->with('error',null);
      }
      else if($user_group_joined==0 && $user_course_joined==0)
      {
       $this->data["Groups"] = DB::table('user_course')
       ->where('course_id' , $course_id)
       ->where('user_id' , auth::user()->id);
       return view('indexes.Join_Group')->with('groups',$this->data["Groups"])->with('error','You are not registered in this course');
     }
     else
     {
      $this->data["Groups"] = DB::table('group_timing')
      ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
      ->leftJoin('group_timing_attendees', 'group_timing.id', '=', 'group_timing_attendees.group_timing_id')
                   // ->where('group_Timing.group_id' , $id)
      ->where('group_timing_attendees.user_id' , auth::user()->id)
      ->where('groups.active',0)
                //->distinct()
      ->where('groups.course_id' , $course_id)
      ->orderBy('group_timing.name', 'asc')
      ->get(['group_timing.id AS id', 'groups.name AS group_name', 'group_timing.group_id AS gid', 'group_timing.name AS name','group_timing.day AS day','group_timing.time AS time','group_timing.group_timing_link AS link','group_timing.active AS active'])


      ->toArray();
$user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();

      return view('group_info')->with('groups',$this->data["Groups"])->with('error',null)->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
    }


  }
}
//to be updated to Join_Group
public function Join_Group(Request $request)
{
  $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
  $group_timings=Group_Timing::where('group_id', $request->group_id)->get();
  $user_id=auth()->user()->id;

  $this->count = DB::table('group_timing_attendees')
  ->Join('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
  ->Join('groups', 'groups.id', '=', 'group_timing.group_id')
  ->where('groups.id' , $request->group_id)
  ->distinct('group_timing_attendees.user_id')
  ->count('group_timing_attendees.user_id');

  $user_joined = DB::table('group_timing_attendees')
  ->Join('group_timing', 'group_timing_attendees.group_timing_id', '=', 'group_timing.id')
  ->Join('groups', 'groups.id', '=', 'group_timing.group_id')
  ->where('groups.course_id' , $course_id)
  ->where('group_timing_attendees.user_id' , auth::user()->id)
  ->count();

  if($this->count<25 && $user_joined==0) {

    foreach($group_timings as $timing)
    {   
      Group_Timing_attendees::create([
        'group_timing_id' => $timing->id,
        'user_id'        =>$user_id,

      ]);

    }
    return redirect()->back();
  }
  else {

    return redirect()->back()->with('failed','This group\'s seats are reserved. Choose another group,please !جميع المقاعد محجوزة يرجى اختيار مجموعة أخرى');

  }

        //$data["updated_by"] = Auth::user()->id;
        //$data["created_by"] = Auth::user()->id;

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
    { $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;   

    $data = $request->all();
    if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources') && ($data["user_level"]==Auth::user()->level || Auth::user()->hasRole('SysAdministrator') ))
    {
            //

      $validator =  Validator::make($data, [
        'user_level' => 'required',
        'group_timing_link' => 'required',
        'day' => 'required',
        'time' => 'required',
        'user_id' => 'required'
      ],[
        'user_level.required' => 'يرجى تحديد المستوى',
        'group_timing_link.required' => 'يرجى تحديد رابط المجموعة',
        'day.required' => 'يرجى تحديد يوم اللقاء',
        'time.required' => 'يرجى تحديد ساعة اللقاء',
        'user_id.required' => 'يرجى تحديد الأستاذ المساعد'

      ]);

      if ($validator->fails())
      {
        return Response::json(array('errors' => $validator->getMessageBag()));
      }

            //$data["updated_by"] = Auth::user()->id;
      $data["created_by"] = Auth::user()->id;

      $level_string   = "Level." . $data["level_string"] . "/Gr";
      $last_group_id = Groups::where('trash' , 0)->where('name', 'LIKE', $level_string."%")->where('trash', 0)->where('course_id', $course_id)->orderBy('id', 'desc')->first();

      if(!isset($last_group_id))
      {
        $last_group_id = $level_string."1";
      }

      else
      {
        $last_group_id = $last_group_id->name;
        $id = substr($last_group_id , strpos($last_group_id, 'r') + 1);
        $id++; 
        $last_group_id = "Level.".$data["level_string"] . "/Gr" . $id;
      }

      $group_data["name"]       = $last_group_id;
      $group_data["user_level"] = $data["user_level"];
      $group_data["created_by"] = Auth::user()->id;
      $group_data["created_at"] = now();
      $group_data["female_only"] = $data["female_only"];
      $group_data["course_id"] = $course_id;
      $group_data["active"]     = 1;
      $Gid                      = Groups::insertGetId($group_data);

      if( $group_data["user_level"] == 1 || $group_data["user_level"] == 2 || $group_data["user_level"] == 3 ||
        $group_data["user_level"] == 4 )
      {
        for($i=1;$i<=16;$i++)
        {
          Group_Timing::create([
            'group_id' => $Gid,
            'name'        =>$i,
            'time' => $data["time"],
            'day' => $data["day"],
            'group_timing_link' => $data["group_timing_link"]
          ]);

        }
      }

      if( $group_data["user_level"] == 5 || $group_data["user_level"] == 6    )
      {
        for($i=1;$i<=12;$i++)
        {
          Group_Timing::create([
            'group_id' => $Gid,
            'name'        =>$i,
            'time' => $data["time"],
            'day' => $data["day"],
            'group_timing_link' => $data["group_timing_link"]
          ]);

        }
      }


      Group_User::create([
        'group_id' => $Gid,
        'user_id' => $data['user_id']
      ]);

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
      $this->data["RecordData"] = Group::find($id);
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
          'name' => 'required|unique',
        ],[
          'name.required' => 'الرجاء إدخال اسم المجموعة',
          'name.unique' => 'اسم المجموعة موجود مسبقا',
        ]);

        if ($validator->fails())
        {
          return Response::json(array('errors' => $validator->getMessageBag()));
        }

            //$data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 

        Group::where('id',$id)->update($data);
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

     //******fetch groups for teachers and assistants********** 
    public function fetch()
    {
        //
      $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id; 
      $user_id = Auth::user()->id;
      if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant') && Auth::user()->hasRole('SysAdministrator'))
      {
        $this->data["TableData"] = DB::table('groups')
        ->leftJoin('group_user', 'group_user.group_id', '=', 'groups.id')
        //->where('group_user.user_id' , $user_id )
        ->where('groups.trash' , 0 )
        ->where('groups.course_id' , $course_id )
        ->orderby('groups.user_level','asc')
        ->orderby('groups.id','asc')
        ->get(['groups.name AS name','groups.id AS id','groups.user_level AS user_level']);
      } else if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant') && Auth::user()->hasRole('Teacher'))
      {
        $this->data["TableData"] = DB::table('groups')
        ->leftJoin('group_user', 'group_user.group_id', '=', 'groups.id')
        ->where('groups.trash' , 0 )
        ->where('groups.course_id' , $course_id )
        ->where('groups.user_level' , Auth::user()->level )
        ->orderby('groups.user_level','asc')
        ->orderby('groups.id','asc')
        ->get(['groups.name AS name','groups.id AS id','groups.user_level AS user_level']);      
      } else if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
      {
        $this->data["TableData"] = DB::table('groups')
        ->leftJoin('group_user', 'group_user.group_id', '=', 'groups.id')
        ->where('group_user.user_id' , $user_id )
        ->where('groups.trash' , 0 )
        ->where('groups.course_id' , $course_id )
        ->orderby('groups.user_level','asc')
        ->orderby('groups.id','asc')
        ->get(['groups.name AS name','groups.id AS id','groups.user_level AS user_level']);      
      }

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
      Group::where('id',$id)->update(['trash' => 1]);
    }

    public function active($id)
    {
        //
      DB::table('groups')->where('user_level', $id)->update(array('active' => 0));
       return $this->notifStudents($id);


    }

    public function notifStudents($user_level)
    {

      $users = User::whereHas('user_course', function($q){
        $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
        $q->where('course_id', $course_id);
      })->where('level', $user_level)->get();

      \Notification::send($users, new Groups_Activation());
      return redirect()->back();



    }
    public function withdraw()
    {

     $user_id = $user_id = Auth::user()->id;
      $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
     Group_Timing_attendees::where("user_id",$user_id)->where("course_id", $course_id)->delete();
     return redirect()->back();
   }

 }
