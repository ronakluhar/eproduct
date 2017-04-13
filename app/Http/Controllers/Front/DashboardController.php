<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Session;
use Redirect;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth.user');
    }

    public function index()
    {
    	return view('front.dashboard');
    }    
}
