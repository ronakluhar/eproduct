<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolROTCDetail extends Model {

    protected $table = 'collage_rotc';
    protected $fillable = [
        'id',
        'UnitID',
        'ROTC',
        'ROTC_Army',
        'ROTC_Navy',
        'ROTC_Air_Force',
        'created_at',
        'updated_at'
    ];

}
