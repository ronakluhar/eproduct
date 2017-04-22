<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolFaculty extends Model
{
    protected $table = 'collage_faculty';

    protected $fillable = ['id', 'UnitID', 'Professors','Associate_professors','Assistant_professors','Intructors','Lecturers','No_academic_rank','created_at', 'updated_at'];
    
    
}
