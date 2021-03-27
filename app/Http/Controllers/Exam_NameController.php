<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exam_Name;
use Response;

class Exam_NameController extends Controller
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
        if(Auth::user()->hasRole('Exam_Management'))
        {
            return view('indexes.Exam_Name');
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
            'name' => 'required|unique:exam_name,name,NULL,id,trash,0'
            ],[
            'name.required' => 'الرجاء إدخال اسم الامتحان',
            'name.unique'   => 'اسم الامتحان موجود مسبقا',
           
        ]);
         
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        $data["created_at"] = now();
        $data["created_by"] = Auth::user()->id;
        Exam_Name::insert($data);
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
        $this->data["RecordData"] = Exam_Name::find($id);
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
        if(Auth::user()->hasRole('Exam_Management'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'name' => 'required|unique:exam_name,name,'.$id.',id,trash,0'
                ],[
                'name.required' => 'الرجاء إدخال اسم الامتحان',
                'name.unique'   => 'اسم الامتحان موجود مسبقا',
               
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 
           
            Exam_Name::where('id',$id)->update($data);
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
        $this->data["TableData"] = Exam_Name::where('trash' , 0)->get();

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
        Exam_Name::where('id',$id)->update(['trash' => 1]);
    }
}
