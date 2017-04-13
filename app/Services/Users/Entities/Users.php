<?php

namespace App\Services\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable = ['id', 'first_name', 'last_name','gender','username','email','password','phone','verification_token','facebook_id','facebook_token','twitter_id', 'twitter_token', 'remember_token','created_at', 'updated_at', 'deleted'];
    
    
}
