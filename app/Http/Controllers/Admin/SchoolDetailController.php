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
}
