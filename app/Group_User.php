<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_User extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_user';
    protected $fillable = [
        'group_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function Groups()
    {
        return $this->belongsTo('App\Groups');
    }
}
