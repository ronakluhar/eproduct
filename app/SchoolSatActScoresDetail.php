<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolSatActScoresDetail extends Model {

    protected $table = 'college_sat_act_scores';
    protected $fillable = [
        'id',
        'UnitID',
        'Number_of_F-T_students_submitting_SAT_scores',
        'Percent_of_F-T_students_submitting_SAT_scores',
        'Number_of_F-T_students_submitting_ACT_scores',
        'Percent_of_F-T__students_submitting_ACT_scores',
        'SAT_Critical_Reading_25th_PCT_score',
        'SAT_Critical_Reading_75th_PCT_score',
        'SAT_Math_25th_PCT_score',
        'SAT_Math_75th_PCT_score',
        'SAT_Writing_25th_PCT_score',
        'SAT_Writing_75th_PCT_score',
        'ACT_Composite_25th_PCT_score',
        'ACT_Composite_75th_PCT_score',
        'ACT_English_25th_PCT_score',
        'ACT_English_75th_PCT_score',
        'ACT_Math_25th_PCT_score',
        'ACT_Math_75th_PCT_score',
        'ACT_Writing_25th_PCT_score',
        'ACT_Writing_75th_PCT_score',
        'created_at',
        'updated_at'
    ];

}
