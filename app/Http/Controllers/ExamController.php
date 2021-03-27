<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exam_Name_Index;
use App\Exam_Name_Index_Users;
use App\Exam_Name_Index_Questions;
use App\Exam_Name_Index_Questions_Users;
use DateInterval;
use Response;
use DateTime;

class ExamController extends Controller
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
        //ini_set('memory_limit', '-1');
        if(Auth::user()->block==0 )
        {ini_set('memory_limit', '-1');
            return view('indexes.Exam');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {ini_set('memory_limit', '-1');
        if(Auth::user()->block==0 )
        {
            $user_id = Auth::user()->id;
            $this->data["exam_name_index"] = Exam_Name_Index::where('trash' , 0)->where('code',$code)->first();
            $exam_name_index_users = Exam_Name_Index_Users::where('trash' , 0)->where('active' , 0)->where('exam_name_index_id',$this->data["exam_name_index"]->id)->where('user_id',$user_id)->first();
             if($exam_name_index_users == "")
            {
                $this->data["error"] = "You don't have permission to access this exam";
                return $this->data;
            }
            
            if($this->data["exam_name_index"] == "")
            {
                $this->data["error"] = "The exam code is not valid!";
                return $this->data;
            }

            date_default_timezone_set("Turkey");
            $Exam_Date  = strtotime($this->data["exam_name_index"]->date);
            $Now        = strtotime(now());
            $this->data["TimeToExam"] = $Exam_Date - $Now;
            //$this->data["TimeToFinish"] = intval ((($Exam_Date +  ($this->data["exam_name_index"]->period) * 60 ) - $Now)/60);
            $this->data["TimeToFinish"] = intval ($this->data["exam_name_index"]->period - $exam_name_index_users->time_counter);
            if($this->data["TimeToExam"] > 0 )
            {
                $this->data["error"] = "The exam will start on " . $this->data["exam_name_index"]->date;
                return $this->data;
            }

            
            if($this->data["TimeToFinish"] <= 0 )
            {
                $this->data["error"] = "The exam has finished";
                return $this->data;
            }
            
            $this->data["exam_name_index_users_id"] = $exam_name_index_users->id;
            $this->data["exam_name_index_questions"] = Exam_Name_Index_Questions::where('trash',0)->where('exam_name_index_id',$exam_name_index_users->exam_name_index_id)->with('question_types')->with('exam_name_index_questions_users')->orderby('question_order')->orderby('exam_name_index_questions.id')->get();
            foreach ($this->data["exam_name_index_questions"] as $key => $value) {
                foreach ($value->exam_name_index_questions_users as $exam_name_index_questions_users_key => $exam_name_index_questions_users_value) {
                    if($exam_name_index_questions_users_value["user_id"] != $user_id )
                        unset($this->data["exam_name_index_questions"][$key]["exam_name_index_questions_users"][$exam_name_index_questions_users_key]);
                }
            }
           
            return $this->data;
        }
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

   
    
}
