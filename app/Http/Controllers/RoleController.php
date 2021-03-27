<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Response;

class RoleController extends Controller
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
        //return view('indexes.Role');
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
        if(Auth::user()->hasRole('SysAdministrator'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'name' => 'required|unique',
                'description' => 'required|string',
                ],[
                'name.required' => 'الرجاء إدخال اسم الدور',
                'description.required' => 'الرجاء إدخال الوصف',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            //$data["created_by"] = Auth::user()->id;
            Role::insert($data);
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
        $this->data["RecordData"] = Role::find($id);
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('SysAdministrator'))
        {

            $data = $request->all();
            $validator =  Validator::make($data, [
                'name' => 'required|unique',
                'description' => 'required|string',
                ],[
                'name.required' => 'الرجاء إدخال اسم المستخدم',
                'description.required' => 'الرجاء إدخال الوصف',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 
           
            Role::where('id',$id)->update($data);
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
        $this->data["TableData"] = Role::where('trash' , 0)->get();
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
        Role::where('id',$id)->update(['trash' => 1]);
    }
}
