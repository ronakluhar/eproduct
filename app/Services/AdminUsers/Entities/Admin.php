<?php

namespace App\Services\AdminUsers\Entities;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = [
        'first_name', 
        'last_name',
        'gender',
        'email',
        'phone',
        'verification_token',
        'deleted',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];
    
    
}
