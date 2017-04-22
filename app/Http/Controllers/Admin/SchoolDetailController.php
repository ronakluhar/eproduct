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

class SchoolDetailController extends Controller
{
    public function __construct(UsersRepository $usersRepository, AdminUsersRepository $adminUsersRepository, SchoolRepository $schoolRepository)
    {
    	$this->middleware('auth.admin');
        $this->usersRepository = $usersRepository;
        $this->adminUsersRepository = $adminUsersRepository;
        $this->schoolRepository = $schoolRepository;
        $this->objUsers  = new User();
        $this->objAdmin  = new Admin();
    }

    public function index()
    {
       //get all school data
       $schools = $this->schoolRepository->getAllSchoolsData();
       return view('admin.listSchool',compact('schools'));               
    }

    public function importSchoolFaculty()
    {
        return view('admin.importSchoolFaculty');
    }
    
    public function saveSchoolFaculty()
    {
        if (Input::hasFile('schoolFaculty')) 
        {
            $fileData = Input::file('schoolFaculty');
            $extension = $fileData->getClientOriginalExtension();                        
            if($extension == 'csv')
            {
                $name = time().'-'.$fileData->getClientOriginalName();
                // Moves file to folder on server
                $fileData->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/'.$name);
                $schoolFaculties = Helpers::csv_to_array($path, ';');
               
                $insertData = array();
                if (!empty($schoolFaculties)) {
                    foreach($schoolFaculties as $key => $value) {   
                        $insertData['UnitID'] = $value['UnitID'];
                        $insertData['Professors'] = $value['Professors'];
                        $insertData['Associate_professors'] = $value['Associate professors'];
                        $insertData['Assistant_professors'] = $value['Assistant professors'];
                        $insertData['Intructors'] = $value['Intructors'];
                        $insertData['Lecturers'] = $value['Lecturers'];
                        $insertData['No_academic_rank'] = $value['No academic rank'];
                        $this->schoolRepository->saveSchoolFaculty($insertData);
                    }
                } 
                unlink($path);
                return Redirect::to('admin/list-school')->with('success', 'School Faculty data imported successfully');
                exit;
            }
            else
            {
                return Redirect::to('admin/importSchoolQuickFact')->with('error', 'Invalid file extension');
                exit;
            }            
        }
    }
    
    public function importSchoolLibrary()
    {
        return view('admin.importSchoolLibrary');
    }
    
    public function saveSchoolLibrary()
    {
        if (Input::hasFile('schoolLibrary')) 
        {
            $fileData = Input::file('schoolLibrary');
            $extension = $fileData->getClientOriginalExtension();                        
            if($extension == 'csv')
            {
                $name = time().'-'.$fileData->getClientOriginalName();
                // Moves file to folder on server
                $fileData->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/'.$name);
                $schoolLibraries = Helpers::csv_to_array($path, ';');
                
                $insertData = array();
                if (!empty($schoolLibraries)) {
                    foreach($schoolLibraries as $key => $value) {   
                        $insertData['UnitID'] = $value['UnitID'];
                        $insertData['Branches_independent_libraries'] = $value['Number of branches and independent libraries'];
                        $insertData['Physical_books'] = $value['Number of physical books'];
                        $insertData['Physical_media'] = $value['Number of physical media'];
                        $insertData['Digital_electronic_databases'] = $value['Number of digital/electronic databases'];
                        $insertData['Digital_electronic_media'] = $value['Number of digital/electronic media'];
                        $insertData['Total_library_collections'] = $value['Total library collections physical/electronic'];
                        $insertData['Has_an_academic_library'] = $value['Has an academic library'];
                        $this->schoolRepository->saveSchoolLibrary($insertData);
                    }
                } 
                unlink($path);
                return Redirect::to('admin/list-school')->with('success', 'School Faculty data imported successfully');
                exit;
            }
            else
            {
                return Redirect::to('admin/importSchoolQuickFact')->with('error', 'Invalid file extension');
                exit;
            }            
        }
    }
    
    public function importSchoolCompletion()
    {
        return view('admin.importSchoolCompletion');
    }
    
