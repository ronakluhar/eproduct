<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolAwardLevelDetail extends Model {

    protected $table = 'collage_award_level';
    protected $fillable = [
        'id',
        'UnitID',
        'Associate_degree',
        '4_years_certificate',
        'Bachelor_degree',
        'Postbaccalaureate_certificate',
        'Master_degree',
        'Post_master_certificate',
        'Doctor_degree_research',
        'Doctor_degree_professional_practice',
        'Doctor_degree_other',
        'Other_degree',
        'created_at',
        'updated_at'
    ];

}
