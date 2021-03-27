<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Marks extends Model
{
    //
    protected $table = 'user_marks';

    protected $fillable = [
    	'user_id',
    	'interview_fluency',
    	'interview_vocabulary',
    	'interview_comprehension',
    	'interview_grammar',
    	'interview_pronunciation',
    ];
}
