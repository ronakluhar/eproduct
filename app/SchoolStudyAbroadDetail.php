<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolStudyAbroadDetail extends Model {

    protected $table = 'collage_study_abroad_study';
    protected $fillable = [
        'id',
        'UnitID',
        'Study_abroad',
        'Weekend_college',
        'created_at',
        'updated_at'
    ];

}
