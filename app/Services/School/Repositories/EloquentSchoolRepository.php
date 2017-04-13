<?php

namespace App\Services\School\Repositories;

use DB;
use Auth;
use Config;
use Helpers;
use App\Services\School\Contracts\SchoolRepository;
use App\Services\Repositories\Eloquent\EloquentBaseRepository;
use App\Services\School\Entities\School;
use App\Admin;

class EloquentSchoolRepository extends EloquentBaseRepository implements SchoolRepository {

    /**
     * @return UserDetail Object
    */
    public function getAllSchoolsData()
    {
        $schoolData = $this->model->where('deleted', '<>', 3)->get();
        //$usersData = $this->model->get();
        return $schoolData;
    }
    /**
     * @return UserDetail Object
      Parameters
      @$userDetail : userDetail
    */
    public function saveSchoolDetail($schoolDetail) {
        $school = $this->getSchoolDetailByUnitId($schoolDetail['UnitID']);
       
        if (count($school) != null && count($school) > 0) {
            $this->model->where('UnitID', $schoolDetail['UnitID'])->update($schoolDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            $this->model->create($schoolDetail);
        }
        
    }

    /**
     * @return Boolean True/False
      Parameters
      @$email : User's email
     */
    public function checkSchoolIdExist($email, $id = '') {
        if ($id != '') {
            $user = $this->model->where([['deleted', '<>', 3],['email','=', $email],['id', '!=', $id]])->first();
        } else {
            $user = $this->model->where([['deleted', '<>', 3],['email','=', $email]])->first();
        }

        if (count($user) > 0) {
            return true;
        } else {
            return false;
        }
    }

   

    /**
     * @return Boolean True/False
      Parameters
      @$id : User ID
     */
    public function deleteSchool($id) {
        $flag = true;
        $user = $this->model->find($id);
        $user->deleted = config::get('constant.DELETED_FLAG');
        $response = $user->save();
        if ($response) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSchoolDetailById($profileData) {
        $return = $this->model->where('id', $profileData['id'])->update($profileData);

        return $return;
    }

    public function getSchoolDetailByUnitId($unitId) {
        $school = $this->model->where([['deleted', '<>', 3],['UnitID', $unitId]])->first();
        return $school;
    }
}