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
            $fileData = Input::file('schoolfact');
            $extension = $fileData->getClientOriginalExtension();                        
            if($extension == 'csv')
            {
                $name = time().'-'.$fileData->getClientOriginalName();
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
                $path = public_path('/uploads/csv/'.$name);
                $schools = Helpers::csv_to_array($path, ';');
                
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
            }
            else
            {
                return Redirect::to('admin/importSchoolQuickFact')->with('error', 'Invalid file extension');
                exit;
            }            
        }
    }
}
