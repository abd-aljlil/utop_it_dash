<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role_User;
use Response;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
class Role_UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    protected function updateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->except('_token');
        $validator =  Validator::make($data, [
            'english_name'   => 'required|string|max:255',
            'arabic_name'    => 'required|string|max:255',
            'birthdate'      => 'required|date',
            'email'          => 'required|string|email|max:255|unique:users',
            'preferred_time'=>   'required',
            'university'     => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'country'        =>'required|string|max:255',
            'city'           => 'required|string|max:255'
        ]);
         
        if ($validator->fails())
        {
            $this->showProfile()->with(['errors' => $validator]);
        }

        //$data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 
       
        User::where('id',$user_id)->update($data);
        $users = User::find($user_id);


        return $this->showProfile();
                        
        
    }




    protected function showProfile()
    {
        $user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_courses = DB::table('user_course')
    // ->where('course_id','<' ,  $course->id)
     ->where('course_id','<=' ,  $course->id)
     ->where('course_id','>' , 5)//we started issueing certificates on our website from the 6th course
    ->where('user_id' , auth::user()->id)
    ->select('course_id')->get();
        return view('profile')->with(['users' => $users])->with('course',$course)->with('user_courses',$user_courses);
       
        
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
            'user_id' => 'required',
            'role_id' => 'required'
            ],[
            'user_id.required' => 'الرجاء إدخال رقم المستخدم',
            'role_id.unique' => 'الرجاء إدخال رقم الدور',
        ]);
         
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        //$data["updated_by"] = Auth::user()->id;
        //$data["created_by"] = Auth::user()->id;
        Role_User::insert($data);
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
        $this->data["RecordData"] = Role_User::where('id',$id)->with('role')->with('user')->get()->first();
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
        $this->data["RecordData"] = Role_User::find($id);
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
            'user_id' => 'required',
            'role_id' => 'required'
            ],[
            'user_id.required' => 'الرجاء إدخال رقم المستخدم',
            'role_id.unique' => 'الرجاء إدخال رقم الدور',
        ]);
         
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }


        //$data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now(); 
       
        Role_User::where('id',$id)->update($data);
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
        $this->data["TableData"] = Role_User::where('trash' , 0)->get();
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
        Role_User::where('id',$id)->update(['trash' => 1]);
    }
}
