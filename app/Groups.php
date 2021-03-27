<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';
    protected $fillable = [
        'name', 'user_level', 'course_id'
    ];
    public function Group_user()
    {
        return $this->hasOne('App\Group_user'); 
    }
}
