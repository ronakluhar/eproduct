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
use App\SchoolFaculty;
use App\SchoolLibrary;
use App\SchoolApplyAcceptedDetail;
use App\SchoolAwardLevelDetail;
use App\SchoolGraduationRateTimeDetail;
use App\SchoolROTCDetail;
use App\SchoolStudentsToFacultyDetail;
use App\SchoolStudyAbroadDetail;
use App\SchoolTeacherCertificationDetail;
use App\SchoolCompletion;
use App\SchoolDiversity;
use App\SchoolEndowment;

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
    
    //School Faculty import 
    public function saveSchoolFaculty($schoolFacultyDetail) 
    {        
        $schoolFaculty = SchoolFaculty::where('UnitID',$schoolFacultyDetail['UnitID'])->first();
       
        if (count($schoolFaculty) != null && count($schoolFaculty) > 0) {
            SchoolFaculty::where('UnitID', $schoolFacultyDetail['UnitID'])->update($schoolFacultyDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            SchoolFaculty::create($schoolFacultyDetail);
        }
        
    }
    
    //School LIbrary import 
    public function saveSchoolLibrary($schoolLibraryDetail) 
    {        
        $schoolLibrary = SchoolLibrary::where('UnitID',$schoolLibraryDetail['UnitID'])->first();
       
        if (count($schoolLibrary) != null && count($schoolLibrary) > 0) {
            SchoolLibrary::where('UnitID', $schoolLibraryDetail['UnitID'])->update($schoolLibraryDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            SchoolLibrary::create($schoolLibraryDetail);
        }
    }    
    /**
     * @return school_apply_accepted_detail Object
      Parameters
      @$schoolApplyAcceptedDetail : schoolApplyAcceptedDetail
    */
    public function save_school_apply_accepted_detail($school_apply_accepted_detail)
    {
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

    /**
     * @return school_students_to_faculty_detail Object
      Parameters
      @$school_students_to_faculty_detail : school_students_to_faculty_detail
    */
    public function save_school_students_to_faculty_detail($school_students_to_faculty_detail) {
        $school_students_to_faculty = $this->get_school_students_to_faculty_detail_by_unit_id($school_students_to_faculty_detail['UnitID']);
       
        $this->objSchoolStudentsToFaculty = new SchoolStudentsToFacultyDetail();
        if (count($school_students_to_faculty) != null && count($school_students_to_faculty) > 0) {
            $this->objSchoolStudentsToFaculty->where('UnitID', $school_students_to_faculty_detail['UnitID'])->update($school_students_to_faculty_detail);
        } else {
            $this->objSchoolStudentsToFaculty->create($school_students_to_faculty_detail);
        }
    }
    
    public function get_school_students_to_faculty_detail_by_unit_id($unit_id) {
        $this->objSchoolStudentsToFaculty = new SchoolStudentsToFacultyDetail();
        $school_students_to_faculty = $this->objSchoolStudentsToFaculty->where([['UnitID', $unit_id]])->first();
        return $school_students_to_faculty;
    }

    /**
     * @return school_study_abroad_detail Object
      Parameters
      @$school_study_abroad_detail : school_study_abroad_detail
    */
    public function save_school_study_abroad_detail($school_study_abroad_detail) {
        $school_study_abroad = $this->get_school_study_abroad_detail_by_unit_id($school_study_abroad_detail['UnitID']);
       
        $this->objSchoolStudyAbroad = new SchoolStudyAbroadDetail();
        if (count($school_study_abroad) != null && count($school_study_abroad) > 0) {
            $this->objSchoolStudyAbroad->where('UnitID', $school_study_abroad_detail['UnitID'])->update($school_study_abroad_detail);
        } else {
            $this->objSchoolStudyAbroad->create($school_study_abroad_detail);
        }
    }
    
    public function get_school_study_abroad_detail_by_unit_id($unit_id) {
        $this->objSchoolStudyAbroad = new SchoolStudyAbroadDetail();
        $school_study_abroad = $this->objSchoolStudyAbroad->where([['UnitID', $unit_id]])->first();
        return $school_study_abroad;
    }

    /**
     * @return school_study_abroad_detail Object
      Parameters
      @$school_study_abroad_detail : school_study_abroad_detail
    */
    public function save_school_teacher_certification_detail($school_teacher_certification_detail) {
        $school_teacher_certification = $this->get_school_teacher_certification_detail_by_unit_id($school_teacher_certification_detail['UnitID']);
       
        $this->objSchoolTeacherCertification = new SchoolTeacherCertificationDetail();
        if (count($school_teacher_certification) != null && count($school_teacher_certification) > 0) {
            $this->objSchoolTeacherCertification->where('UnitID', $school_teacher_certification_detail['UnitID'])->update($school_teacher_certification_detail);
        } else {
            $this->objSchoolTeacherCertification->create($school_teacher_certification_detail);
        }
    }
    
    public function get_school_teacher_certification_detail_by_unit_id($unit_id) {
        $this->objSchoolTeacherCertification = new SchoolTeacherCertificationDetail();
        $school_study_abroad = $this->objSchoolTeacherCertification->where([['UnitID', $unit_id]])->first();
        return $school_study_abroad;
    }
    
    //School Completions import 
    public function saveSchoolCompletions($schoolCompletionsDetail) 
    {        
        $schoolCompletion = SchoolCompletion::where('UnitID',$schoolCompletionsDetail['UnitID'])->first();
       
        if (count($schoolCompletion) != null && count($schoolCompletion) > 0) {
            SchoolCompletion::where('UnitID', $schoolCompletionsDetail['UnitID'])->update($schoolCompletionsDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            SchoolCompletion::create($schoolCompletionsDetail);
        }
    }
    
    //School Diversity import 
    public function saveSchoolDiversity($schoolDiversityDetail) 
    {        
        $schoolDiversity = SchoolDiversity::where('UnitID',$schoolDiversityDetail['UnitID'])->first();
       
        if (count($schoolDiversity) != null && count($schoolDiversity) > 0) {
            SchoolDiversity::where('UnitID', $schoolDiversityDetail['UnitID'])->update($schoolDiversityDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            SchoolDiversity::create($schoolDiversityDetail);
        }
    }
    
    //School Diversity import 
    public function saveSchoolEndowment($schoolEndowmentDetail) 
    {        
        $schoolEndowment = SchoolEndowment::where('UnitID',$schoolEndowmentDetail['UnitID'])->first();
       
        if (count($schoolEndowment) != null && count($schoolEndowment) > 0) {
            SchoolEndowment::where('UnitID', $schoolEndowmentDetail['UnitID'])->update($schoolEndowmentDetail);
            //$this->model->where('UnitID', $schoolDetail['UnitID'])->first();
        } else {
            SchoolEndowment::create($schoolEndowmentDetail);
        }
    }
    
    
}