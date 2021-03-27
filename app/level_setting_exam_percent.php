<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class level_setting_exam_percent extends Model
{
    //
    protected $table = "level_setting_exam_percent";

   
    public function Exam_Name()
	{
		return $this->hasOne(Exam_Name::class, 'id', 'exam_name_index_id');
	}
}
