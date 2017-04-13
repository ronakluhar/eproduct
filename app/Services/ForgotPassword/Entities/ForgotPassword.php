<?php

namespace App\Services\ForgotPassword\Entities;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table = 'forgot_password';

    protected $fillable = [
        'id',
        'users_id',
        'forgot_token',
        'users_type',
        'is_active',
        'created_at',
        'updated_at',
    ];
}
