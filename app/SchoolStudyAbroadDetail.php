<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolStudyAbroadDetail extends Model {

    protected $table = 'collage_students_to_faculty';
    protected $fillable = [
        'id',
        'UnitID',
        'Full_time_retention_rate',
        'Total_students_undergraduate_fall',
        'Student_to_faculty_ratio',
        'created_at',
        'updated_at'
    ];

}
