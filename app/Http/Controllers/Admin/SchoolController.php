<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Users\Contracts\UsersRepository;
use App\Services\School\Contracts\SchoolRepository;
use App\Services\AdminUsers\Contracts\AdminUsersRepository;
use App\Http\Requests\UpdateAdminProfileRequest;
use Input;
use Auth;
use Session;
use Redirect;
use App\User;
use App\Admin;
use Helpers;
use Excel;

class SchoolController extends Controller {

    public function __construct(UsersRepository $usersRepository, AdminUsersRepository $adminUsersRepository, SchoolRepository $schoolRepository) {
        $this->middleware('auth.admin');
        $this->usersRepository = $usersRepository;
        $this->adminUsersRepository = $adminUsersRepository;
        $this->schoolRepository = $schoolRepository;
        $this->objUsers = new User();
        $this->objAdmin = new Admin();
    }

    public function index() {
        return view('admin.listSchool');
    }
    
    /**
     * get_school_list_ajax
     * To get School list from server side processing
     * @return (json) ($data) school list in json_encode
     */
    public function get_school_list_ajax() {
        
        $columns = Input::get('columns');
        $order = Input::get('order');
        $search = Input::get('search');
        $records = array();
        $records["data"] = array();
        
        $total_records = $this->schoolRepository->getAllSchoolsData()->count();
        $display_length = ((intval(Input::get('length')) < 0) ? $total_records : intval(Input::get('length')));
        $display_start = intval(Input::get('start'));
        $draw = intval(Input::get('draw'));
        $records["data"] = $this->schoolRepository->getAllSchoolsData();
        
        if (!empty($search['value'])) {
            $val = $search['value'];
            $records["data"]->where(function($query) use ($val) {
                    $query->where('UnitID', 'LIKE', "%{$val}%")
                    ->orWhere('Institution_Name', 'LIKE', "%{$val}%")
                    ->orWhere('Post_office_box', 'LIKE', "%{$val}%")
                    ->orWhere('City', 'LIKE', "%{$val}%")
                    ->orWhere('County_name', 'LIKE', "%{$val}%");
            });
        }
        
        //order by
        foreach ($order as $o) {
            $records["data"] = $records["data"]->orderBy($columns[$o['column']]['name'], $o['dir']);
        }
        
        //limit
        if ($display_length > 0) {
            $records["data"] = $records["data"]
                    ->take($display_length)
                    ->offset($display_start)
                    ->get([
                        'UnitID',
                        'Institution_Name',
                        'Institution_alias',
                        'Post_office_box',
                        'City',
                        'State',
                        'ZIP_code',
                        'Name_chief_administrator',
                        'Title_chief_administrator',
                        'General_information_number',
                        'Internet_web_address',
                        'County_name'
                    ]);
        }

        if (!empty($search['value'])) {
            $total_records = count($records["data"]);
        }
        $records["draw"] = $draw;
        $records["recordsTotal"] = $total_records;
        $records["recordsFiltered"] = $total_records;

        echo json_encode($records);
        exit;
    }

    public function importCSV() {
        return view('admin.importSchoolFacts');
    }

    public function saveSchoolQuickFact() {
        if (Input::hasFile('schoolfact')) {
            $fileData = Input::file('schoolfact');
            $extension = $fileData->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $fileData->getClientOriginalName();

                // Moves file to folder on server
                $fileData->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);

                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $schools = Helpers::csv_to_array($path, $delimiter);

                $insertData = array();
                if (!empty($schools)) {
                    foreach ($schools as $key => $value) {
                        $insertData['UnitID'] = $value['UnitID'];
                        $insertData['Institution_Name'] = $value['Institution Name'];
                        $insertData['Institution_alias'] = $value['Institution name alias'];
                        $insertData['Post_office_box'] = $value['Street address or post office box'];
                        $insertData['City'] = $value['City'];
                        $insertData['State'] = $value['State abbreviation'];
                        $insertData['ZIP_code'] = $value['ZIP code'];
                        $insertData['Name_chief_administrator'] = $value['Name of chief administrator'];
                        $insertData['Title_chief_administrator'] = $value['Title of chief administrator'];
                        $insertData['General_information_number'] = $value['General information telephone number'];
                        $insertData['Internet_web_address'] = $value['Institution\'s internet website address'];
                        $insertData['Financial_web_address'] = $value['Financial aid office web address'];
                        $insertData['Admissions_office_web_address'] = $value['Admissions office web address'];
                        $insertData['Online_application_web_address'] = $value['Online application web address'];
                        $insertData['Net_price_calculator_web_address'] = $value['Net price calculator web address'];
                        $insertData['Veteran_Military_web_address'] = $value['Veterans and Military tuition policies web address'];
                        $insertData['County_name'] = $value['County name'];
                        $insertData['Longitude'] = $value['Longitude'];
                        $insertData['Latitude'] = $value['Latitude'];
                        $insertData['Open_to_general_public'] = $value['open to the general public'];
                        $insertData['Status_of_institution'] = $value['Status of institution'];
                        $insertData['Control_of_institution'] = $value['Control of institution'];
                        $insertData['Carnegie_Classification'] = $value['Carnegie Classification 2015 Basic'];
                        $insertData['Religious_Affiliation'] = $value['Religious affiliation'];
                        $insertData['Historically_Black_College'] = $value['Historically Black College or University'];
                        $insertData['Tribal_college'] = $value['Tribal college'];
                        $insertData['Degree_of_urbanization'] = $value['Degree of urbanization'];
                        $insertData['Institution_size_category'] = $value['Institution size category'];
                        $insertData['Credit_for_life_experiences'] = $value['Credit for life experiences'];
                        $insertData['Advanced_placement_AP_credits'] = $value['Advanced placement AP credits'];
                        $this->schoolRepository->saveSchoolDetail($insertData);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', 'School data imported successfully');
                exit;
            } else {
                return Redirect::to('admin/importSchoolQuickFact')->with('error', 'Invalid file extension');
                exit;
            }
        }
    }

