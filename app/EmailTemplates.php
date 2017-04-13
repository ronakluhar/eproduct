<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmailTemplates extends Authenticatable
{
    use Notifiable;

    const DEFAULT_PASSWORD = 'sonawala123';
    protected $table = 'email_templates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'templatename',
        'templatepseudoname',
        'subject',
        'body',
        'created_at',
        'updated_at',
        'deleted',
    ];
}
