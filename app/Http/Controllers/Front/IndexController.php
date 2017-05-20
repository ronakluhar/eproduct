<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Session;
use Redirect;
use App\User;
use Mail;
use Helpers;
use Config;
use App\Services\School\Contracts\SchoolRepository;

class IndexController extends Controller {

    public function __construct(SchoolRepository $schoolRepository) {
        $this->schoolRepository = $schoolRepository;
        $this->logo_original_path = Config::get('constant.SCHOOL_ORIGINAL_LOGO_PATH');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('front.home');
    }

    public function home() {
        
        $no_of_result = $this->schoolRepository->get_school_data_for_front()->count();
        $start_from = 0; // Start from
        $record_per_page = Config::get('constant.FRONT_RECORD_PER_PAGE'); // No. of record  per page
        $at_page = 1; // At page 1
        $no_of_pages = (intval($record_per_page) <= 0) ? ceil($no_of_result / $record_per_page) : 1; // No of pages
        
        return view('front.index', compact('no_of_result', 'start_from', 'record_per_page', 'at_page', 'no_of_pages'));
    }
    
    public function school_front_list_ajax() {
        $logo_path = $this->logo_original_path;
        $displayStart = Input::get('displayStart');
        $displayLength = Input::get('displayLength');
        
        $no_of_result = $this->schoolRepository->get_school_data_for_front()->count();
        $no_of_pages = ceil($no_of_result / $displayLength); // No of pages
        $school_data = $this->schoolRepository->get_school_data_for_front();
        
        $school_data = $school_data
                ->take($displayLength)
                ->skip($displayStart)
                ->get();
        foreach ($school_data as $key => $_school_data) {
            $school_data[$key]['image_path'] = ((!empty($_school_data['image_path'])) ? asset($logo_path.$_school_data['image_path']) : asset("images/front/clg-logo.jpg"));
        }

        return \Response::json(array(
            'list' => $school_data,
            'no_of_result' => $no_of_result,
            'no_of_pages' => $no_of_pages
        ));
    }

}
