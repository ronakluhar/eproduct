<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolApplyAcceptedDetail extends Model {

    protected $table = 'collage_apply_accepted';
    protected $fillable = [
        'id',
        'UnitID',
        'Applicants_total',
        'Applicants_men',
        'Applicants_women',
        'Admissions_total',
        'Admissions_men',
        'Admissions_women',
        'Enrolled_total',
        'Enrolled_men',
        'Enrolled_women',
        'Enrolled_full_time_total',
        'Enrolled_full_time_men',
        'Enrolled_full_time_women',
        'Enrolled_part_time_total',
        'Enrolled_part_time_men',
        'Enrolled_part_time_women',
        'created_at',
        'updated_at'
    ];
    
}
