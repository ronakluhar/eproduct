<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolTeacherCertificationDetail extends Model {

    protected $table = 'collage_teacher_certification';
    protected $fillable = [
        'id',
        'UnitID',
        'Below_postsecondary_level',
        'Students_can_complete_areas_of_specialization',
        'Students_must_complete_pre_at_another_inst_areas_of_spe',
        'Approved_by_the_state_initial_certifcation',
        'created_at',
        'updated_at'
    ];

}
