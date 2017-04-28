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

    // Upload new logos
    public function upload_school_logo() {
        return view('admin.upload-logo');
    }
    
    // Edit school logo
    public function update_school_logo($unit_id) {
        $logo_path = $this->logo_original_path;
        $logo_detail = $this->objSchoolLogo->with('school')->where('UnitID', $unit_id)->where('deleted', '<>', Config::get('constant.DELETED_FLAG'))->first();
        
        if(!isset($logo_detail) || (isset($logo_detail) && !isset($logo_detail->school)) || (isset($logo_detail) && empty($logo_detail))) {
            return Redirect::to('admin/list-school-logo')->with('error', trans('admin.logonotfoundonyourrequest'));
        }
        return view('admin.upload-logo', compact('logo_detail', 'logo_path'));
    }

    public function upload_school_logo_post(FileManagementRequest $request) {
        
        $update_unit_id = null;
        $i = 0; // To get number of file upload
        if(isset($request->id) && $request->id != '' && $request->id > 0) {
            // If user try to upload multiple file
            if(count($request->school_logo) > 1) {
                return Redirect::back()->withErrors(['You can\'t upload multiple file while updating logo.']);
            }

            // If existing image not exist in directory
            if(!$request->hasFile('school_logo') && !file_exists(public_path($this->logo_original_path.$request->school_image))) {
                return Redirect::back()->withErrors(['Image for this school not found in directory. Please select to update.']);
            }
            $update_unit_id = $request->id;
        }
        if($request->hasFile('school_logo')) {
            foreach ($request->school_logo as $logo) {

                $original_name = $logo->getClientOriginalName();

                $extension = '.' . $logo->getClientOriginalExtension();

                $file_name = pathinfo($original_name, PATHINFO_FILENAME); // file

                $name_array = explode(",", $file_name, 2);
                $unit_id = $name_array[0];
                
                if($update_unit_id == null && !is_numeric($unit_id)) continue;
                $file_name = $unit_id . '_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $logo->move($this->logo_original_path, $file_name.$extension);

                $insert_data = array(
                    'UnitID' => ($update_unit_id) ? $update_unit_id : $unit_id,
                    'image_path' => $file_name.$extension
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
                if(!empty($response) && $response['action'] == 'Create') {
                    $i++;
                } else {
                    $i=1;
                }
            }
            
            // Multiple File uploaded successfully
            if(!$update_unit_id && $i > 0) {
                return Redirect::to('admin/list-school-logo')->with('success', $i . ' '. trans('label.upload_success_msg'));
            } else if($update_unit_id && $i > 0) { // Logo updated successfully
                return Redirect::to('admin/list-school-logo')->with('success', trans('label.logo_update_success_msg'));
            } else { // Error or incorrect logo name
                return Redirect::to('admin/list-school-logo')->with('error', trans('label.upload_error_msg'));
            }
            exit;
        } else {
            return ($update_unit_id > 0) ? Redirect::to('admin/list-school-logo')->with('success', trans('label.logo_update_success_msg')) : Redirect::back()->withErrors([trans('label.select_file_msg')]);
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
