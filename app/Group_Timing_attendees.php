<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_Timing_Attendees extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_timing_attendees';
    protected $fillable = [
        'user_id', 'group_timing_id','available','fluency', 'pronunciation' ,'over_all_achievement' ,'grammar','composition_skills', 'average'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
