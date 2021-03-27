<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Lessons_Archive;
use App\Lessons_Index;
use Response;

class Lessons_ArchiveController extends Controller
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
        //
            return view('indexes.Lessons_Archive');
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'date' => 'required|unique:lessons_archive,date,NULL,id,lessons_index_id,'.$request->lessons_index_id.',trash,0',
                ],[
                'date.required' => 'الرجاء ادخال تاريخ الامتحان',
                'date.unique'   => 'يوجد درس محدد في هذا اليوم',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            $data["created_by"] = Auth::user()->id;
            Lessons_Archive::insert($data);
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
        $this->data["RecordData"]    = Lessons_Archive::Where('trash' , 0)->Where('lessons_index_id' , $id)->get();
        $this->data["Lessons_Index"] = Lessons_Index::find($id);
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
        $this->data["RecordData"] = Lessons_Archive::find($id);
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
                'date' => 'required|unique:lessons_archive,date,NULL,id,lessons_index_id,'.$request->lessons_index_id.',trash,0',
                ],[
                'date.required' => 'الرجاء ادخال تاريخ الامتحان',
                'date.unique'   => 'يوجد درس محدد في هذا اليوم',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
           
            Lessons_Archive::where('id',$id)->update($data);
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
        $this->data["TableData"] = Lessons_Archive::where('trash' , 0)->get();
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
        Lessons_Archive::where('id',$id)->update(['trash' => 1]);
    }

    public function active($id)
    {
        //
        $data = Lessons_Archive::find($id);
        $active = 0;
        if($data->active == 0)
            $active = 1;
        Lessons_Archive::where('id',$id)->update(['active' => $active]);
    }

    
}
