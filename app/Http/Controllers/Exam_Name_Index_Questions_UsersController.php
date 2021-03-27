<?php

namespace App\Http\Controllers;

use App\Exam_Name_Index_Questions_Users;
use Illuminate\Support\Facades\Auth;
use App\level_setting_exam_percent;
use App\Exam_Name_Index_Questions;
use App\Exam_Name_Index_Users;
use App\Exam_Name_Index;
use App\Notifications\StudentExamResult;
use Illuminate\Http\Request;
use App\user;
use App\User_Course;
use Response;
use DB; 

class Exam_Name_Index_Questions_UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('my_exams_info');
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

    public function search(Request $request)
    {
        $data["user_id"] = Auth::user()->id;

        if($request->ajax()){

            $output="";

            $results= DB::table('exam_name_index_questions_users')
            ->select('exam_name_index_questions.text as question','answer as student_answer','exam_name_index_questions.correct_answer1 as correct_answer')
            ->join('exam_name_index_questions','exam_name_index_questions.id','=','exam_name_index_questions_users.exam_name_index_questions_id')
            ->join('exam_name_index','exam_name_index_questions.exam_name_index_id','=','exam_name_index.id')
                    ->where('user_id','=',$data["user_id"])//13
                    ->where('exam_name_index.code','=', $request->search)//8008
                    ->where('exam_name_index_questions.question_percent','!=', 0.00)
                    ->groupBy('exam_name_index_questions_users.exam_name_index_questions_id', 'exam_name_index_questions.id','text','answer','correct_answer1')
                    ->orderBy('exam_name_index_questions.id')
                    ->get();
             $mark= DB::table('exam_name_index_users')
            ->select('result')
            ->join('exam_name_index','exam_name_index_users.exam_name_index_id','=','exam_name_index.id')
                    ->where('user_id','=',$data["user_id"])//13
                    ->where('exam_name_index.code','=', $request->search)//8008
                    ->where('exam_name_index_users.trash','!=', 1)
                    ->first();

               // $output .= "Student name : ".$students->user->english_name."    Level : ".$students->user->level."";

                    if(count($results)>0)
                    {
                        $output .= "<table class='table'><tbody>
                        <thead>
                        <th>Question text</th>
                        <th>Your answer</th>                                
                        <th>The right answer</th>
                        </thead>";


                        foreach ($results as $result) {
                   // dd($result->group_name);
                            if($result->student_answer!=$result->correct_answer)
                            {
                                $output .= "<tr><td>".$result->question."</td>
                                <td>".$result->student_answer."</td>
                                <td>".$result->correct_answer."</td>";
                            }
                        }

                        $output .= "</tbody></table>";
                        $output .= "<p style='color:orange'>Your mark is : <b>".$mark->result." </b></p>";
                        return Response($output); 
                    } 
                    else
                    {
                        $output="<p style='color:red'>Are you sure you wrote the code correctly?!!</p> 
                                 <p style='color:red'>You haven't done this exam yet or there is no mistakes for this exam code in your records!<p>";
                        return Response($output);
                    }

                }

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

ini_set('memory_limit', '-1');
        $data = [];
        $data["user_id"] = Auth::user()->id;
        $answers = $request->answers;
        $first_question_pointer = 0;

        if(isset($request->answers) && $request->active==1)
        {
            foreach ($answers as $key => $value) {
                if($value == null)
                    continue;
                elseif(is_array($value) && (count($value) > 0))
                {
                    foreach ($value as $checkbox_key => $checkbox_value) {
                        if($checkbox_value == null)
                            continue;
                        if($first_question_pointer == 0)
                        {
                                //this will remove old answers
                            $exam_name_index_id           = Exam_Name_Index_Questions::find($key);
                            $exam_name_index_id            = $exam_name_index_id->exam_name_index_id;

                            $exam_name_index_questions    = Exam_Name_Index_Questions::where('exam_name_index_id',$exam_name_index_id)->get();

                            foreach ($exam_name_index_questions as $exam_name_index_questions_key => $exam_name_index_questions_value) {
                                Exam_Name_Index_Questions_Users::where("exam_name_index_questions_id",$exam_name_index_questions_value["id"])->where("user_id",$data["user_id"])->delete();
                                $first_question_pointer++;
                            }
                        }
                        $data["exam_name_index_questions_id"] = $key;
                        $data["answer"]                       = $checkbox_value;
                        Exam_Name_Index_Questions_Users::insert($data);
                    }
                }
                else {
                    $data["exam_name_index_questions_id"] = $key;
                    $data["answer"]                       = $value;
                    Exam_Name_Index_Questions_Users::where("exam_name_index_questions_id",$key["id"])->where("user_id",$data["user_id"])->delete();
                    Exam_Name_Index_Questions_Users::insert($data);
                }
                $exam_name_index_id    = Exam_Name_Index_Questions::find($key);
                $exam_name_index_id    = $exam_name_index_id->exam_name_index_id;
                $exam_percent          = Exam_Name_Index::where('id', $exam_name_index_id)->first()->exam_percent;
                Exam_Name_Index_Users::where('exam_name_index_id' , $exam_name_index_id)->where('user_id' , $data["user_id"])->update(['active' => $request->active]);


            }

        }


        if($request->active == 1)
        {   
            $answer_percent     = 0;
            $user_answers_total = 0;

            $exam_questions = DB::SELECT('SELECT id , answer1 , answer2 , answer3 , answer4 , correct_answer1 , correct_answer2 , correct_answer3 , question_percent from exam_name_index_questions WHERE exam_name_index_id = ' . $exam_name_index_id . ' and trash = 0');

            //set $exam_answers_total as a count of correct answers
            foreach ($exam_questions as $key => $value) {
                $exam_answers_total = 0;


                if($value->correct_answer1 != "محجوز يرجى حذفه" );
                {
                    $exam_answers_total++;
                }
                if($value->correct_answer2 != "محجوز يرجى حذفه" );
                {
                    $exam_answers_total++;
                }
                if($value->correct_answer3 != "محجوز يرجى حذفه" );
                {
                    $exam_answers_total++;
                }

                //set $answer_percent as an answer percent 
                $result = 0;

                $user_answer    = DB::SELECT('SELECT answer from exam_name_index_questions_users WHERE  exam_name_index_questions_id = ' . $value->id . ' and trash = 0 and user_id = ' . $data["user_id"]);

                //$user_answers_total sum of user correct answers
                foreach ($user_answer as $user_answer_key => $user_answer_value) {
                    if($user_answer_value->answer == $value->correct_answer1 || $user_answer_value->answer == $value->correct_answer2 || $user_answer_value->answer == $value->correct_answer3)
                    {
                        $user_answers_total += $value->question_percent;


                    }
                }

            }
            $result = $user_answers_total*$exam_percent/100;
            $result = sprintf('%0.2f', $result);

            Exam_Name_Index_Users::where('exam_name_index_id',$exam_name_index_id)->where('user_id',$data["user_id"])->where('result',0.00)->update(['result' => $result]);
            $user=User::find($data["user_id"]);
            $info= DB::table('exam_name_index_users')
            ->select('exam_name_index_users.result','exam_name.english_name as exam_name')
            ->join('exam_name_index','exam_name_index.id','=','exam_name_index_users.exam_name_index_id')
            ->join('exam_name','exam_name_index.exam_name_id','=','exam_name.id')
            ->where('exam_name_index_id',$exam_name_index_id)->where('user_id',$data["user_id"])->get()->first();
            \Notification::send($user, new StudentExamResult($info));
            $exam_name_id=Exam_Name_Index::where('id', $exam_name_index_id)->first()->exam_name_id;
            $current_course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
            if($exam_name_id==17||$exam_name_id==20)
                User_Course::where('user_id', $data["user_id"])->where('course_id', $current_course_id)->where('midterm_test_mark',0.00)->update(['midterm_test_mark' => $result ]);
            else if($exam_name_id==18||$exam_name_id==19)
                User_Course::where('user_id', $data["user_id"])->where('course_id', $current_course_id)->where('final_test_mark',0.00)->update(['final_test_mark' => $result ]);
            else if($exam_name_id==1)
                User_Course::where('user_id', $data["user_id"])->where('course_id', $current_course_id)->where('placement_test_mark',0.00)->update(['placement_test_mark' => $result ]);

            if($exam_name_index_id==1){
                
                $levels_percent = level_setting_exam_percent::where('exam_name_index_id',$exam_name_index_id)->orderBy('level', 'desc')->get();

                foreach ($levels_percent as $key => $value) {
                    if($info->result >= $value->percent )
                    {
                        $level = $value->level;
                        user::where('id', $data["user_id"])->update(['level' => $level ]);
                        //$current_course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
                        User_Course::where('user_id', $data["user_id"])->where('course_id', $current_course_id)->update(['level' => $level ]);
                        break;
                    }
                }
            }//closeif $exam_name_index_id==1
            
        }//close if request active

        
    }//end function

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
        $this->data["RecordData"] = Exam_Name_Index_Questions_Users::find($id);
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
            'exam_name_index_questions_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'answer' => 'required|string'
        ],[
            'exam_name_index_id.required' => 'الرجاء إدخال رقم الامتحان',
            'exam_name_index_id.numeric' => 'الرجاء إدخال رقم الامتحان',
            'user_id.required' => 'الرجاء إدخال رقم المستخدم',
            'user_id.numeric' => 'الرجاء إدخال رقم المستخدم',
            'answer.required' => 'الرجاء إدخال الجواب',
            'answer.numeric' => 'الرجاء إدخال الجواب' 
        ]);

        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        Exam_Name_Index_Questions_Users::where('id',$id)->update($data);
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
        $this->data["TableData"] = Exam_Name_Index_Questions_Users::where('trash' , 0)->get();
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
        Exam_Name_Index_Questions_Users::where('id',$id)->update(['trash' => 1]);
        $fileName = Exam_Name_Index_Questions_Users::find($id)->answer;
        if(file_exists(public_path('/uploads/answer_files/'.$fileName))){        
            unlink(public_path('/uploads/answer_files/'.$fileName));
        }
    }

    public function UploadFile(Request $request)
    {
        $this->data["id"]   = 1;
        $this->data["name"] = $request->file->getClientOriginalName();
        $data = [];
        $data["user_id"] = Auth::user()->id;
        $data["answer"] = time() . rand() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('/uploads/answer_files'), $data["answer"]);
        $data["exam_name_index_questions_id"] = $request->exam_name_index_questions_id;
        $this->data["id"]   = Exam_Name_Index_Questions_Users::insertGetId($data);
        $this->data["name"] = $request->file->getClientOriginalName();
        return $this->data;
    }

}
