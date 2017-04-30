<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\FileManagementRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Services\School\Contracts\SchoolRepository;
use File;
use Config;
use Redirect;
use App\SchoolLogoDetail;
use App\School;

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
        $schoolDatas = $this->schoolRepository->getSchoolUnitIdName();
        return view('admin.upload-logo',compact('schoolDatas'));
    }
    
    // Edit school logo
    public function update_school_logo($unit_id) {
        $logo_path = $this->logo_original_path;
        
        $school_image_detail = School::with('school')->where('UnitID', $unit_id)->where('deleted', '<>', Config::get('constant.DELETED_FLAG'))->first();
        
        if(!isset($school_image_detail) || empty($school_image_detail) || (!isset($school_image_detail->school) || count($school_image_detail->school) == 0)) {
            return Redirect::to('admin/list-school-logo')->with('error', trans('admin.imagenotfoundonyourrequest'));
        }
        return view('admin.upload-logo', compact('school_image_detail', 'logo_path'));
    }
    
    public function upload_school_images_post(ImageRequest $request) {
        
        $unit_id = ($request->school_id) ? $request->school_id : $request->id;
        $image_credit_link = $request->school_credit_link;
        
        $unit_id = (int) $unit_id;
        
        $school = School::where('UnitID', $unit_id)->first();
        
        if(!$school) {
            return Redirect::back()->withInput()->withErrors(['Something went wrong. Please try again.']);
        }
        
        try {
            // Upload logo image
            if($request->hasFile('school_logo')) {
                $school_logo = $request->school_logo;

                $extension = '.' . $school_logo->getClientOriginalExtension();

                $file_name = $unit_id . '_logo_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_logo->move($this->logo_original_path, $file_name.$extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name.$extension,
                    'image_type' => Config::get('constant.LOGO_IMAGE_FLAG')
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }
        
        try {
            // Upload main image
            if($request->hasFile('school_main_image')) {
                $school_main_image = $request->school_main_image;

                $extension = '.' . $school_main_image->getClientOriginalExtension();

                $file_name = $unit_id . '_main_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_main_image->move($this->logo_original_path, $file_name.$extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name.$extension,
                    'image_type' => Config::get('constant.MAIN_IMAGE_FLAG')
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }
        
        try {
            // Upload seal image
            if($request->hasFile('school_seal_image')) {
                $school_seal_image = $request->school_seal_image;

                $extension = '.' . $school_main_image->getClientOriginalExtension();

                $file_name = $unit_id . '_seal_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_seal_image->move($this->logo_original_path, $file_name.$extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name.$extension,
                    'image_type' => Config::get('constant.SEAL_IMAGE_FLAG')
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }

        // Update school data
        $update_school_data = array(
            'UnitID' => $unit_id,
            'image_credit_link' => $image_credit_link,
        );
        $response = $this->schoolRepository->saveSchoolDetail($update_school_data);
        
        return ($response) ? Redirect::to('admin/list-school-logo')->with('success', trans('label.image_upload_success_msg')) : Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
    }

    public function upload_school_logo_post(FileManagementRequest $request) {
        
        $i = 0; // To get number of file upload
        $image_type_array = array(
            'logo',
            'main',
            'seal'
        );

        if($request->hasFile('school_logo')) {
            foreach ($request->school_logo as $logo) {

                $original_name = $logo->getClientOriginalName();

                $extension = '.' . $logo->getClientOriginalExtension();

                $file_name = pathinfo($original_name, PATHINFO_FILENAME); // file

                $name_array = explode(",", $file_name, 2);
                $unit_id = $name_array[0];
                $image_type = strtolower($name_array[1]);
                
                if(!is_numeric($unit_id) || !in_array($image_type, $image_type_array)) continue;
                $file_name = $unit_id . '_' . $image_type . '_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $logo->move($this->logo_original_path, $file_name.$extension);
                
                $image_type_id = (($image_type == 'logo') ? Config::get('constant.LOGO_IMAGE_FLAG') : (($image_type == 'main') ? Config::get('constant.MAIN_IMAGE_FLAG') : Config::get('constant.SEAL_IMAGE_FLAG')));
                
                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name.$extension,
                    'image_type' => $image_type_id
                );
                
                $response = $this->schoolRepository->save_school_logo($insert_data);
                if(!empty($response) && $response['action'] == 'Create') {
                    $i++;
                }
            }
            
            // Multiple File uploaded successfully
            return ($i > 0) ? Redirect::to('admin/list-school-logo')->with('success', $i . ' '. trans('label.upload_success_msg')) : edirect::to('admin/list-school-logo')->with('error', trans('label.upload_error_msg'));
            exit;
        } else {
            return Redirect::back()->withErrors([trans('label.select_file_msg')]);
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

    public function multipleImageUpload()
    {
        return view('admin.multiple-image-upload');
    }
}
