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
class SchoolController extends Controller
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

    public function importCSV()
    {
        return view('admin.importSchoolFacts');
    }
    
    public function saveSchoolQuickFact()
    {
        if (Input::hasFile('schoolfact')) 
        {
            $csvFile = Input::file('schoolfact');
            $extension = $csvFile->getClientOriginalExtension();                        
            if($extension == 'csv')
            {
                $name = time().'-'.$csvFile->getClientOriginalName();

                // Moves file to folder on server
                $csvFile->move(public_path() . '/uploads/csv/', $name);
                $path = public_path('/uploads/csv/'.$name);
                $schools = Helpers::csv_to_array($path, ';');

                if (!empty($schools)) {
                   // echo "<pre>";
                   // print_r($schools);
                   // exit;
                    foreach ($schools as $key => $value) {                        
                        $this->schoolRepository->saveSchoolDetail($value);
                    }
                } 
                unlink($path);
                return Redirect::to('admin/list-school')->with('success', 'School data imported successfully');
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
