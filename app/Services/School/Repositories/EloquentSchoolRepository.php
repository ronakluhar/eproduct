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
use App\SchoolFieldOfStudyDetail;
use App\SchoolFinancialAidDetail;
use App\SchoolNetPriceInStateDetail;
use App\SchoolNetPriceOutStateDetail;
use App\SchoolSatActScoresDetail;
use App\SchoolTuitionFeesDetail;
use App\SchoolLogoDetail;

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
    
    /**
     * @return school_field_of_study_detail Object
      Parameters
      @$school_field_of_study_detail : school_field_of_study_detail
    */
    public function save_school_field_of_study_detail($school_field_of_study_detail) {
        $school_field_of_study = $this->get_school_field_of_study_detail_by_unit_id($school_field_of_study_detail['UnitID']);
       
        $this->objSchoolFieldOfStudy = new SchoolFieldOfStudyDetail();
        if (count($school_field_of_study) != null && count($school_field_of_study) > 0) {
            $this->objSchoolFieldOfStudy->where('UnitID', $school_field_of_study_detail['UnitID'])->update($school_field_of_study_detail);
        } else {
            $this->objSchoolFieldOfStudy->create($school_field_of_study_detail);
        }
    }
    
    public function get_school_field_of_study_detail_by_unit_id($unit_id) {
        $this->objSchoolFieldOfStudy = new SchoolFieldOfStudyDetail();
        $school_field_of_study = $this->objSchoolFieldOfStudy->where([['UnitID', $unit_id]])->first();
        return $school_field_of_study;
    }

    /**
     * @return save_school_financial_aid_detail Object
      Parameters
      @$save_school_financial_aid_detail : save_school_financial_aid_detail
    */
    public function save_school_financial_aid_detail($school_financial_aid_detail) {
        $school_financial_aid = $this->get_school_financial_aid_detail_by_unit_id($school_financial_aid_detail['UnitID']);
       
        $this->objSchoolFinancialAid = new SchoolFinancialAidDetail();
        if (count($school_financial_aid) != null && count($school_financial_aid) > 0) {
            $this->objSchoolFinancialAid->where('UnitID', $school_financial_aid_detail['UnitID'])->update($school_financial_aid_detail);
        } else {
            $this->objSchoolFinancialAid->create($school_financial_aid_detail);
        }
    }
    
    public function get_school_financial_aid_detail_by_unit_id($unit_id) {
        $this->objSchoolFinancialAid = new SchoolFinancialAidDetail();
        $school_financial_aid = $this->objSchoolFinancialAid->where([['UnitID', $unit_id]])->first();
        return $school_financial_aid;
    }

    /**
     * @return save_school_net_price_in_state_detail Object
      Parameters
      @$save_school_net_price_in_state_detail : save_school_net_price_in_state_detail
    */
    public function save_school_net_price_in_state_detail($school_net_price_in_state_detail) {
        $school_net_price_in_state = $this->get_school_net_price_in_state_detail_by_unit_id($school_net_price_in_state_detail['UnitID']);
       
        $this->objSchoolNetPriceInState = new SchoolNetPriceInStateDetail();
        if (count($school_net_price_in_state) != null && count($school_net_price_in_state) > 0) {
            $this->objSchoolNetPriceInState->where('UnitID', $school_net_price_in_state_detail['UnitID'])->update($school_net_price_in_state_detail);
        } else {
            $this->objSchoolNetPriceInState->create($school_net_price_in_state_detail);
        }
    }
    
    public function get_school_net_price_in_state_detail_by_unit_id($unit_id) {
        $this->objSchoolNetPriceInState = new SchoolNetPriceInStateDetail();
        $school_net_price_in_state = $this->objSchoolNetPriceInState->where([['UnitID', $unit_id]])->first();
        return $school_net_price_in_state;
    }

    /**
     * @return save_school_net_price_out_state_detail Object
      Parameters
      @$save_school_net_price_out_state_detail : save_school_net_price_out_state_detail
    */
    public function save_school_net_price_out_state_detail($school_net_price_out_state_detail) {
        $school_net_price_out_state = $this->get_school_net_price_out_state_detail_by_unit_id($school_net_price_out_state_detail['UnitID']);
       
        $this->objSchoolNetPriceOutState = new SchoolNetPriceOutStateDetail();
        if (count($school_net_price_out_state) != null && count($school_net_price_out_state) > 0) {
            $this->objSchoolNetPriceOutState->where('UnitID', $school_net_price_out_state_detail['UnitID'])->update($school_net_price_out_state_detail);
        } else {
            $this->objSchoolNetPriceOutState->create($school_net_price_out_state_detail);
        }
    }
    
    public function get_school_net_price_out_state_detail_by_unit_id($unit_id) {
        $this->objSchoolNetPriceOutState = new SchoolNetPriceOutStateDetail();
        $school_net_price_out_state = $this->objSchoolNetPriceOutState->where([['UnitID', $unit_id]])->first();
        return $school_net_price_out_state;
    }

    /**
     * @return save_school_sat_act_scores_detail Object
      Parameters
      @$save_school_sat_act_scores_detail : save_school_sat_act_scores_detail
    */
    public function save_school_sat_act_scores_detail($school_sat_act_scores_detail) {
        $school_sat_act_scores = $this->get_school_sat_act_scores_detail_by_unit_id($school_sat_act_scores_detail['UnitID']);
       
        $this->objSchoolSatActScores = new SchoolSatActScoresDetail();
        if (count($school_sat_act_scores) != null && count($school_sat_act_scores) > 0) {
            $this->objSchoolSatActScores->where('UnitID', $school_sat_act_scores_detail['UnitID'])->update($school_sat_act_scores_detail);
        } else {
            $this->objSchoolSatActScores->create($school_sat_act_scores_detail);
        }
    }
    
    public function get_school_sat_act_scores_detail_by_unit_id($unit_id) {
        $this->objSchoolSatActScores = new SchoolSatActScoresDetail();
        $school_sat_act_scores = $this->objSchoolSatActScores->where([['UnitID', $unit_id]])->first();
        return $school_sat_act_scores;
    }

    /**
     * @return save_school_tuition_fees_detail Object
      Parameters
      @$save_school_tuition_fees_detail : save_school_tuition_fees_detail
    */
    public function save_school_tuition_fees_detail($school_tuition_fees_detail) {
        $school_tuition_fees = $this->get_school_tuition_fees_detail_by_unit_id($school_tuition_fees_detail['UnitID']);
       
        $this->objSchoolTuitionFees = new SchoolTuitionFeesDetail();
        if (count($school_tuition_fees) != null && count($school_tuition_fees) > 0) {
            $this->objSchoolTuitionFees->where('UnitID', $school_tuition_fees_detail['UnitID'])->update($school_tuition_fees_detail);
        } else {
            $this->objSchoolTuitionFees->create($school_tuition_fees_detail);
        }
    }
    
    public function get_school_tuition_fees_detail_by_unit_id($unit_id) {
        $this->objSchoolTuitionFees = new SchoolTuitionFeesDetail();
        $school_tuition_fees = $this->objSchoolTuitionFees->where([['UnitID', $unit_id]])->first();
        return $school_tuition_fees;
    }
    
    /**
     * @return SchoolLogoDetail Object
    */
    public function getAllSchoolsLogo()
    {
        $this->objSchoolLogo = new SchoolLogoDetail();
        $school_logo_data = $this->objSchoolLogo->get_logo_detail();
        
        return $school_logo_data;
    }

    /**
     * @return logo_detail Object
      Parameters
      @$logo_detail : save_school_logo
    */
    public function save_school_logo($logo_detail) {
        $school_logo = $this->get_school_logo_by_unit_id($logo_detail['UnitID']);
       
        $this->objSchoolLogo = new SchoolLogoDetail();
        if (count($school_logo) != null && count($school_logo) > 0) {
            $this->objSchoolLogo->where('UnitID', $logo_detail['UnitID'])->update($logo_detail);
        } else {
            $this->objSchoolLogo->create($logo_detail);
        }
    }
    
    public function get_school_logo_by_unit_id($unit_id) {
        $this->objSchoolLogo = new SchoolLogoDetail();
        $school_logo = $this->objSchoolLogo->where([['UnitID', $unit_id]])->where('deleted', '<>', Config::get('constant.DELETED_FLAG'))->first();
        return $school_logo;
    }
    
}