    public function saveSchoolCompletion()
    {
        if (Input::hasFile('schoolCompletion')) 
        {
            $fileData = Input::file('schoolCompletion');
            $extension = $fileData->getClientOriginalExtension();                        
            if($extension == 'csv')
            {
                $name = time().'-'.$fileData->getClientOriginalName();
                // Moves file to folder on server
                $fileData->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/'.$name);
                
                $delimiter = Helpers::get_file_delimiter($path, 10);
                
                $schoolCompletions = Helpers::csv_to_array($path, $delimiter);
               
                $insertData = array();
                if (!empty($schoolCompletions)) {
                    foreach($schoolCompletions as $key => $value) {   
                        $insertData['UnitID'] = $value['UnitID'];
                        $insertData['Agriculture_Operations_and_Related_Sciences'] = $value['Agriculture Operations and Related Sciences'];
                        $insertData['Natural_Resources_and_Conservation'] = $value['Natural Resources and Conservation'];
                        $insertData['Architecture_and_Related_Services'] = $value['Architecture and Related Services'];
                        $insertData['Area_Ethnic_Cultural_Gender_Group_Studies'] = $value['Area  Ethnic  Cultural  Gender  and Group Studies'];
                        $insertData['Communication_Journalism_and_Related_Programs'] = $value['Communication  Journalism  and Related Programs'];
                        $insertData['Communications_Technologies_and_Support_Services'] = $value['Communications Technologies/Technicians and Support Services'];
                        $insertData['Computer_and_Information_Sciences_and_Support_Services'] = $value['Computer and Information Sciences and Support Services'];
                        $insertData['Personal_and_Culinary_Services'] = $value['Personal and Culinary Services'];
                        $insertData['Education'] = $value['Education'];
                        $insertData['Engineering'] = $value['Engineering'];
                        $insertData['Engineering_Technologies_and_Engineering_related_Fields'] = $value['Engineering Technologies and Engineering-related Fields'];
                        $insertData['Foreign_Languages_Literature_and_Linguistics'] = $value['Foreign Languages  Literature\'s  and Linguistics'];
                        $insertData['Family_and_Consumer_Sciences_Sciences'] = $value['Family and Consumer Sciences/Human Sciences'];
                        $insertData['Legal_Professions_and_Studies'] = $value['Legal Professions and Studies'];
                        $insertData['English_Language_and_Literature'] = $value['English Language and Literature/Letters'];
                        $insertData['Liberal_Arts_and_Sciences_General_Studies_and_Humanities'] = $value['Liberal Arts and Sciences  General Studies and Humanities'];
                        $insertData['Library_Science'] = $value['Library Science'];
                        $insertData['Biological_and_Biomedical_Sciences'] = $value['Biological and Biomedical Sciences'];
                        $insertData['Mathematics_and_Statistics'] = $value['Mathematics and Statistics'];
                        $insertData['Military_Technologies_and_Applied_Sciences'] = $value['Military Technologies and Applied Sciences'];
                        $insertData['Multi_Interdisciplinary_Studies'] = $value['Multi/Interdisciplinary Studies'];
                        $insertData['Parks_Recreation_Leisure_and_Fitness_Studies'] = $value['Parks  Recreation  Leisure and Fitness Studies'];
                        $insertData['Philosophy_and_Religious_Studies'] = $value['Philosophy and Religious Studies'];
                        $insertData['Theology_and_Religious_Vocations'] = $value['Theology and Religious Vocations'];
                        $insertData['Physical_Sciences'] = $value['Physical Sciences'];
                        $insertData['Science_Technologies'] = $value['Science Technologies/Technicians'];
                        $insertData['Psychology'] = $value['Psychology'];
                        $insertData['Homeland_Security_Law_Enforcement_Firefight_Protective_Service'] = $value['Homeland Security  Law Enforcement  Firefighting  and Related Protective Service'];
                        $insertData['Public_Administration_and_Social_Service_Professions'] = $value['Public Administration and Social Service Professions'];
                        $insertData['Social_Sciences'] = $value['Social Sciences'];
                        $insertData['Construction_Trades'] = $value['Construction Trades'];
                        $insertData['Mechanic_and_Repair_Technologies'] = $value['Mechanic and Repair Technologies/Technicians'];
                        $insertData['Precision_Production'] = $value['Precision Production'];
                        $insertData['Transportation_and_Materials_Moving'] = $value['Transportation and Materials Moving'];
                        $insertData['Visual_and_Performing_Arts'] = $value['Visual and Performing Arts'];
                        $insertData['Health_Professions_and_Related_Programs'] = $value['Health Professions and Related Programs'];
                        $insertData['Business_Management_Marketing_Related_Support_Services'] = $value['Business  Management  Marketing  and Related Support Services'];
                        $insertData['History'] = $value['History'];
                        $this->schoolRepository->saveSchoolCompletions($insertData);
                    }
                } 
                unlink($path);
                return Redirect::to('admin/list-school')->with('success', 'School Completions data imported successfully');
                exit;
            }
            else
            {
                return Redirect::to('admin/importSchoolQuickFact')->with('error', 'Invalid file extension');
                exit;
            }            
        }
    }
}
