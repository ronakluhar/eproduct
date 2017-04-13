<?php

namespace App\Services\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    protected $fillable = ['id', 'sender_id', 'receiver_id','sender_user_type','is_parent','message','title','receiver_read_status','created_at', 'updated_at', 'deleted'];       
}
