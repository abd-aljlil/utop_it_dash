<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Exam_Name_Index_Users;
use App\Exam_Name_Index;
use Illuminate\Http\Request;
use App\Group_User;
use App\User;
use DB;
use App\Notifications\Exam_Info;
use Notification;

class Exam_Name_Index_UsersContoller extends Controller
{
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
        $levels                     = $request->levels;
        $groups                     = $request->groups;
        $users                      = $request->users;
        $data["exam_name_index_id"] = $request->exam_name_index_id;  

        if(isset($levels))
        {
            foreach ($levels as $levels_key => $levels_value) {
                $users = User::where('trash',0)->where('block',0)->where('level',$levels_value)->get();
                foreach ($users as $users_key => $users_value) {
                    $data["user_id"] = $users_value->id;
                    $validator =  Validator::make($data, [
                        'user_id' => 'unique:exam_name_index_users,user_id,NULL,id,exam_name_index_id,'.$data["exam_name_index_id"].',trash,0'
                        ],[
                        'name.unique'   => 'طالب مكرر',
                    ]);
                     
                    if (!$validator->fails())
                    {
                        Exam_Name_Index_Users::Insert($data);
                        $user=User::find($data["user_id"]); $id=$data["exam_name_index_id"];
                        $info= Exam_Name_Index::find($id);
                        \Notification::send($user, new Exam_Info($info));
                    }
                }
            }
        }

        if(isset($groups))
        {
            foreach ($groups as $groups_key => $groups_value) {
                $users = Group_User::where('trash',0)->where('group_id',$groups_value["value"])->get();
                foreach ($users as $users_key => $users_value) {
                    $data["user_id"] = $users_value->user_id;
                    $validator =  Validator::make($data, [
                        'user_id' => 'unique:exam_name_index_users,user_id,NULL,id,exam_name_index_id,'.$data["exam_name_index_id"].',trash,0'
                        ],[
                        'name.unique'   => 'طالب مكرر',
                    ]);
                     
                    if (!$validator->fails())
                    {
                        Exam_Name_Index_Users::Insert($data);
                        $user=User::find($data["user_id"]); $id=$data["exam_name_index_id"];
                        $info= Exam_Name_Index::find($id);
                        \Notification::send($user, new Exam_Info($info));
                
                    }

                }
            }
        }

        if(isset($users))
        {
            foreach ($users as $users_key => $users_value) {
                $data["user_id"] = $users_value["value"];
                if($data["user_id"] != null)
                {
                $validator =  Validator::make($data, [
                    'user_id' => 'unique:exam_name_index_users,user_id,NULL,id,exam_name_index_id,'.$data["exam_name_index_id"].',trash,0'
                ],[
                    'name.unique'   => 'طالب مكرر',
                ]);

                if (!$validator->fails())
                {
                    Exam_Name_Index_Users::Insert($data);
                }
                
                $user=User::find($data["user_id"]); $id=$data["exam_name_index_id"];
                $info= Exam_Name_Index::find($id);
                \Notification::send($user, new Exam_Info($info));
                
                }//end if
            }
            
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
        //$this->data["users"] = DB::Select('Select id , english_name from users where trash = 0 and id in (Select user_id from group_user where trash = 0 and group_id =  ' . $id . ')');
        /*$this->data["users"] = DB::table('users')
            ->Join('exam_name_index_users', 'exam_name_index_users.user_id', '=', 'users.id')
            ->where('exam_name_index_users.exam_name_index_id' , $id)->where('exam_name_index_users.trash' , 0)
            ->get(['users.english_name AS english_name','exam_name_index_users.id AS id' , 'IF(exam_name_index_users.active=0,"لم يخضع للامتحان","اجتاز الاختبار")' , 'exam_name_index_users.result as result']);
            */
        $this->data["users"] = DB::SELECT('select users.english_name as english_name, exam_name_index_users.id as id, IF(exam_name_index_users.active=0,"لم يخضع للامتحان","اجتاز الامتحان") as active, CONCAT(" % " ,exam_name_index_users.result) as result from users inner join exam_name_index_users on exam_name_index_users.user_id = users.id where exam_name_index_users.exam_name_index_id = ' . $id . ' and exam_name_index_users.trash = 0');
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
     * Trash the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        //
    Exam_Name_Index_Users::where('id',$id)->update(['trash' => 1]);
    }

    public function updateCounter(Request $request)
    {
        //
        $counter = Exam_Name_Index_Users::find($request->id);
        Exam_Name_Index_Users::where('id',$request->id)->update(['time_counter' => $counter->time_counter + 1]);
    }
    
}
