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

    /**
     * Save School Graduation Rate Time detail passed in $school_graduation_rate_time_detail array
    */
    public function save_school_graduation_rate_time_detail($school_graduation_rate_time_detail);
    
    public function get_school_graduation_rate_time_detail_by_unit_id($unit_id);

    /**
     * Save School ROTC detail passed in $school_ROTC_detail array
    */
    public function save_school_ROTC_detail($school_ROTC_detail);
    
    public function get_school_ROTC_detail_by_unit_id($unit_id);

    /**
     * Save School Students To Faculty detail passed in $school_students_to_faculty_detail array
    */
    public function save_school_students_to_faculty_detail($school_students_to_faculty_detail);
    
    public function get_school_students_to_faculty_detail_by_unit_id($unit_id);

    /**
     * Save School Study Abroad detail passed in $school_study_abroad_detail array
    */
    public function save_school_study_abroad_detail($school_study_abroad_detail);
    
    public function get_school_study_abroad_detail_by_unit_id($unit_id);

    /**
     * Save School Teacher Certification detail passed in $school_teacher_certification_detail array
    */
    public function save_school_teacher_certification_detail($school_teacher_certification_detail);
    
    public function get_school_teacher_certification_detail_by_unit_id($unit_id);

    /**
     * Save School Field Of Study detail passed in $school_field_of_study_detail array
    */
    public function save_school_field_of_study_detail($school_field_of_study_detail);
    
    public function get_school_field_of_study_detail_by_unit_id($unit_id);

    /**
     * Save School Financial Aid detail passed in $school_financial_aid_detail array
    */
    public function save_school_financial_aid_detail($school_financial_aid_detail);
    
    public function get_school_financial_aid_detail_by_unit_id($unit_id);

    /**
     * Save School Net Price In State detail passed in $school_net_price_in_state_detail array
    */
    public function save_school_net_price_in_state_detail($school_net_price_in_state_detail);
    
    public function get_school_net_price_in_state_detail_by_unit_id($unit_id);

    /**
     * Save School Net Price Out State detail passed in $school_net_price_out_state_detail array
    */
    public function save_school_net_price_out_state_detail($school_net_price_out_state_detail);
    
    public function get_school_net_price_out_state_detail_by_unit_id($unit_id);

    /**
     * Save School Sat Act Scores detail passed in $school_sat_act_scores_detail array
    */
    public function save_school_sat_act_scores_detail($school_sat_act_scores_detail);
    
    public function get_school_sat_act_scores_detail_by_unit_id($unit_id);

    /**
     * Save School Tuition Fees detail passed in $school_tuition_fees_detail array
    */
    public function save_school_tuition_fees_detail($school_tuition_fees_detail);
    
    public function get_school_tuition_fees_detail_by_unit_id($unit_id);
}
