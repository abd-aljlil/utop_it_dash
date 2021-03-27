<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    //
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    public function user()
    {
      return $this->hasOne(User::class , 'id' , 'user_id' );
    }

    public function role()
    {
      return $this->hasOne(Role::class , 'id' , 'role_id');
    }
}
