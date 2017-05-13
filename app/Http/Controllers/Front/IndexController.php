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
        
        $school_data = $this->schoolRepository->get_school_data_for_front()->paginate(Config::get('constant.FRONT_RECORD_PER_PAGE'));
        $no_of_result = $this->schoolRepository->get_school_data_for_front()->count();
        $logo_path = $this->logo_original_path;
        
        return view('front.index', compact('school_data', 'logo_path', 'no_of_result'));
    }

}
