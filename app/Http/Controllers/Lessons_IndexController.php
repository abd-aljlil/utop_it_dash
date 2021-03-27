<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Lessons_Index;
use App\User;
use App\User_Course;
use Response;
use DB;
use App\Notifications\New_Lesson;


class Lessons_IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //
        if(Auth::user()->block==0 && Auth::user()->hasRole('Coordinator'))
        {
            return view('indexes.Lessons_Index');
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

    public function notify($level)
    {

        $users = User::whereHas('user_course', function($q){
        $course_id=DB::table('course')->where('trash' , 0)->where('active', 1)->first()->id;
           $q->where('course_id', $course_id);
       })->where('level', $level)->get();
        \Notification::send($users, new New_Lesson());
        return redirect('Lessons_Index');


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
            'level' => 'required',
        ],[
            'level.required' => 'الرجاء اختيار المستوى'
        ]);

        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }

        $level_string   = $data["level_string"] . "/";
        $level = $data["level"];
        $last_lesson_id = Lessons_Index::where('trash' , 0)->where('name', 'LIKE', "%".$level_string."%")->where('trash', 0)->orderBy('id', 'desc')->first();
        
        if(!isset($last_lesson_id))
        {
            $last_lesson_id = $data["level_string"] . "/unit 1";
        }

        else
        {
            $last_lesson_id = $last_lesson_id->name;
            $id = substr($last_lesson_id , strpos($last_lesson_id, 't') + 1);
            $id++; 
            $last_lesson_id = $data["level_string"] . "/unit " . $id;
        }
        
        $data = [];
        $data["name"] = $last_lesson_id;
        $data["user_level"] = $level;

        //$data["updated_by"] = Auth::user()->id;
        $data["created_by"] = Auth::user()->id;
        $data["created_at"] = now();
        Lessons_Index::insert($data);
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
        $this->data["RecordData"] = Lessons_Index::find($id);
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
            'name' => 'required|unique:lessons_index,name,'.$id.',id,trash,0',
        ],[
            'name.required' => 'الرجاء ادخال اسم الدرس',
            'name.unique'   => 'اسم الدرس موجود مسبقا',
        ]);

        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()));
        }


        Lessons_Index::where('id',$id)->update($data);
        $data["updated_by"] = Auth::user()->id;
        $data["updated_at"] = now();
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
        $level=auth()->user()->roles->first()->level;
        
         $this->data["TableData"] = Lessons_Index::where('trash' , 0)->orderby('user_level','asc')->get();

     $this->data["levels"]    = User_Course::whereNotNull('level')->groupBy('level')->get(['level AS label', 'level as value']);
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
        Lessons_Index::where('id',$id)->update(['trash' => 1]);
    }

    public function Student_Lessons()
    {
$user_id = Auth::user()->id;
        
        $users = User::find($user_id);

        $course=DB::table('course')->where('active','1')->first();
    $user_course_joined = DB::table('user_course')
    ->where('course_id' , $course->id)
    ->where('user_id' , auth::user()->id)
    ->count();
            


      if(Auth::user()->block==0 && Auth::user()->hasRole('Teacher_Assistant'))
      {
          $lessons = DB::table('lessons_index')
          ->select('lessons_index.id','lessons_index.name','lessons_archive.id','lessons_archive.lessons_index_id','lessons_archive.date')
          ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
          ->where('lessons_index.trash',0)
          ->where('lessons_archive.trash',0)
          ->where('lessons_archive.active',0)
          ->where('lessons_archive.date','<=',date('Y-m-d'))
          //->where('lessons_index.user_level',auth()->user()->level)
          ->orderBy('lessons_index.user_level','asc')
          ->orderBy('lessons_archive.date','asc')
          ->get();

          $files = DB::table('lessons_index')
          ->select('lessons_archive_files.file','lessons_archive.id as id')
          ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
          ->join('lessons_archive_files','lessons_archive_files.lessons_archive_id','=','lessons_archive.id')
          ->where('lessons_archive_files.trash',0)
          ->where('lessons_archive_files.active',0)
          ->get();


          return view('lessons_info',compact('lessons','files'))->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
      } else if(Auth::user()->block==0 && Auth::user()->hasRole('Students'))
      {
          $lessons = DB::table('lessons_index')
          ->select('lessons_index.id','lessons_index.name','lessons_archive.id','lessons_archive.lessons_index_id','lessons_archive.date')
          ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
          ->where('lessons_index.trash',0)
          ->where('lessons_archive.trash',0)
          ->where('lessons_archive.active',0)
          ->where('lessons_archive.date','<=',date('Y-m-d'))
          ->where('lessons_index.user_level',auth()->user()->level)
          ->orderBy('lessons_archive.date','asc')
          ->get();

          $files = DB::table('lessons_index')
          ->select('lessons_archive_files.file','lessons_archive.id as id')
          ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
          ->join('lessons_archive_files','lessons_archive_files.lessons_archive_id','=','lessons_archive.id')
                    ->where('lessons_archive_files.active',0)
          ->where('lessons_archive_files.trash',0)
          ->get();


          return view('lessons_info',compact('lessons','files'))->with(['users' => $users])->with('course',$course)->with('user_joined',$user_course_joined);
      }
  }


  public function previous_lesson()
  {
     if(Auth::user()->block==0)
     {
      $count = DB::table('lessons_index')
      ->select('lessons_index.id','lessons_index.name','lessons_archive.id','lessons_archive.lessons_index_id','lessons_archive.date')
      ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
      ->where('lessons_index.trash',0)
      ->where('lessons_archive.trash',0)
      ->where('lessons_archive.active',0)
      ->where('lessons_archive.date','<=',date('Y-m-d'))
      ->where('lessons_index.user_level',auth()->user()->level)
      ->get()
      ->count();

      $lessons = DB::table('lessons_index')
      ->select('lessons_index.id','lessons_index.name','lessons_archive.id','lessons_archive.lessons_index_id','lessons_archive.date')
      ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
      ->where('lessons_index.trash',0)
      ->where('lessons_archive.trash',0)
      ->where('lessons_archive.active',0)
      ->where('lessons_archive.date','<=',date('Y-m-d'))
      ->orderBy('lessons_archive.date','asc')
      ->where('lessons_index.user_level',auth()->user()->level)
      ->skip($count-2)
      ->take(1)
      ->get();

      $files = DB::table('lessons_index')
      ->select('lessons_archive_files.file','lessons_archive.id as id')
      ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
      ->join('lessons_archive_files','lessons_archive_files.lessons_archive_id','=','lessons_archive.id')
      ->where('lessons_archive_files.trash',0)
          ->where('lessons_archive_files.active',0)
      ->get();
      return view('lessons_info',compact('lessons','files'));
  }
}
public function latest_lesson()
{
    if(Auth::user()->block==0)
    {
      $lessons = DB::table('lessons_index')
      ->select('lessons_index.id','lessons_index.name','lessons_archive.id','lessons_archive.lessons_index_id','lessons_archive.date')
      ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
      ->where('lessons_index.trash',0)
      ->where('lessons_archive.trash',0)
      ->where('lessons_archive.active',0)
      ->where('lessons_archive.date','<=',date('Y-m-d'))
      ->orderBy('lessons_archive.date','desc')
      ->where('lessons_index.user_level',auth()->user()->level)
      ->limit(1)

      ->get();

      $files = DB::table('lessons_index')
      ->select('lessons_archive_files.file','lessons_archive.id as id')
      ->join('lessons_archive','lessons_archive.lessons_index_id','=','lessons_index.id')
      ->join('lessons_archive_files','lessons_archive_files.lessons_archive_id','=','lessons_archive.id')
      ->where('lessons_archive_files.trash',0)
          ->where('lessons_archive_files.active',0)
      ->get();


      return view('lessons_info',compact('lessons','files'));
  }
}


}
