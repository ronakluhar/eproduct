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
}
