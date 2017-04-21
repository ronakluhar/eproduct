<?php

namespace App\Services\School\Contracts;

use App\Services\Repositories\BaseRepository;
use App\Services\School\Entities\School;

interface SchoolRepository extends BaseRepository
{
    /**
     * @return array of all active Users in the application
    */
    public function getAllSchoolsData();

    /**
     * Save User detail passed in $userDetail array
    */
    public function saveSchoolDetail($schoolDetail);

    /**
     * $return boolean value for email exist in application
    */
    public function checkSchoolIdExist($schoolId, $id = '');

    /**
     * Delete user detail by user id
    */
    public function deleteSchool($id);

    public function updateSchoolDetailById($schoolData);

    public function getSchoolDetailByUnitId($id);

    /**
     * Save School Apply Accepted detail passed in $schoolApplyAcceptedDetail array
    */
    public function save_school_apply_accepted_detail($school_apply_accepted_detail);
    
    public function get_school_apply_accepted_detail_by_unit_id($unit_id);

    /**
     * Save School Award Level detail passed in $school_award_level_detail array
    */
    public function save_school_award_level_detail($school_award_level_detail);
    
    public function get_school_award_level_detail_by_unit_id($unit_id);
}