    public function import_apply_accepted_CSV() {
        return view('admin.import-school-apply-accepted');
    }

    public function save_school_apply_accepted() {
        if (Input::hasFile('school_apply_accepted')) {
            $file_data = Input::file('school_apply_accepted');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();

                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);

                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $schools_apply_accepted = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($schools_apply_accepted)) {
                    foreach ($schools_apply_accepted as $key => $_schools_apply_accepted) {
                        
                        $insert_data['UnitID'] = $_schools_apply_accepted['UnitID'];
                        $insert_data['Applicants_total'] = $_schools_apply_accepted['Applicants total'];
                        $insert_data['Applicants_men'] = $_schools_apply_accepted['Applicants men'];
                        $insert_data['Applicants_women'] = $_schools_apply_accepted['Applicants women'];
                        $insert_data['Admissions_total'] = $_schools_apply_accepted['Admissions total'];
                        $insert_data['Admissions_men'] = $_schools_apply_accepted['Admissions men'];
                        $insert_data['Admissions_women'] = $_schools_apply_accepted['Admissions women'];
                        $insert_data['Enrolled_total'] = $_schools_apply_accepted['Enrolled total'];
                        $insert_data['Enrolled_men'] = $_schools_apply_accepted['Enrolled  men'];
                        $insert_data['Enrolled_women'] = $_schools_apply_accepted['Enrolled  women'];
                        $insert_data['Enrolled_full_time_total'] = $_schools_apply_accepted['Enrolled full time total'];
                        $insert_data['Enrolled_full_time_men'] = $_schools_apply_accepted['Enrolled full time men'];
                        $insert_data['Enrolled_full_time_women'] = $_schools_apply_accepted['Enrolled full time women'];
                        $insert_data['Enrolled_part_time_total'] = $_schools_apply_accepted['Enrolled part time total'];
                        $insert_data['Enrolled_part_time_men'] = $_schools_apply_accepted['Enrolled part time men'];
                        $insert_data['Enrolled_part_time_women'] = $_schools_apply_accepted['Enrolled part time women'];
                        $this->schoolRepository->save_school_apply_accepted_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-apply-accepted')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }
    
    public function import_award_level_CSV() {
        return view('admin.import-school-award-level');
    }

    public function save_school_award_level() {
        if (Input::hasFile('school_award_level')) {
            $file_data = Input::file('school_award_level');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();

                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);

                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $schools_award_level = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($schools_award_level)) {
                    foreach ($schools_award_level as $key => $_schools_award_level) {
                        
                        $insert_data['UnitID'] = $_schools_award_level['UnitID'];
                        $insert_data['Associate_degree'] = $_schools_award_level['Associate\'s degree'];
                        $insert_data['4_years_certificate'] = $_schools_award_level['Two but less than 4 years certificate'];
                        $insert_data['Bachelor_degree'] = $_schools_award_level['Bachelor\'s degree'];
                        $insert_data['Postbaccalaureate_certificate'] = $_schools_award_level['Postbaccalaureate certificate'];
                        $insert_data['Master_degree'] = $_schools_award_level['Master\'s degree'];
                        $insert_data['Post_master_certificate'] = $_schools_award_level['Post-master\'s certificate'];
                        $insert_data['Doctor_degree_research'] = $_schools_award_level['Doctor\'s degree - research/scholarship'];
                        $insert_data['Doctor_degree_professional_practice'] = $_schools_award_level['Doctor\'s degree - professional practice'];
                        $insert_data['Doctor_degree_other'] = $_schools_award_level['Doctor\'s degree - other'];
                        $insert_data['Other_degree'] = $_schools_award_level['Other degree'];
                        $this->schoolRepository->save_school_award_level_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-award-level')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_graduation_rate_time_CSV() {
        return view('admin.import-school-graduation-rate-time');
    }

    public function save_school_graduation_rate_time() {
        
        if (Input::hasFile('school_graduation_rate_time')) {
            $file_data = Input::file('school_graduation_rate_time');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_graduation_rate_time = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_graduation_rate_time)) {
                    foreach ($school_graduation_rate_time as $key => $_school_graduation_rate_time) {
                        
                        $insert_data['UnitID'] = $_school_graduation_rate_time['UnitID'];
                        $insert_data['Total_cohort'] = $_school_graduation_rate_time['Graduation rate total cohort'];
                        $insert_data['men'] = $_school_graduation_rate_time['Graduation rate men'];
                        $insert_data['women'] = $_school_graduation_rate_time['Graduation rate women'];
                        $insert_data['Bachelor_degree_4_years'] = $_school_graduation_rate_time['Bachelor degree within 4 years  total'];
                        $insert_data['Bachelor_degree_5_years'] = $_school_graduation_rate_time['Bachelor degree within 5 years  total'];
                        $insert_data['Bachelor_degree_6_years'] = $_school_graduation_rate_time['Bachelor degree within 6 years  total'];
                        $this->schoolRepository->save_school_graduation_rate_time_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-graduation-rate-time')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_ROTC_CSV() {
        return view('admin.import-school-ROTC');
    }

    public function save_school_ROTC() {
        
        if (Input::hasFile('school_ROTC')) {
            $file_data = Input::file('school_ROTC');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_ROTC = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_ROTC)) {
                    foreach ($school_ROTC as $key => $_school_ROTC) {
                        
                        $insert_data['UnitID'] = $_school_ROTC['UnitID'];
                        $insert_data['ROTC'] = $_school_ROTC['ROTC'];
                        $insert_data['ROTC_Army'] = $_school_ROTC['ROTC - Army'];
                        $insert_data['ROTC_Navy'] = $_school_ROTC['ROTC - Navy'];
                        $insert_data['ROTC_Air_Force'] = $_school_ROTC['ROTC - Air Force'];
                        $this->schoolRepository->save_school_ROTC_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-ROTC')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_students_to_faculty_CSV() {
        return view('admin.import-school-students-to-faculty');
    }

    public function save_school_students_to_faculty() {
        
        if (Input::hasFile('school_students_to_faculty')) {
            $file_data = Input::file('school_students_to_faculty');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_students_to_faculty = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_students_to_faculty)) {
                    foreach ($school_students_to_faculty as $key => $_school_students_to_faculty) {
                        
                        $insert_data['UnitID'] = $_school_students_to_faculty['UnitID'];
                        $insert_data['Full_time_retention_rate'] = $_school_students_to_faculty['Full-time retention rate 2015'];
                        $insert_data['Total_students_undergraduate_fall'] = $_school_students_to_faculty['Total entering students at undergraduate level fall 2015'];
                        $insert_data['Student_to_faculty_ratio'] = $_school_students_to_faculty['Student-to-faculty ratio'];
                        $this->schoolRepository->save_school_students_to_faculty_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-students-to-faculty')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_study_abroad_CSV() {
        return view('admin.import-school-study-abroad');
    }

    public function save_school_study_abroad() {
        
        if (Input::hasFile('school_study_abroad')) {
            $file_data = Input::file('school_study_abroad');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 1000);
                
                $school_study_abroad = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_study_abroad)) {
                    foreach ($school_study_abroad as $key => $_school_study_abroad) {
                        
                        $insert_data['UnitID'] = $_school_study_abroad['UnitID'];
                        $insert_data['Study_abroad'] = $_school_study_abroad['Study abroad'];
                        $insert_data['Weekend_college'] = $_school_study_abroad['Weekend/evening  college'];
                        $this->schoolRepository->save_school_study_abroad_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-study-abroad')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_teacher_certification_CSV() {
        return view('admin.import-school-teacher-certification');
    }

    public function save_school_teacher_certification() {
        
        if (Input::hasFile('school_teacher_certification')) {
            $file_data = Input::file('school_teacher_certification');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_teacher_certification = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_teacher_certification)) {
                    foreach ($school_teacher_certification as $key => $_school_teacher_certification) {
                        
                        $insert_data['UnitID'] = $_school_teacher_certification['UnitID'];
                        $insert_data['Below_postsecondary_level'] = $_school_teacher_certification['TC (below the postsecondary level)'];
                        $insert_data['Students_can_complete_areas_of_specialization'] = $_school_teacher_certification['TC: Students complete preparation in areas of special'];
                        $insert_data['Students_must_complete_pre_at_another_inst_areas_of_spe'] = $_school_teacher_certification['TC: Students complete at another institution for  special'];
                        $insert_data['Approved_by_the_state_initial_certifcation'] = $_school_teacher_certification['TC: Approved by state for initial cert or lic of teachers'];
                        $this->schoolRepository->save_school_teacher_certification_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-teacher-certification')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_field_of_study_CSV() {
        return view('admin.import-school-field-of-study');
    }

    public function save_school_field_of_study() {
        
        if (Input::hasFile('school_field_of_study')) {
            $file_data = Input::file('school_field_of_study');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_field_of_study = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_field_of_study)) {
                    foreach ($school_field_of_study as $key => $_school_field_of_study) {
                        
                        $insert_data['UnitID'] = $_school_field_of_study['UnitID'];
                        $insert_data['Education_All_Students_Total'] = $_school_field_of_study['Education  All Students Total'];
                        $insert_data['Education_Undergraduate_Total'] = $_school_field_of_study['Education  Undergraduate Total'];
                        $insert_data['Education_Graduate'] = $_school_field_of_study['Education  Graduate'];
                        $insert_data['Engineering_All_Students_Total'] = $_school_field_of_study['Engineering  All Students Total'];
                        $insert_data['Engineering_Undergraduate_Total'] = $_school_field_of_study['Engineering  Undergraduate Total'];
                        $insert_data['Engineering_Graduate'] = $_school_field_of_study['Engineering  Graduate'];
                        $insert_data['Biological_Sciences_Sciences_All_Students_Total'] = $_school_field_of_study['Biological Sciences/Life Sciences  All Students Total'];
                        $insert_data['Biological_Sciences_Sciences_Undergraduate_Total'] = $_school_field_of_study['Biological Sciences/Life Sciences  Undergraduate Total'];
                        $insert_data['Biological_Sciences_Sciences_Graduate'] = $_school_field_of_study['Biological Sciences/Life Sciences  Graduate'];
                        $insert_data['Mathematics_All_Students_Total'] = $_school_field_of_study['Mathematics  All Students Total'];
                        $insert_data['Mathematics_Undergraduate_Total'] = $_school_field_of_study['Mathematics  Undergraduate Total'];
                        $insert_data['Mathematics_Graduate'] = $_school_field_of_study['Mathematics  Graduate'];
                        $insert_data['Physical_Sciences_All_Students_Total'] = $_school_field_of_study['Physical Sciences  All Students Total'];
                        $insert_data['Physical_Sciences_Undergraduate_Total'] = $_school_field_of_study['Physical Sciences  Undergraduate Total'];
                        $insert_data['Physical_Sciences_Graduate'] = $_school_field_of_study['Physical Sciences  Graduate'];
                        $insert_data['Business_Mgmt_and_Administrative_Services_All_Students_Total'] = $_school_field_of_study['Business Management and Administrative Services  All Students Total'];
                        $insert_data['Business_Mgmt_and_Administrative_Services_Undergraduate_Total'] = $_school_field_of_study['Business Management and Administrative Services  Undergraduate Total'];
                        $insert_data['Business_Mgmt_and_Administrative_Services_Graduate'] = $_school_field_of_study['Business Management and Administrative Services  Graduate'];
                        $insert_data['Law_(LLB_J.D.)_All_Students'] = $_school_field_of_study['Law (LL. B.  J.D.)  All Students'];
                        $insert_data['Law_(LLB_J.D.)_Full_time'] = $_school_field_of_study['Law (LL. B.  J.D.)  Full time'];
                        $insert_data['Law_(LLB_J.D.)_Part_time'] = $_school_field_of_study['Law (LL. B.  J.D.)  Part time'];
                        $insert_data['Dentistry_(D.D.S_D.M.D)_All_Students'] = $_school_field_of_study['Dentistry (D.D.S.  D.M.D)  All Students'];
                        $insert_data['Dentistry_(D.D.S_D.M.D)_Full_time'] = $_school_field_of_study['Dentistry (D.D.S.  D.M.D)  Full time'];
                        $insert_data['Dentistry_(D.D.S_D.M.D)_Part_time'] = $_school_field_of_study['Dentistry (D.D.S.  D.M.D)  Part time'];
                        $insert_data['Medicine_(M.D)_All_Students'] = $_school_field_of_study['Medicine (M.D)  All Students'];
                        $insert_data['Medicine_(M.D)_Full_time'] = $_school_field_of_study['Medicine (M.D)  Full time'];
                        $insert_data['Medicine_(M.D)_Part_time'] = $_school_field_of_study['Medicine (M.D)  Part time'];
                        
                        $this->schoolRepository->save_school_field_of_study_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-field-of-study')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_financial_aid_CSV() {
        return view('admin.import-school-financial-aid');
    }

    public function save_school_financial_aid() {
        
        if (Input::hasFile('school_financial_aid')) {
            $file_data = Input::file('school_financial_aid');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_financial_aid = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_financial_aid)) {
                    foreach ($school_financial_aid as $key => $_school_financial_aid) {
                        
                        $insert_data['UnitID'] = $_school_financial_aid['UnitID'];
                        $insert_data['Total_FTFTU_financial_aid_cohort'] = $_school_financial_aid['Total FTFTU - financial aid cohort'];
                        $insert_data['Percent_of_FTFTU_awarded_financial_aid'] = $_school_financial_aid['Percent of FTFTU awarded financial aid'];
                        $insert_data['Percent_awarded_loans/grants_from_fed/state/local/school'] = $_school_financial_aid['Percent awarded loans/grants from fed/state/local/school'];
                        $insert_data['Percent_FTFTU_awarded_fed/state/local/school_Aid'] = $_school_financial_aid['Percent FTFTU awarded fed/state/local/school Aid'];
                        $insert_data['Average_amount_fed/state/local_or_IntAid_awarded'] = $_school_financial_aid['Average amount fed/state/local or Int-Aid awarded'];
                        $insert_data['Percent_FTFTU_awarded_fed_grant_aid'] = $_school_financial_aid['Percent FTFTU awarded fed grant aid'];
                        $insert_data['Average_amount_fed_grant_aid_awarded_to_FTFTU'] = $_school_financial_aid['Average amount fed grant aid awarded to FTFTU'];
                        $insert_data['Percent_FTFTU_awarded_Pell_grants'] = $_school_financial_aid['Percent FTFTU awarded Pell grants'];
                        $insert_data['Average_amount_of_Pell_grant_aid_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of Pell grant aid awarded to FTFTU'];
                        $insert_data['Percent_FTFTU_awarded_other_fed_grant_aid'] = $_school_financial_aid['Percent FTFTU awarded other fed grant aid'];
                        $insert_data['Average_amount_of_other_fed_grant_aid_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of other fed grant aid awarded to FTFTU'];
                        $insert_data['Percent_of_FTFTU_awarded_state/local_grant_aid'] = $_school_financial_aid['Percent of FTFTU awarded state/local grant aid'];
                        $insert_data['Average_amount_state/local_grant_aid_awarded_to_FTFTU'] = $_school_financial_aid['Average amount state/local grant aid awarded to FTFTU'];
                        $insert_data['Percent_of_FTFTU_awarded_Int_Aid'] = $_school_financial_aid['Percent of FTFTU awarded Int-Aid'];
                        $insert_data['Average_amount_of_Int_Aid_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of Int-Aid awarded to FTFTU'];
                        $insert_data['Percent_of_FTFTU_awarded_student_loans'] = $_school_financial_aid['Percent of FTFTU awarded student loans'];
                        $insert_data['Average_amount_of_student_loans_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of student loans awarded to FTFTU'];
                        $insert_data['Percent_of_FTFTU_awarded_fed_student_loans'] = $_school_financial_aid['Percent of FTFTU awarded fed student loans'];
                        $insert_data['Average_amount_of_fed_student_loans_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of fed student loans awarded to FTFTU'];
                        $insert_data['Percent_of_FTFTU_awarded_other_student_loans'] = $_school_financial_aid['Percent of FTFTU awarded other student loans'];
                        $insert_data['Average_amount_of_other_student_loans_awarded_to_FTFTU'] = $_school_financial_aid['Average amount of other student loans awarded to FTFTU'];
                        $insert_data['Total_financial_aid_cohort'] = $_school_financial_aid['Total - financial aid cohort'];
                        $insert_data['Percent_awarded_fed/state/local/institutional_or_other_aid'] = $_school_financial_aid['Percent awarded fed/state/local/institutional or other aid'];
                        $insert_data['Average_fed/state/local/institutional_aid_awarded_to_ug_students'] = $_school_financial_aid['Average fed/state/local/institutional aid awarded to undergraduate students'];
                        $insert_data['Percent_of_undergraduate_students_awarded_Pell_grants'] = $_school_financial_aid['Percent of undergraduate students awarded Pell grants'];
                        $insert_data['Average_amount_Pell_grant_aid_awarded'] = $_school_financial_aid['Average amount Pell grant aid awarded'];
                        $insert_data['Percent_awarded_fed_student_loans'] = $_school_financial_aid['Percent awarded fed student loans'];
                        $insert_data['Average_fed_student_loans_awarded'] = $_school_financial_aid['Average fed student loans awarded'];
                        
                        $this->schoolRepository->save_school_financial_aid_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-financial-aid')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_net_price_in_state_CSV() {
        return view('admin.import-school-net-price-in-state');
    }

    public function save_school_net_price_in_state() {
        
        if (Input::hasFile('school_net_price_in_state')) {
            $file_data = Input::file('school_net_price_in_state');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_net_price_in_state = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_net_price_in_state)) {
                    foreach ($school_net_price_in_state as $key => $_school_net_price_in_state) {
                        
                        $insert_data['UnitID'] = $_school_net_price_in_state['UnitID'];
                        $insert_data['ANP_awarded_grant_or_scholarship_aid_2014_15'] = $_school_net_price_in_state['ANP awarded grant or scholarship aid 2014-15'];
                        $insert_data['ANP_awarded_grant_or_scholarship_aid_2013_14'] = $_school_net_price_in_state['ANP awarded grant or scholarship aid 2013-14'];
                        $insert_data['ANP_awarded_grant_or_scholarship_aid_2012_13'] = $_school_net_price_in_state['ANP awarded grant or scholarship aid 2012-13'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA2014_15'] = $_school_net_price_in_state['ANP(0-30000) ST-AWR TIV FFA2014-15'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_in_state['ANP(30001-48000) ST-AWR TIV FFA 2014-15'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_in_state['ANP(48001-75000) ST-AWR TIV FFA 2014-15'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_in_state['ANP(75001-110000) ST-AWR TIV FFA 2014-15'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_in_state['ANP(over 110000) ST-AWR TIV FFA 2014-15'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_in_state['ANP(0-30000) ST-AWR TIV FFA 2013-14'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_in_state['ANP(30001-48000) ST-AWR TIV FFA 2013-14'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_in_state['ANP(48001-75000) ST-AWR TIV FFA 2013-14'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_in_state['ANP(75001-110000) ST-AWR TIV FFA 2013-14'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_in_state['ANP(over 110000) ST-AWR TIV FFA 2013-14'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_in_state['ANP(0-30000) ST-AWR TIV FFA 2012-13'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_in_state['ANP(30001-48000) ST-AWR TIV FFA 2012-13'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_in_state['ANP(48001-75000) ST-AWR TIV FFA 2012-13'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_in_state['ANP(75001-110000) ST-AWR TIV FFA 2012-13'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_in_state['ANP(over 110000) ST-AWR TIV FFA 2012-13'];
                        
                        $this->schoolRepository->save_school_net_price_in_state_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-net-price-in-state')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_net_price_out_state_CSV() {
        return view('admin.import-school-net-price-out-state');
    }

    public function save_school_net_price_out_state() {
        
        if (Input::hasFile('school_net_price_out_state')) {
            $file_data = Input::file('school_net_price_out_state');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_net_price_out_state = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_net_price_out_state)) {
                    foreach ($school_net_price_out_state as $key => $_school_net_price_out_state) {
                        
                        $insert_data['UnitID'] = $_school_net_price_out_state['UnitID'];
                        $insert_data['ANP_ST_AWR_grant_or_scholarship_aid_2014_15'] = $_school_net_price_out_state['ANP ST-AWR grant or scholarship aid  2014-15'];
                        $insert_data['ANP_ST_AWR_grant_or_scholarship_aid_2013_14'] = $_school_net_price_out_state['ANP ST-AWR grant or scholarship aid  2013-14'];
                        $insert_data['ANP_ST_AWR_grant_or_scholarship_aid_2012_13'] = $_school_net_price_out_state['ANP ST-AWR grant or scholarship aid  2012-13'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA2014_15'] = $_school_net_price_out_state['ANP (0-30000) ST-AWR TIV FFA  2014-15'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_out_state['ANP (30001-48000) ST-AWR TIV FFA  2014-15'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_out_state['ANP (48001-75000) ST-AWR TIV FFA  2014-15'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_out_state['ANP (75001-110000) ST-AWR TIV FFA  2014-15'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2014_15'] = $_school_net_price_out_state['ANP (over 110000) ST-AWR TIV FFA  2014-15'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_out_state['ANP (0-30000) ST-AWR TIV FFA  2013-14'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_out_state['ANP (30001-48000) ST-AWR TIV FFA  2013-14'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_out_state['ANP (48001-75000) ST-AWR TIV FFA  2013-14'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_out_state['ANP (75001-110000) ST-AWR TIV FFA  2013-14'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2013_14'] = $_school_net_price_out_state['ANP (over 110000) ST-AWR TIV FFA  2013-14'];
                        $insert_data['ANP(0-30000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_out_state['ANP (0-30000) ST-AWR TIV FFA  2012-13'];
                        $insert_data['ANP(30001-48000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_out_state['ANP (30001-48000) ST-AWR TIV FFA  2012-13'];
                        $insert_data['ANP(48001-75000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_out_state['ANP (48001-75000) ST-AWR TIV FFA  2012-13'];
                        $insert_data['ANP(75001-110000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_out_state['ANP (75001-110000) ST-AWR TIV FFA  2012-13'];
                        $insert_data['ANP(over_110000)_ST_AWR_TIV_FFA_2012_13'] = $_school_net_price_out_state['ANP (over 110000) ST-AWR TIV FFA  2012-13'];
                        
                        $this->schoolRepository->save_school_net_price_out_state_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-net-price-out-state')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_sat_act_scores_CSV() {
        return view('admin.import-school-sat-act-scores');
    }

    public function save_school_sat_act_scores() {
        
        if (Input::hasFile('school_sat_act_scores')) {
            $file_data = Input::file('school_sat_act_scores');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_sat_act_scores = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_sat_act_scores)) {
                    foreach ($school_sat_act_scores as $key => $_school_sat_act_scores) {
                        
                        $insert_data['UnitID'] = $_school_sat_act_scores['UnitID'];
                        $insert_data['Number_of_F-T_students_submitting_SAT_scores'] = $_school_sat_act_scores['Number of F-T students submitting SAT scores'];
                        $insert_data['Percent_of_F-T_students_submitting_SAT_scores'] = $_school_sat_act_scores['Percent of F-T students submitting SAT scores'];
                        $insert_data['Number_of_F-T_students_submitting_ACT_scores'] = $_school_sat_act_scores['Number of F-T students submitting ACT scores'];
                        $insert_data['Percent_of_F-T__students_submitting_ACT_scores'] = $_school_sat_act_scores['Percent of F-T  students submitting ACT scores'];
                        $insert_data['SAT_Critical_Reading_25th_PCT_score'] = $_school_sat_act_scores['SAT Critical Reading 25th PCT score'];
                        $insert_data['SAT_Critical_Reading_75th_PCT_score'] = $_school_sat_act_scores['SAT Critical Reading 75th PCT score'];
                        $insert_data['SAT_Math_25th_PCT_score'] = $_school_sat_act_scores['SAT Math 25th PCT score'];
                        $insert_data['SAT_Math_75th_PCT_score'] = $_school_sat_act_scores['SAT Math 75th PCT score'];
                        $insert_data['SAT_Writing_25th_PCT_score'] = $_school_sat_act_scores['SAT Writing 25th PCT score'];
                        $insert_data['SAT_Writing_75th_PCT_score'] = $_school_sat_act_scores['SAT Writing 75th PCT score'];
                        $insert_data['ACT_Composite_25th_PCT_score'] = $_school_sat_act_scores['ACT Composite 25th PCT score'];
                        $insert_data['ACT_Composite_75th_PCT_score'] = $_school_sat_act_scores['ACT Composite 75th PCT score'];
                        $insert_data['ACT_English_25th_PCT_score'] = $_school_sat_act_scores['ACT English 25th PCT score'];
                        $insert_data['ACT_English_75th_PCT_score'] = $_school_sat_act_scores['ACT English 75th PCT score'];
                        $insert_data['ACT_Math_25th_PCT_score'] = $_school_sat_act_scores['ACT Math 25th PCT score'];
                        $insert_data['ACT_Math_75th_PCT_score'] = $_school_sat_act_scores['ACT Math 75th PCT score'];
                        $insert_data['ACT_Writing_25th_PCT_score'] = $_school_sat_act_scores['ACT Writing 25th PCT score'];
                        $insert_data['ACT_Writing_75th_PCT_score'] = $_school_sat_act_scores['ACT Writing 75th PCT score'];
                        
                        $this->schoolRepository->save_school_sat_act_scores_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-sat-act-scores')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }

    public function import_tuition_fees_CSV() {
        return view('admin.import-school-tuition-fees');
    }

    public function save_school_tuition_fees() {
        
        if (Input::hasFile('school_tuition_fees')) {
            $file_data = Input::file('school_tuition_fees');
            $extension = $file_data->getClientOriginalExtension();
            if ($extension == 'csv') {
                $name = time() . '-' . $file_data->getClientOriginalName();
                
                // Moves file to folder on server
                $file_data->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/' . $name);
                
                // Find csv file delimiter
                $delimiter = Helpers::get_file_delimiter($path, 10);

                $school_tuition_fees = Helpers::csv_to_array($path, $delimiter);
                
                $insert_data = array();
                if (!empty($school_tuition_fees)) {
                    foreach ($school_tuition_fees as $key => $_school_tuition_fees) {
                        
                        $insert_data['UnitID'] = $_school_tuition_fees['UnitID'];
                        $insert_data['Published_in-state_tuition_2015-16'] = $_school_tuition_fees['Published in-state tuition 2015-16'];
                        $insert_data['Published_in-state_fees_2015-16'] = $_school_tuition_fees['Published in-state fees 2015-16'];
                        $insert_data['Published_in-state_tuition_2014-15'] = $_school_tuition_fees['Published in-state tuition 2014-15'];
                        $insert_data['Published_in-state_fees_2014-15'] = $_school_tuition_fees['Published in-state fees 2014-15'];
                        $insert_data['Published_in-state_tuition_2013-14'] = $_school_tuition_fees['Published in-state tuition 2013-14'];
                        $insert_data['Published_in-state_fees_2013-14'] = $_school_tuition_fees['Published in-state fees 2013-14'];
                        $insert_data['Published_out-of-state_tuition_2015-16'] = $_school_tuition_fees['Published out-of-state tuition 2015-16'];
                        $insert_data['Published_out-of-state_fees_2015-16'] = $_school_tuition_fees['Published out-of-state fees 2015-16'];
                        $insert_data['Published_out-of-state_tuition_2014-15'] = $_school_tuition_fees['Published out-of-state tuition 2014-15'];
                        $insert_data['Published_out-of-state_fees_2014-15'] = $_school_tuition_fees['Published out-of-state fees 2014-15'];
                        $insert_data['Published_out-of-state_tuition_2013-14'] = $_school_tuition_fees['Published out-of-state tuition 2013-14'];
                        $insert_data['Published_out-of-state_fees_2013-14'] = $_school_tuition_fees['Published out-of-state fees 2013-14'];
                        $insert_data['Full-time_first-time_degree-seeking_students_live_campus'] = $_school_tuition_fees['Full-time  first-time degree/certificate-seeking students required to live on campus'];
                        $insert_data['Institution_provide_on-campus_housing'] = $_school_tuition_fees['Institution provide on-campus housing'];
                        $insert_data['Total_dormitory_capacity'] = $_school_tuition_fees['Total dormitory capacity'];
                        $insert_data['Institution_provides_board_or_meal_plan'] = $_school_tuition_fees['Institution provides board or meal plan'];
                        $insert_data['Number_of_meals_per_week_in_board_charge'] = $_school_tuition_fees['Number of meals per week in board charge'];
                        $insert_data['Undergraduate_application_fee'] = $_school_tuition_fees['Undergraduate application fee'];
                        $insert_data['Graduate_application_fee'] = $_school_tuition_fees['Graduate application fee'];
                        $insert_data['Books_and_supplies_2015-16'] = $_school_tuition_fees['Books and supplies 2015-16'];
                        $insert_data['On_campus_room_and_board_2015-16'] = $_school_tuition_fees['On campus room and board 2015-16'];
                        $insert_data['On_campus_other_expenses_2015-16'] = $_school_tuition_fees['On campus other expenses 2015-16'];
                        $insert_data['Off_campus_(NWF)_room_and_board_2015-16'] = $_school_tuition_fees['Off campus (NWF) room and board 2015-16'];
                        $insert_data['Off_campus_(NWF)_other_expenses_2015-16'] = $_school_tuition_fees['Off campus (NWF) other expenses 2015-16'];
                        
                        $this->schoolRepository->save_school_tuition_fees_detail($insert_data);
                    }
                }
                unlink($path);
                return Redirect::to('admin/school-list')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-tuition-fees')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }
}
