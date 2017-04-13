<?php

namespace App\Services\EmailTemplate\Entities;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{

    protected $table = 'email_templates';
    protected $fillable = ['id', 'templatename', 'templatepseudoname', 'subject', 'body', 'deleted'];

}
