<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Lessons_Archive_Files;
use Illuminate\Http\Request;
use App\Lessons_Archive;
use App\File;
use Response;

class Lessons_Archive_FilesController extends Controller
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
            return view('indexes.Lessons_Archive_Files');
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
    {ini_set('memory_limit', '-1');
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
            //
            //return $request->all();
            $validator =  Validator::make($request->all(), [
                'lessons_archive_id' => 'required',
                'file'   => 'required|mimes:doc,pdf,docx,jpg,jpeg,png'
                ],[
                'lessons_index_id.required' => 'الرجاء ادخال رقم الدرس',
                'file.required' => 'الرجاء إرفاق ملف'
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            $data = $request->except('file');
            $data["file"] = time() . rand() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move('/home/utopians/public_html/utopians_dashboard/uploads/lessons_files', $data["file"]);
            
            //$data["updated_by"] = Auth::user()->id;
            $data["created_by"] = Auth::user()->id;
            Lessons_Archive_Files::insert($data);
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
        $this->data["RecordData"]      = Lessons_Archive_Files::Where('trash' , 0)->Where('lessons_archive_id' , $id)->get();
        $this->data["Lessons_Archive"] = Lessons_Archive::find($id);
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
        $this->data["RecordData"] = Lessons_Archive_Files::find($id);
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'lessons_archive_id' => 'required|numeric',
                'file'   => 'required|mimes:doc,pdf,docx'
                ],[
                'lessons_index_id.required' => 'الرجاء ادخال رقم الدرس',
                'lessons_index_id.numeric' => 'الرجاء ادخال رقم الدرس',
                'file.required' => 'الرجاء إرفاق ملف'
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
           
            Lessons_Archive_Files::where('id',$id)->update($data);
            $data["updated_by"] = Auth::user()->id;
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
        $this->data["TableData"] = Lessons_Archive_Files::where('trash' , 0)->get();
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
        Lessons_Archive_Files::where('id',$id)->update(['trash' => 1]);
    }
}
