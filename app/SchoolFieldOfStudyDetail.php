<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolFieldOfStudyDetail extends Model {

    protected $table = 'college_field_of_study';
    protected $fillable = [
        'id',
        'UnitID',
        'Education_All_Students_Total',
        'Education_Undergraduate_Total',
        'Education_Graduate',
        'Engineering_All_Students_Total',
        'Engineering_Undergraduate_Total',
        'Engineering_Graduate',
        'Biological_Sciences_Sciences_All_Students_Total',
        'Biological_Sciences_Sciences_Undergraduate_Total',
        'Biological_Sciences_Sciences_Graduate',
        'Mathematics_All_Students_Total',
        'Mathematics_Undergraduate_Total',
        'Mathematics_Graduate',
        'Physical_Sciences_All_Students_Total',
        'Physical_Sciences_Undergraduate_Total',
        'Physical_Sciences_Graduate',
        'Business_Mgmt_and_Administrative_Services_All_Students_Total',
        'Business_Mgmt_and_Administrative_Services_Undergraduate_Total',
        'Business_Mgmt_and_Administrative_Services_Graduate',
        'Law_(LLB_J.D.)_All_Students',
        'Law_(LLB_J.D.)_Full_time',
        'Law_(LLB_J.D.)_Part_time',
        'Dentistry_(D.D.S_D.M.D)_All_Students',
        'Dentistry_(D.D.S_D.M.D)_Full_time',
        'Dentistry_(D.D.S_D.M.D)_Part_time',
        'Medicine_(M.D)_All_Students',
        'Medicine_(M.D)_Full_time',
        'Medicine_(M.D)_Part_time',
        'created_at',
        'updated_at'
    ];

}
