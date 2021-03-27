<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\Announcement;
use DB;

class AnnouncementController extends Controller
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
            

                    return view('indexes.Announcement');

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
    {    $data = $request->all();
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources') )
        {
            //
            
            
            $data = $request->all();
            $validator =  Validator::make($data, [
                'announcement' => 'required',
            ],[
                'announcement.required' => 'نص الإعلان مطلوب',
            ]);

            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            //$data["updated_by"] = Auth::user()->id;
            $data["created_by"] = Auth::user()->id;
            $data["created_at"] = now();

            Announcement::create($data);
           
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
        $this->data["RecordData"] = Announcement::find($id);
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
        if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
            $data = $request->all();
            $validator =  Validator::make($data, [
                'announcement' => 'required',
            ],[
                'announcement.required' => 'نص الإعلان مطلوب',
            ]);

            if ($validator->fails())
            {
                return Response::json(array('errors' => $validator->getMessageBag()));
            }

            $data["updated_by"] = Auth::user()->id;
            $data["updated_at"] = now(); 

            Announcement::where('id',$id)->update($data);
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
       if(Auth::user()->block==0 && Auth::user()->hasRole('Student_Resources'))
        {
            $this->data["Announcements"] = DB::table('announcement')
                    ->where('trash' , 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

                   return $this->data;

         }

        
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
        Announcement::where('id',$id)->update(['trash' => 1]);
    }

    public function active($id)
    {
        //
       // DB::table('groups')->update(array('active' => 0));
       //return $this->notifStudents();
        
        
    }

   
    
}
