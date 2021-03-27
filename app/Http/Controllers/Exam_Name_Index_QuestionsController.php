<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exam_Name_Index_Questions;
use App\Exam_Name_Index;
use Response;


class Exam_Name_Index_QuestionsController extends Controller
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
            $data = $request->except('answers','file', 'correct_answers','correct_answer');
            
            if ($request->answer_type=="صح أم خطأ") {
                $data["answer1"] = "True";
                $data["answer2"] = "False";
                $data["answer3"] = "Not given";
            }
            else
            {
                $myarray = $request->answers;
            if(isset($myarray[0]))
                $data["answer1"] = $myarray[0];
            if(isset($myarray[1]))
                $data["answer2"] = $myarray[1];
            if(isset($myarray[2]))
                $data["answer3"] = $myarray[2];
            if(isset($myarray[3]))
                $data["answer4"] = $myarray[3];
            }

            if($request->answer_type=="نص" || $request->answer_type=="صح أم خطأ")
                $data["correct_answer1"] = $request->correct_answer;
            else {
                $myarr = $request->correct_answers;
            if(isset($myarr[0]))
                $data["correct_answer1"] = $myarr[0];
            if(isset($myarr[1]))
                $data["correct_answer2"] = $myarr[1];
            if(isset($myarr[2]))
                $data["correct_answer3"] = $myarr[2];
            }


            if(isset($request->file))
            {
                $data["file"] = time() . rand() . '.' . $request->file->getClientOriginalExtension();
                $request->file->move('/home/utopians/public_html/utopians_dashboard/uploads/exam_questions_files', $data["file"]);
            }

            $validator =  Validator::make($data, [
                'exam_name_index_id' => 'required|numeric',
                'text' => 'required|string',
                'answer_type' => 'required',
                'question_percent' => 'required|numeric',
                ],[
                'exam_name_index_id.required' => 'الرجاء إدخال رقم الامتحان',
                'text.required' => 'الرجاء إدخال نص السؤال',
                'text.string' => 'الرجاء إدخال نص السؤال',
                'answer_type.required' => 'نوع الإجابة مطلوب',
                'question_percent.required'=> 'نسبة السؤوال مطلوبة',
                'question_percent.numeric'=> 'نسبة السؤوال مطلوبة'

            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
            
            //
            $data["created_at"] = now();
            $data["created_by"] = Auth::user()->id;
            $data['active']=1;
            Exam_Name_Index_Questions::insert($data);
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
        $this->data["QuestionData"] = Exam_Name_Index_Questions::find($id);
        $this->data["QuestionType"] = Exam_Name_Index_Questions::find($id)->Question_Types;
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
        $this->data["RecordData"]  = Exam_Name_Index_Questions::where('exam_name_index_id',$id)->where('trash',0)->get();
        $this->data["percent_sum"] = Exam_Name_Index_Questions::where('exam_name_index_id',$id)->where('trash',0)->sum('question_percent');
        $this->data["count"] = Exam_Name_Index_Questions::where('exam_name_index_id',$id)->where('trash',0)->count();
        return $this->data;
    }
    public function editOrder($id)
    {
        //
        $this->data["RecordData"]  = Exam_Name_Index_Questions::where('exam_name_index_id',$id)->where('trash',0)->get();
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
            $data = $request->except('answers','file', 'correct_answers','correct_answer');
            
            if ($request->answer_type=="صح أم خطأ") {
                $data["answer1"] = "True";
                $data["answer2"] = "False";
                $data["answer3"] = "Not given";
            }
            else
            {
                $myarray = $request->answers;
            if(isset($myarray[0]))
                $data["answer1"] = $myarray[0]["value"];
            if(isset($myarray[1]))
                $data["answer2"] = $myarray[1]["value"];
            if(isset($myarray[2]))
                $data["answer3"] = $myarray[2]["value"];
            if(isset($myarray[3]))
                $data["answer4"] = $myarray[3]["value"];
            }

            if($request->answer_type=="نص" || $request->answer_type=="صح أم خطأ" || $request->answer_type=="اختيار واحد من متعدد")
                $data["correct_answer1"] = $request->correct_answer;
            else {
                $myarr = $request->correct_answers;
            if(isset($myarr[0]))
                $data["correct_answer1"] = $myarr[0]["value"];
            if(isset($myarr[1]))
                $data["correct_answer2"] = $myarr[1]["value"];
            if(isset($myarr[2]))
                $data["correct_answer3"] = $myarr[2]["value"];
            }


            if(isset($request->file))
            {
                $data["file"] = time() . rand() . '.' . $request->file->getClientOriginalExtension();
                $request->file->move(public_path('/uploads/exam_questions_files'), $data["file"]);
            }

            $validator =  Validator::make($data, [
                'exam_name_index_id' => 'required|numeric',
                'text' => 'required|string',
                'answer_type' => 'required',
                'question_percent' => 'required|numeric',
                ],[
                'exam_name_index_id.required' => 'الرجاء إدخال رقم الامتحان',
                'text.required' => 'الرجاء إدخال نص السؤال',
                'text.string' => 'الرجاء إدخال نص السؤال',
                'answer_type.required' => 'نوع الإجابة مطلوب',
                'question_percent.required'=> 'نسبة السؤوال مطلوبة',
                'question_percent.numeric'=> 'نسبة السؤوال مطلوبة'

            ]);
             
            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }
            
            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now();
           
           
            Exam_Name_Index_Questions::where('id',$id)->update($data);
            Exam_Name_Index::where('id' , $data["exam_name_index_id"])->update(['active' => 1]);
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
        $this->data["TableData"] = Exam_Name_Index_Questions::where('trash' , 0)->get();
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
        Exam_Name_Index_Questions::where('id',$id)->update(['trash' => 1]);
    }


     /**
     * Trash the specified resource from view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePercent(Request $request)
    {
        //

        $data = $request->all();
        
        foreach ($request->Questions as $key => $value) {
           
            Exam_Name_Index_Questions::where('id',$value["id"])->update($value);
        }
        Exam_Name_Index::where('id',$request->id)->update(['active' => 0]);
        
    } 
	public function updateOrder(Request $request)
    {
        //

        $data = $request->all();
        
        foreach ($request->Questions as $key => $value) {
           
            Exam_Name_Index_Questions::where('id',$value["id"])->update($value);
        }
       // Exam_Name_Index::where('id',$request->id)->update(['active' => 0]);
        
    }
}
