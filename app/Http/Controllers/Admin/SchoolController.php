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
        //get all school data
        $schools = $this->schoolRepository->getAllSchoolsData();
        return view('admin.listSchool', compact('schools'));
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
//                Excel::selectSheetsByIndex(0)->load($fileData, function($reader) {  
//                    echo "<pre>";
//                    print_r($reader->toArray());
//                    exit;
//                    foreach ($reader->toArray() as $row) 
//                    {
//                        
//                    }
//                });
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
                return Redirect::to('admin/list-school')->with('success', 'School data imported successfully');
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
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
                return Redirect::to('admin/list-school')->with('success', trans('label.import_success_msg'));
                exit;
            } else {
                return Redirect::to('admin/import-school-teacher-certification')->with('error', trans('label.invalid_ext'));
                exit;
            }
        }
    }
}
