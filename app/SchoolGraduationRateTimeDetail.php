<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolGraduationRateTimeDetail extends Model {

    protected $table = 'collage_graduation_rate_time';
    protected $fillable = [
        'id',
        'UnitID',
        'Total_cohort',
        'men',
        'women',
        'Bachelor_degree_4_years',
        'Bachelor_degree_5_years',
        'Bachelor_degree_6_years',
        'created_at',
        'updated_at'
    ];

}
