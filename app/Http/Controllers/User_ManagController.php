<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role_User;
use App\User;
use App\User_Course;
use App\Role;
use Response;
use App\Group_Timing_attendees;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
class User_ManagController extends Controller
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
        if(Auth::user()->block==0 && (Auth::user()->hasRole('Student_Resources')||Auth::user()->hasRole('SysAdministrator')))
        {
            return view('indexes.User_Manag');
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
        $data = $request->all();
        $validator =  Validator::make($data, [
            'name'     => 'required|unique',
            'email'    => 'required|unique|email',
            'password' => 'required|string|min:6',
            'level'    => 'required|numeric|min:1|max:1',

        ],[
            'name.required'     => 'الرجاء إدخال اسم المستخدم',
            'name.unique'       => 'اسم المستخدم موجود مسبقا',
            'email.required'    => 'الرجاء إدخال الإيميل',
            'email.unique'      => 'الإيميل موجود مسبقا',
            'password.required' => 'الرجاء إدخال كلمة السر',
            'level.required'    => 'الرجاء إدخال المسنوى',
            'level.numeric'     => 'الرجاء إدخال رقم'

        ]);

        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        //$data["updated_by"] = Auth::user()->id;
        //$data["created_by"] = Auth::user()->id;
        //User::insert($data);
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
        $this->data["RecordData"] = User::find($id);
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
        $this->data["RecordData"] = User::find($id);
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

        $data = $request->all();
        $validator =  Validator::make($data, [

            'level'    => 'required',

        ],[

            'level.required'    => 'الرجاء إدخال المسنوى',
            

        ]);

        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }
        $course=DB::table('course')->where('active','1')->first();
        User_Course::where('user_id',$id)->where('course_id' , $course->id)->update(['level' => $data['level']]);

        $data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 

        User::where('id',$id)->update($data);
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
        
        
        
        $this->data["RoleData"] = Role::where('trash' , 0)->get(['name AS label', 'id as value']);
       /*
        SELECT users.id, users.english_name, users.email, users.level, role_user.role_id,
        roles.description FROM `users` 
        JOIN `role_user` ON users.id = role_user.user_id 
        JOIN `roles` ON roles.id = role_user.role_id
       
        
        $this->data["TableData"] = DB::table('users')
        
         ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
         ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
         ->orderBy('users.id','desc')
         ->where('role_user.trash', 0)
         ->get();
               
        $this->data["RoleData"] = Role::where('trash' , 0)->get(['name AS label', 'id as value']);
         */ 
        $this->data["TableData"] = DB::table('users')
        
         ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
         ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
         ->orderBy('users.id','desc')
         ->where('role_user.trash', 0)
         ->get(['users.id as user_id','users.english_name','users.email', 'users.previous_student as previous_student', 'users.level', 'role_user.id as role_user', 'users.block as user_block', 'role_user.role_id as role_id', 'roles.id as value', 'roles.name as label', 'roles.description as description']);
            
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
        User::where('id',$id)->update(['trash' => 1]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        //
        User::where('id',$id)->update(['active' => 0]);
    }

    /**
     * Block user.
     *
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        //
        $data = User::find($id);
        $block = 0;
        if($data->block == 0)
            $block = 1;
        User::where('id',$id)->update(['block' => $block]);
        $course=DB::table('course')->where('active','1')->first();
        User_Course::where('user_id',$id)->where('course_id' , $course->id)->update(['block' => $block]);
        //Group_Timing_attendees::where('user_id',$data->id)->delete();
    }
    
}
