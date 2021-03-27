<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'announcement';
    protected $fillable = [
        'id', 'announcement', 'created_at', 'created_by'
    ];

}
