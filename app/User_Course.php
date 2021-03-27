<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Course extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_course';
    protected $fillable = [
        'id', 'user_id', 'course_id', 'level'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
