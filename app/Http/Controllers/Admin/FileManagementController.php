<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\FileManagementRequest;
use App\Http\Controllers\Controller;
use App\Services\School\Contracts\SchoolRepository;
use File;
use Config;
use Redirect;
use App\SchoolLogoDetail;

class FileManagementController extends Controller {

    public function __construct(SchoolRepository $schoolRepository) {
        $this->middleware('auth.admin');
        $this->logo_original_path = Config::get('constant.SCHOOL_ORIGINAL_LOGO_PATH');
        $this->schoolRepository = $schoolRepository;
        $this->objSchoolLogo = new SchoolLogoDetail();
    }

    public function index() {
        //get all school data
        $school_logo = $this->schoolRepository->getAllSchoolsLogo();
        $logo_path = $this->logo_original_path;
        return view('admin.list-school-logo', compact('school_logo', 'logo_path'));
    }

    public function upload_school_logo() {
        return view('admin.upload-logo');
    }
    
    public function upload_school_logo_post(FileManagementRequest $request) {
        
        if($request->hasFile('school_logo')) {
            foreach ($request->school_logo as $logo) {
                
                $filename = $logo->getClientOriginalName();
                
                $name_array = explode("_", $filename, 2);
                $unit_id = $name_array[0];
                
                $destinationDirectory = 'uploads/logo/original/';
                if (!file_exists($destinationDirectory)) {
                    File::makeDirectory($destinationDirectory, 0777, true, true);
                }
                $logo->move($destinationDirectory, $filename);
                
                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $filename
                );
                $this->schoolRepository->save_school_logo($insert_data);
            }
            return Redirect::to('admin/list-school-logo')->with('success', trans('label.upload_success_msg'));
            exit;
        }
    }

    public function delete_school_logo($unit_id) {
        $logo_detail = $this->objSchoolLogo->where('UnitID', $unit_id)->where('deleted', '<>', Config::get('constant.DELETED_FLAG'))->first();
        if ($logo_detail) {
            $return = $this->objSchoolLogo->delete_logo($unit_id);
            if ($return) {
                return Redirect::to("admin/list-school-logo")->with('success', trans('admin.schoollogodeletesuccess'));
            } else {
                return Redirect::to("admin/list-school-logo")->with('error', trans('admin.commonerrormessage'));
            }
        } else {
            return Redirect::to('admin/list-school-logo')->with('error', trans('admin.logonotfoundonyourrequest'));
        }
    }

}
