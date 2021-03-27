<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group_User;
use App\Group_Timing;
use App\Groups;
use App\User;
use Response;
use DB;

class Group_UserController extends Controller
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
            return view('indexes.Groups');
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
        //
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'user_id' => 'required',
                'group_id' => 'required'
                ],[
                'user_id.required' => 'الرجاء إدخال رقم المستخدم',
                'group_id.unique' => 'الرجاء إدخال رقم المجموعة',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            $data["created_by"] = Auth::user()->id;
            $data["created_at"] = now();
            Role_User::insert($data);
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
        //$this->data["RecordData"] = Group_User::find($id);
        // $this->data["Groups"] = Groups::where('trash' , 0)->get();
       //$this->data["RecordData"] = Groups::find($id);
       // $this->data["Foreign"] = Group_User::where('group_id' , $id)->with('Groups')->get();
        $this->data["Group"] = DB::table('groups')
            ->leftJoin('group_user', 'groups.id', '=', 'group_user.group_id')
            ->leftJoin('users', 'group_user.user_id', '=', 'users.id')
            ->where('groups.id' , $id)

            ->get(['groups.name AS group_name', 'groups.user_level AS level','users.english_name AS user_name', 
                   'groups.id AS id', 'users.id AS user_id',])
            ->first();

       

        $this->data["teachers"] =  DB::table('users')
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            
            ->where('roles.name','Teacher_Assistant')
            ->get(['users.english_name AS label', 'users.id as value'])
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
        //
        if(Auth::user()->hasRole('Student_Resources'))
        {

            $data = $request->all();
            $validator =  Validator::make($data, [
                'user_id' => 'required',
                
                ],[
                'user_id.required' => 'الرجاء إدخال رقم المستخدم',
               
            ]);

            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now();
            $this->data["RecordData"] = Group_User::where('group_id',$id)->get()->count();
            $num=$this->data["RecordData"];

            if($num==1)
            Group_User::where('group_id',$id)->update($data);
            else
            Group_User::insert($data);
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
       // $this->data["Groups"] = Groups::where('trash' , 0)->get();
 $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id; 
     if(Auth::user()->block==0 && Auth::user()->hasRole('SysAdministrator') && Auth::user()->hasRole('Student_Resources'))
        {
            $this->data["Groups"] = DB::table('groups')
            ->leftJoin('group_user', 'groups.id', '=', 'group_user.group_id')
            ->leftJoin('users', 'group_user.user_id', '=', 'users.id')
            ->leftJoin('group_timing', 'group_timing.group_id', '=', 'groups.id')
            ->where('groups.trash' , 0)
            ->where('groups.course_id' , $course_id )
            //->where('groups.user_level', auth()->user()->level)
->where('group_timing.name' , 12 )
            ->distinct()->orderBy('groups.course_id', 'desc')
            ->orderBy('groups.user_level', 'asc')
            ->orderBy('groups.id', 'asc')
            
            ->get(['groups.name AS group_name','groups.active AS active', 'groups.female_only AS female_only',  'groups.user_level AS level','users.english_name AS user_name',
             'group_timing.group_timing_link AS link', 'group_timing.day AS day','group_timing.time AS time', 'groups.id AS id', 'groups.course_id As course_number']);
        } 
        elseif(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
         $this->data["Groups"] = DB::table('groups')
         ->leftJoin('group_user', 'groups.id', '=', 'group_user.group_id')
         ->leftJoin('users', 'group_user.user_id', '=', 'users.id')
         ->leftJoin('group_timing', 'group_timing.group_id', '=', 'groups.id')
         ->where('groups.trash' , 0)
         ->where('groups.user_level', auth()->user()->level)
         ->where('groups.course_id' , $course_id )
->where('group_timing.name' , 12 )
         ->distinct()->orderBy('groups.course_id', 'desc')
         ->orderBy('groups.user_level', 'asc')
         ->orderBy('groups.id', 'asc')
         
         ->get(['groups.name AS group_name','groups.active AS active', 'groups.female_only AS female_only',  'groups.user_level AS level','users.english_name AS user_name',
             'group_timing.group_timing_link AS link', 'group_timing.day AS day','group_timing.time AS time', 'groups.id AS id', 'groups.course_id As course_number']);
     }

        $this->data["teachers"] =  DB::table('users')
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name','Teacher_Assistant')
            ->where('users.block',0)
            ->get(['users.english_name AS label', 'users.id as value'])
            ->toArray();

       
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
        Group_User::where('group_id',$id)->update(['trash' => 1]);
        Group_Timing::where('group_id',$id)->update(['trash' => 1]);
        Groups::where('id',$id)->update(['trash' => 1]);
    }
}