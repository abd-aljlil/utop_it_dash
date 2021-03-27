<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';
    protected $fillable = [ 'id', 'name' ,'start_date','end_date','mid_term_test_date','final_test_date', 'created_at','created_by' ];

}
