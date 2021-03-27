<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exam_Name_Index;
use App\Exam_Name;
use App\Groups;
use App\User;
use App\User_Course;
use Response;
use DB;

class Exam_Name_IndexController extends Controller
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
            return view('indexes.Exam_Name_Index');
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
        if(Auth::user()->hasRole('Exam_Management'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'exam_name_id' => 'required|numeric',
                'date'         => 'required|date',
                'period'       => 'required',
                'exam_percent' => 'required|numeric'
                ],[
                'exam_name_id.required' => 'الرجاء إدخال رقم الامتحان',
                'exam_name_id.numeric'  => 'الرجاء إدخال رقم الامتحان',
                'date.required'         => 'الرجاء إدخال التاريخ',
                'date.date'             => 'الرجاء إدخال صيغة تاريخ',
                'period.required'       => 'الرجاء إدخال الفترة',
                'exam_percent.required' => 'الرجاء إدخال نسبة الامتحان من 100',
                'exam_percent.numeric'  => 'الرجاء إدخال نسبة الامتحان من 100',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
            $data["code"]       = rand(pow(10, 4-1), pow(10, 4)-1);
            $data["active"]     = 1; 
            //
            $data["created_at"] = now();
            $data["created_by"] = Auth::user()->id;
            Exam_Name_Index::insert($data);
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
        
        $this->data["RecordData"] = Exam_Name_Index::find($id);
        $this->data["RecordData"]->date = strftime('%Y-%m-%dT%H:%M:%S', strtotime($this->data["RecordData"]->date));
        $this->data["Foreign"]= Exam_Name_Index::find($id)->Exam_Name;
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
                'exam_name_id' => 'required',
                'date' => 'required|date',
                'period' => 'required',
                'exam_percent' => 'required|numeric'
                ],[
                'exam_name_id.required' => 'الرجاء إدخال رقم الامتحان',
                'date.required' => 'الرجاء إدخال التاريخ',
                'date.date' => 'الرجاء إدخال صيغة تاريخ',
                'period.required' => 'الرجاء إدخال الفترة',
                'exam_percent.numeric'  => 'الرجاء إدخال نسبة الامتحان من 100',
            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now();
            Exam_Name_Index::where('id',$id)->update($data);
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
        $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
        $this->data["TableData"] = Exam_Name_Index::where('trash' , 0)->with('Exam_Name')->orderby('course_id','desc')->orderby('exam_name_id','asc')->get();
        $this->data["Exam_Name"] = Exam_Name::where("trash", 0)
                                    ->get(['exam_name.name AS label', 'id as value'])
                                    ->toArray();
        $this->data["Levels"]    = User_Course::groupBy('level')->where('course_id' , $course_id)->get(['level AS label', 'level as value']);
        $this->data["Groups"]    = Groups::where('trash' , 0)->where('course_id' , $course_id)->get(['name AS label', 'id as value']);
        $this->data["Users"]     = User::where('trash' , 0)->get(['english_name AS label', 'id as value']);
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
        Exam_Name_Index::where('id',$id)->update(['trash' => 1]);
    }
}
