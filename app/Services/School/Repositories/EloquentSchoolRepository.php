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
use App\SchoolApplyAcceptedDetail;
use App\SchoolAwardLevelDetail;
use App\SchoolGraduationRateTimeDetail;
use App\SchoolROTCDetail;

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
    
    /**
     * @return school_apply_accepted_detail Object
      Parameters
      @$schoolApplyAcceptedDetail : schoolApplyAcceptedDetail
    */
    public function save_school_apply_accepted_detail($school_apply_accepted_detail) {
        $school_apply_accepted = $this->get_school_apply_accepted_detail_by_unit_id($school_apply_accepted_detail['UnitID']);
       
        $this->objSchoolApplyAccepted = new SchoolApplyAcceptedDetail();
        if (count($school_apply_accepted) != null && count($school_apply_accepted) > 0) {
            $this->objSchoolApplyAccepted->where('UnitID', $school_apply_accepted_detail['UnitID'])->update($school_apply_accepted_detail);
        } else {
            $this->objSchoolApplyAccepted->create($school_apply_accepted_detail);
        }
    }
    
    public function get_school_apply_accepted_detail_by_unit_id($unit_id) {
        $this->objSchoolApplyAccepted = new SchoolApplyAcceptedDetail();
        $school_apply_accepted = $this->objSchoolApplyAccepted->where([['UnitID', $unit_id]])->first();
        return $school_apply_accepted;
    }
    
    /**
     * @return school_award_level_detail Object
      Parameters
      @$school_award_level_detail : school_award_level_detail
    */
    public function save_school_award_level_detail($school_award_level_detail) {
        $school_award_level = $this->get_school_award_level_detail_by_unit_id($school_award_level_detail['UnitID']);
       
        $this->objSchoolAwardLevel = new SchoolAwardLevelDetail();
        if (count($school_award_level) != null && count($school_award_level) > 0) {
            $this->objSchoolAwardLevel->where('UnitID', $school_award_level_detail['UnitID'])->update($school_award_level_detail);
        } else {
            $this->objSchoolAwardLevel->create($school_award_level_detail);
        }
    }
    
    public function get_school_award_level_detail_by_unit_id($unit_id) {
        $this->objSchoolAwardLevel = new SchoolAwardLevelDetail();
        $school_award_level = $this->objSchoolAwardLevel->where([['UnitID', $unit_id]])->first();
        return $school_award_level;
    }

    /**
     * @return school_graduation_rate_time_detail Object
      Parameters
      @$school_graduation_rate_time_detail : school_graduation_rate_time_detail
    */
    public function save_school_graduation_rate_time_detail($school_graduation_rate_time_detail) {
        $school_graduation_rate_time = $this->get_school_graduation_rate_time_detail_by_unit_id($school_graduation_rate_time_detail['UnitID']);
       
        $this->objSchoolGraduationRateTime = new SchoolGraduationRateTimeDetail();
        if (count($school_graduation_rate_time) != null && count($school_graduation_rate_time) > 0) {
            $this->objSchoolGraduationRateTime->where('UnitID', $school_graduation_rate_time_detail['UnitID'])->update($school_graduation_rate_time_detail);
        } else {
            $this->objSchoolGraduationRateTime->create($school_graduation_rate_time_detail);
        }
    }
    
    public function get_school_graduation_rate_time_detail_by_unit_id($unit_id) {
        $this->objSchoolGraduationRateTime = new SchoolGraduationRateTimeDetail();
        $school_graduation_rate_time = $this->objSchoolGraduationRateTime->where([['UnitID', $unit_id]])->first();
        return $school_graduation_rate_time;
    }

    /**
     * @return school_ROTC_detail Object
      Parameters
      @$school_ROTC_detail : school_ROTC_detail
    */
    public function save_school_ROTC_detail($school_ROTC_detail) {
        $school_ROTC = $this->get_school_ROTC_detail_by_unit_id($school_ROTC_detail['UnitID']);
       
        $this->objSchoolROTC = new SchoolROTCDetail();
        if (count($school_ROTC) != null && count($school_ROTC) > 0) {
            $this->objSchoolROTC->where('UnitID', $school_ROTC_detail['UnitID'])->update($school_ROTC_detail);
        } else {
            $this->objSchoolROTC->create($school_ROTC_detail);
        }
    }
    
    public function get_school_ROTC_detail_by_unit_id($unit_id) {
        $this->objSchoolROTC = new SchoolROTCDetail();
        $school_ROTC = $this->objSchoolROTC->where([['UnitID', $unit_id]])->first();
        return $school_ROTC;
    }
}