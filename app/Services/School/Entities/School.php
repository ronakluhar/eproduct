<?php

namespace App\Services\School\Entities;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'school';

    protected $fillable = ['id', 'UnitID', 'Name','City','State','Web_Address','OPEID','Title_IV_Institution','Control','Level','Institution_Category','Carnegie_Classification', 'Award_levels', 'Religious_Affiliation','Calendar_System','Reporting_Method','Campus_Setting','Distance_Learning','created_at', 'updated_at', 'deleted'];
    
    
}
