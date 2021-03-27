<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group_Timing;
use App\Group_Timing_attendees;
use App\Groups;
use Response;
use DB;
use App\Notifications\Group_Timing_Change;
use App\User;

class Group_TimingController extends Controller
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
        {
            return view('indexes.Group_Timing');
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
        if(Auth::user()->hasRole('Teacher_Assistant'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'group_id' => 'required',
                'time' => 'required',
                'day' => 'required',
                'group_timing_link' => 'required'
                ],[
                'group_id.required' => 'الرجاء إدخال رقم المجموعة',
                'time.required' => 'الرجاء إدخال الوقت',
                'day.required' => 'الرجاء اختيار يوم اللقاء',
                'group_timing_link.required' => 'الرجاء إدخال رابط المجموعة',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            //$data["created_by"] = Auth::user()->id;
            $data['active']=1;
            Group_Timing::insert($data);
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
        //showing one group timing detail
        $this->data["RecordData"] = DB::table('group_timing')
            ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
            ->where('group_timing.id' , $id)
            ->get(['groups.name AS name','group_timing.id AS id', 'groups.user_level AS level','group_timing.day AS day', 
                   'group_timing.time AS time','group_timing.group_timing_link AS link','group_timing.active AS active'])
            ->first();
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
        //$user_id = Auth::user()->id;
        //showing all group timing details for one group
        $this->data["RecordData"] = DB::table('group_timing')
            ->leftJoin('groups', 'groups.id', '=', 'group_timing.group_id')
            ->leftJoin('group_user', 'group_user.group_id', '=', 'group_timing.group_id')
            ->where('group_timing.group_id' , $id)
            //->where('group_user.user_id' , $user_id)
            ->get(['groups.name AS group_name','group_timing.id AS id', 'group_timing.group_id AS gid', 'group_timing.name AS name', 'groups.user_level AS level','group_timing.day AS day','group_timing.time AS time','group_timing.group_timing_link AS link','group_timing.active AS active'])
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
                'time' => 'required',
                'day' => 'required',
                'group_timing_link' => 'required'
                ],[
                'time.required' => 'الرجاء إدخال الوقت',
                'day.required' => 'الرجاء اختيار يوم اللقاء',
                'group_timing_link.required' => 'الرجاء إدخال رابط المجموعة'
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }


            //$data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 
           
            Group_Timing::where('id',$id)->update($data);
            $name=Group_Timing::find($id)->name;
            $users=Group_Timing_attendees::where('group_timing_id',$id)->get(['user_id'])->toArray();
            return $this->notifSessionChange($users,$name);
        }
    }
    public function notifSessionChange($users,$name)
    {
        
        $user=User::find($users);
        \Notification::send($user, new Group_Timing_Change($name));

        
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
        //$this->data["TableData"] = Group_Timing::where('trash' , 0)->with('Groups')->get();
        
      //  $this->data["Groups"] = Groups::where("trash", 0)
        //                            ->get(['Groups.name AS label', 'id as value'])
          //                          ->toArray();

        $user_level = Auth::user()->user_level;
        //showing all group timing details for one group
        
        //return $this->data;
        //$this->data["TableData"] = Group_Timing::where('trash' , 0)->get();
        //return $this->data;
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
        Group_Timing::where('id',$id)->update(['trash' => 1]);
    }

    public function active($id)
    {
        //
        $data = Group_Timing::find($id);
        $active = 0;
        if($data->active == 0)
            $active = 1;
        Group_Timing::where('id',$id)->update(['active' => $active]);
    }
}
