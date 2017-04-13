<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Session;
use Redirect;
use App\Services\Users\Contracts\UsersRepository;
use App\Http\Requests\FrontLoginRequest;
use App\User;
use Mail;
use Helpers;
use Config;
use Socialite;
use Exception;

class LoginController extends Controller
{

    public function __construct(UsersRepository $UsersRepository) {
        $this->objUsersData = new User();
        $this->usersRepository = $UsersRepository;
    }

    /**
     * Display a login form if user is not login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(Auth::guard('user')->check())
        {
            return Redirect::to('/profile');
        }
        return view('front.user.signupLogin');
    }

    public function doLogin(FrontLoginRequest $frontLoginRequest)
    {
        if(Auth::guard('user')->check())
        {
            return Redirect::to('/profile');
        }

        $email = trim(Input::get('email'));
        $password = e(Input::get('password'));

        if (isset($email) && $email != '' && isset($password) && $password != '') 
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $userResult = $this->usersRepository->getUserDetailByUsername($email);
                if ($userResult) 
                {
                    if (Auth::guard('user')->attempt(['email' => $userResult['email'], 'password' => $password]))
                    {
                        return Redirect::to('/profile')->with('success', trans('label.welcome_profile_message'));
                    } 
                    else 
                    {
                        return Redirect::back()->withInput()->withErrors(trans('label.invalid_combo'));
                    }
                }
                else 
                {
                    return Redirect::back()->withInput()->withErrors(trans('label.not_valid_username'));
                }
            } 
            else 
            {
                $result = $this->usersRepository->getUserDetailByEmail($email);
                if ($result) 
                {
                    if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password]))
                    {
                        return Redirect::to('/profile')->with('success', trans('label.welcome_profile_message'));
                    }
                    else 
                    {
                        return Redirect::back()->withInput()->withErrors(trans('label.invalid_combo'));
                    }
                } 
                else 
                {
                    return Redirect::back()->withInput()->withErrors(trans('label.email_not_exist'));
                }
            }
        }
    }  
    //User logout
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return Redirect::to('/')->with('success', trans('label.logout_profile'));;
    }
}
