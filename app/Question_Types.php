<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_Types extends Model
{
    //
    protected $table = "question_types";

 
    public function Exam_Name_Index_Questions()
    {
        return $this->belongsTo('App\Exam_Name_Index_Questions');
    }
}
