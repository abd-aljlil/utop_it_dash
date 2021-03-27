<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\level_setting_exam_percent;
use Illuminate\Http\Request;
use App\Exam_Name;
use App\Groups;
use App\User;
use Response;

class level_setting_exam_percentController extends Controller
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
       
        if(Auth::user()->block==0 && Auth::user()->hasRole('Exam_Management'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'level'   => 'required|unique:level_setting_exam_percent,level,NULL,id,exam_name_index_id,'.$request->exam_name_index_id.',trash,0',
                'percent' => 'required'
                ],[
                'level.required'   => 'الرجاء تحديد المستوى',
                'level.unique'     => 'هذا المستوى مخصص مسبقا يرجى حذفه',
                'percent.required' => 'الرجاء ادخال النسبة المئوية',           
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            //$data["created_by"] = Auth::user()->id;
            level_setting_exam_percent::insert($data);
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
         
        $this->data["TableData"] = level_setting_exam_percent::where('trash' , 0)->where('exam_name_index_id',$id)->with('Exam_Name')->get();
        
        $this->data["Levels"]    = User::where('trash' , 0)->whereNotNull('level')->groupBy('level')->get(['level AS label', 'level as value']);
       
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
    public function fetch(Request $request)
    {
        //

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
        level_setting_exam_percent::where('id',$id)->update(['trash' => 1]);
    }

}
