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
use Input;
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
        return view('admin.list-school-logo');
    }

    /**
     * get_school_logo_list_ajax
     * To get School logo list from server side processing
     * @return (json) ($data) school logo list in json_encode
     */
    public function get_school_logo_list_ajax() {
        $columns = Input::get('columns');
        $order = Input::get('order');
        $search = Input::get('search');
        $search_list = 0;
        $records = array();
        $records["data"] = array();
        
        $total_records = $this->schoolRepository->getAllSchoolsLogo()->count();
        $display_length = ((intval(Input::get('length')) < 0) ? $total_records : intval(Input::get('length')));
        $display_start = intval(Input::get('start'));
        $draw = intval(Input::get('draw'));
        $records["data"] = $this->schoolRepository->getAllSchoolsLogo();
        
        if (!empty($search['value'])) {
            $val = $search['value'];
            $records["data"]->where(function($query) use ($val) {
                    $query->where('UnitID', 'LIKE', "%{$val}%")
                    ->orWhere('Institution_Name', 'LIKE', "%{$val}%");
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
                        'Institution_Name'
                    ]);
        }
        foreach ($records["data"] as $key => $record) {

            $records["data"][$key]->logo_image = '';
            $records["data"][$key]->main_image = '';
            $records["data"][$key]->seal_image = '';
            
            if(isset($record) && !empty($record) && isset($record->school) && count($record->school)> 0) {
                foreach ($record->school as $school_images) {
                    if($school_images->image_type == Config::get('constant.LOGO_IMAGE_FLAG')) {
                        
                        $records["data"][$key]->logo_image = '<img style="height:70px;width:70px;" alt="' . $school_images->image_path . '" src="'.asset($this->logo_original_path.$school_images->image_path).'">';
                    } else if($school_images->image_type == Config::get('constant.MAIN_IMAGE_FLAG')) {
                        $records["data"][$key]->main_image = '<img style="height:70px;width:70px;" alt="' . $school_images->image_path . '" src="'.asset($this->logo_original_path.$school_images->image_path).'">';
                    } else if($school_images->image_type == Config::get('constant.SEAL_IMAGE_FLAG')) {
                        $records["data"][$key]->seal_image = '<img style="height:70px;width:70px;" alt="' . $school_images->image_path . '" src="'.asset($this->logo_original_path.$school_images->image_path).'">';
                    }
                }
            }
            
            $records["data"][$key]->action = '<a href="'.url('/admin/delete-school-logo').'/'.$record->UnitID.'"><i class="i_delete fa fa-trash"></i>&nbsp;&nbsp;</a>' .
                    '<a href="'.url('/admin/update-school-logo').'/'.$record->UnitID.'"><i class="edit fa fa-edit"></i>&nbsp;&nbsp;</a>';
            unset($record->school);
            $search_list++;
        }

        if (!empty($search['value'])) {
            $total_records = $search_list;
        }
        $records["draw"] = $draw;
        $records["recordsTotal"] = $total_records;
        $records["recordsFiltered"] = $total_records;

        echo json_encode($records);         
        exit;
    }

    // Upload new logos
    public function upload_school_logo() {
        $schoolDatas = $this->schoolRepository->getSchoolUnitIdName();
        return view('admin.upload-logo', compact('schoolDatas'));
    }

    // Edit school logo
    public function update_school_logo($unit_id) {
        $logo_path = $this->logo_original_path;

        $school_image_detail = School::with('school')->where('UnitID', $unit_id)->where('deleted', '<>', Config::get('constant.DELETED_FLAG'))->first();

        if (!isset($school_image_detail) || empty($school_image_detail) || (!isset($school_image_detail->school) || count($school_image_detail->school) == 0)) {
            return Redirect::to('admin/school-logo-list')->with('error', trans('admin.imagenotfoundonyourrequest'));
        }
        return view('admin.upload-logo', compact('school_image_detail', 'logo_path'));
    }

    public function upload_school_images_post(ImageRequest $request) {

        $unit_id = ($request->school_id) ? $request->school_id : $request->id;
        $image_credit_link = $request->school_credit_link;
        
        $unit_id = (int) $unit_id;

        $school = School::where('UnitID', $unit_id)->first();

        if (!$school) {
            return Redirect::back()->withInput()->withErrors(['Something went wrong. Please try again.']);
        }
        
        if(isset($request->school_id) && !$request->hasFile('school_logo') && !$request->hasFile('school_main_image') && !$request->hasFile('school_seal_image')) {
            return Redirect::back()->withInput()->withErrors([trans('label.select_file_msg')]);
        }

        try {
            // Upload logo image
            if ($request->hasFile('school_logo')) {
                $school_logo = $request->school_logo;

                $extension = '.' . $school_logo->getClientOriginalExtension();

                $file_name = $unit_id . '_logo_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_logo->move($this->logo_original_path, $file_name . $extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name . $extension,
                    'image_type' => Config::get('constant.LOGO_IMAGE_FLAG')
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }

        try {
            // Upload main image
            if ($request->hasFile('school_main_image')) {
                $school_main_image = $request->school_main_image;

                $extension = '.' . $school_main_image->getClientOriginalExtension();

                $file_name = $unit_id . '_main_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_main_image->move($this->logo_original_path, $file_name . $extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name . $extension,
                    'image_type' => Config::get('constant.MAIN_IMAGE_FLAG'),
                    'image_credit_link' => $image_credit_link
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            } else {
                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_type' => Config::get('constant.MAIN_IMAGE_FLAG'),
                    'image_credit_link' => $image_credit_link
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }

        try {
            // Upload seal image
            if ($request->hasFile('school_seal_image')) {
                $school_seal_image = $request->school_seal_image;

                $extension = '.' . $school_seal_image->getClientOriginalExtension();

                $file_name = $unit_id . '_seal_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $school_seal_image->move($this->logo_original_path, $file_name . $extension);

                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name . $extension,
                    'image_type' => Config::get('constant.SEAL_IMAGE_FLAG')
                );
                $response = $this->schoolRepository->save_school_logo($insert_data);
            }
        } catch (Exception $ex) {
            Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')]);
        }
        return (($response && isset($request->school_id)) ? Redirect::to('admin/school-logo-list')->with('success', trans('label.image_upload_success_msg')) : (($response && isset($request->id)) ? Redirect::to('admin/school-logo-list')->with('success', trans('label.image_update_success_msg')) : Redirect::back()->withInput()->withErrors([trans('label.default_error_msg')])));
    }

    public function upload_school_logo_post(FileManagementRequest $request) {

        $i = 0; // To get number of file upload
        $j = 0; // To get number of file updated
        $image_type_array = array(
            'logo',
            'main',
            'seal'
        );

        if ($request->hasFile('school_logo')) {
            foreach ($request->school_logo as $logo) {

                $original_name = $logo->getClientOriginalName();
                
                $extension = '.' . $logo->getClientOriginalExtension();

                $file_name = pathinfo($original_name, PATHINFO_FILENAME); // file
                
                $name_array = explode(",", $file_name, 2);
                
               
                $unit_id = (int)$name_array[0];
                
                //check if this is valid school id 
                $school = School::where('UnitID', $unit_id)->first();
                if(!($school)){
                    continue;
                }
                
                $image_type = strtolower($name_array[1]);
                
                if (!is_numeric($unit_id) || !in_array($image_type, $image_type_array))
                    continue;
                $file_name = $unit_id . '_' . $image_type . '_' . str_random(5);

                if (!file_exists($this->logo_original_path)) {
                    File::makeDirectory($this->logo_original_path, 0777, true, true);
                }
                $logo->move($this->logo_original_path, $file_name . $extension);

                $image_type_id = (($image_type == 'logo') ? Config::get('constant.LOGO_IMAGE_FLAG') : (($image_type == 'main') ? Config::get('constant.MAIN_IMAGE_FLAG') : Config::get('constant.SEAL_IMAGE_FLAG')));
                
                $insert_data = array(
                    'UnitID' => $unit_id,
                    'image_path' => $file_name . $extension,
                    'image_type' => $image_type_id
                );

                $response = $this->schoolRepository->save_school_logo($insert_data);
                if (!empty($response) && $response['action'] == 'Create') {
                    $i++;
                } else if(!empty($response) && $response['action'] == 'Update') {
                    $j++;
                }
            }
            
            $msgArray = [];
            if($i > 0) {
                array_push($msgArray, $i . ' ' . trans('label.upload_success_msg'));
            }
            if($j > 0) {
                array_push($msgArray, $j . ' ' . trans('label.update_success_msg'));
            }
            
            $msg = (!empty($msgArray) ? implode(' ', $msgArray) : '');
            // Multiple File uploaded successfully
            return ($i > 0 || $j > 0) ? Redirect::to('admin/school-logo-list')->with('success', $msg) : Redirect::to('admin/school-logo-list')->with('error', trans('label.upload_error_msg'));
        } else {
            return Redirect::back()->withErrors([trans('label.select_file_msg')]);
        }
    }

    public function delete_school_logo($unit_id) {
        
        $school = $this->schoolRepository->getSchoolDetailByUnitId($unit_id);
        if ($school) {
            
            $response = $this->schoolRepository->delete_school_images($unit_id);
            return ($response && !empty($response) && $response['status'] == 'OK') ? Redirect::to("admin/school-logo-list")->with('success', trans('admin.schoolimagesdeletesuccess')) : Redirect::to("admin/school-logo-list")->with('error', trans('admin.commonerrormessage'));
        } else {
            return Redirect::to('admin/school-logo-list')->with('error', trans('admin.imagenotfoundonyourrequest'));
        }
    }

    public function multipleImageUpload() {
        return view('admin.multiple-image-upload');
    }

}
