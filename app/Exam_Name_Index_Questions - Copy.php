<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam_Name_Index_Questions extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_name_index_questions';
    protected $fillable = [
        'text', 'exam_percent','correct_answer1','file','link','answer_type'
    ];
    
    
    public function Question_Types()
    {
      return $this->hasOne(Question_Types::class , 'id' , 'question_types_id');
    }

    public function Exam_Name_Index_Questions_Users()
    {
      return $this->hasMany(Exam_Name_Index_Questions_Users::class , 'exam_name_index_questions_id' , 'id');
    }
}
