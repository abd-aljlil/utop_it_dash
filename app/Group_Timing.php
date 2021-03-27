<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_Timing extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_timing';
    protected $fillable = [
        'group_id', 'time','day','group_timing_link','name'
    ];
    
    public function Groups()
    {
      return $this->hasOne(Groups::class , 'id' , 'group_id');
    }
}