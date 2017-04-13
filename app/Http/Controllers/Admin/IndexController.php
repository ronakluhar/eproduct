<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use DB;
use Mail;
use Session;
use Redirect;
use Config;
use App\Admin;
use App\ForgotPassword;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\ForgotAdminPasswordSendRequest;
use App\Http\Requests\SetNewAdminPasswordRequest;
use App\Services\AdminUsers\Contracts\AdminUsersRepository;
use App\Services\ForgotPassword\Contracts\ForgotPasswordRepository;

class IndexController extends Controller
{
    public function __construct(AdminUsersRepository $adminUsersRepository, ForgotPasswordRepository $forgotPasswordRepository)
    {
        $this->adminUsersRepository = $adminUsersRepository;
        $this->forgotPasswordRepository = $forgotPasswordRepository;
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check())
        {
            return Redirect::to('admin/dashboard');
        }
        return view('admin.login');
    }
    /**
     * Display a login form if admin user is not login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::guard('admin')->check())
        {
            return Redirect::to('admin/dashboard');
        }
        return view('admin.login');
    }
    /**
     * Display a signup form for new signup.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        if(Auth::guard('admin')->check())
        {
            return Redirect::to('admin/dashboard');
        }
        return view('admin.signup');
    }
    /**
     * Display a forgot password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        if(Auth::guard('admin')->check())
        {
            return Redirect::to('admin/dashboard');
        }
        return view('admin.forgotPassword');
    }
    /**
     * Login for admin
     * @param : email, password
     * @AdminLoginRequest $adminLoginRequest
     * @method : doLogin[POST]
     * @return \Illuminate\Http\Response
     */
    public function doLogin(AdminLoginRequest $adminLoginRequest)
    {
        if(Auth::guard('admin')->check())
        { 
            return Redirect::to('/admin/dashboard');
        }

        $email = Input::get('email');
        $password = e(Input::get('password'));
        $remember = (Input::get('remember_token') == "on") ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'deleted' => 1], $remember))
        {
            return Redirect::to('/admin/dashboard');
        } 
        else 
        {
            return Redirect::back()->withInput()->withErrors(trans('validation.invalidcombo'));
        }
    }

    public function sendPassword(ForgotAdminPasswordSendRequest $forgotAdminPasswordSendRequest)
    {
        if(Auth::guard('admin')->check())
        {
            return Redirect::to('/admin/dashboard');
        }

        $email = trim(e(Input::get('email')));

        $getUserDetail = $this->adminUsersRepository->getActiveUserDetailByEmail($email);
        
        if($getUserDetail)
        {
            $randomStr = str_random(25);
            $data = array();
            $data['users_id'] = $getUserDetail->id;
            $data['forgot_token'] = $randomStr;
            $data['users_type'] = Config::get('constant.ADMIN_TYPE_ID');
            $data['is_active'] = Config::get('constant.ACTIVE_FLAG');

            $savePasswordRequestDetail = $this->forgotPasswordRepository->savePasswordRequestDetail($data);

            $data['first_name'] = $getUserDetail->first_name;
            $data['last_name'] = $getUserDetail->last_name;;
            $data['email'] = $getUserDetail->email;
            
            $content = 'Hi <strong>'.$data['first_name'].'</strong>, <br/><br/> Please click on the link below to Reset your Password. <strong></strong> <br/><br/><a href=' . url("admin/reset-password/" . $data['forgot_token']) . '>'. url("admin/reset-password/" . $data['forgot_token']) .'</a>';

            $data['content'] = $content;

            Mail::send(['html' => 'emails.PasswordResetLink'], $data, function($message) use ($data) {
                    $message->subject('Password Reset Request');
                    $message->to($data['email'], $data['first_name']);
                });

            return Redirect::to('/admin/forgot-password')->with('success',trans('passwords.sent'));
        }
        else
        {
            return Redirect::to('/admin/forgot-password')->with('error',trans('label.not_email'))->withInput();
        }
    }

    public function resetPassword($forgotToken)
    {
        $userType = Config::get('constant.ADMIN_TYPE_ID'); //Admin
        $getExistTokenDetail = $this->forgotPasswordRepository->getExistTokenDetail($forgotToken, $userType);
        
        if($getExistTokenDetail && $forgotToken != '')
        {
            Session::forget('password_token_admin');
            Session::set('password_token_admin',$forgotToken);
            Session::save();
            return view('admin.resetPassword', compact('forgotToken'));
        }
        else
        {
            $forgotToken = '';
            Session::forget('password_token_admin');
            return view('admin.resetPassword', compact('forgotToken'));
        }
    }

    public function setNewPassword(SetNewAdminPasswordRequest $setNewAdminPasswordRequest)
    {
        $forgot_token_session = Session::get('password_token_admin');
        $forgot_token_input = Input::get('forgot_token');
        if($forgot_token_input != '' && $forgot_token_session != '' && $forgot_token_session === $forgot_token_input)
        {
            $userType =  Config::get('constant.ADMIN_TYPE_ID'); //Admin
            $getExistTokenDetail = $this->forgotPasswordRepository->getExistTokenDetail($forgot_token_session, $userType);
            if($getExistTokenDetail)
            {
                $newPassword = bcrypt(Input::get('password'));
                $userDetail = $this->adminUsersRepository->getActiveUserDetailById($getExistTokenDetail->users_id);
                
                if($userDetail)
                {
                    $userDetailUpdate = Admin::where(['id'=>$getExistTokenDetail->users_id])->update(['password'=>$newPassword]);
                    
                    if(Auth::guard('admin')->attempt(['email' => $userDetail->email, 'password' => Input::get('password'), 'deleted'=>1]))
                    {
                        $setNewPassword = ForgotPassword::where(['forgot_token'=>$forgot_token_session])->update(['forgot_token'=>"", 'is_active' => 2]); 
                        Session::forget('password_token_admin');
                        return Redirect::to('/admin/dashboard')->with('success',trans('passwords.reset'));
                    }
                    else
                    {
                        return Redirect::to('/admin/login')->with('error',trans('passwords.something_wrong'));
                    }
                }
                else
                {
                    return Redirect::to('/admin/login')->with('error',trans('passwords.not_user'));
                }
            }
            else
            {
                return Redirect::back()->with('error',trans('passwords.no_request'));
            }
        }
        else
        {
            return Redirect::back()->with('error',trans('passwords.something_wrong'));
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return Redirect::to('/admin');
    }
    
}
