<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam_Name_Index extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_name_index';

    public function Exam_Name()
    {
      return $this->hasOne(Exam_Name::class , 'id' , 'exam_name_id');
    }
}
