<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Auth;
use Input;
use DB;
use Config;
use App\User;
use App\Services\Users\Contracts\UsersRepository;

class VerifyUserManagementController extends Controller
{
    public function __construct(UsersRepository $UsersRepository)
    {
       $this->UsersRepository = $UsersRepository;
    }

    public function index()
    {
        $token=input::get('token');
        if ($token) {
            $userTokenVarify = $this->UsersRepository->updateUserTokenStatusByToken($token);
            if (count($userTokenVarify) > 0) {
                $users = $this->UsersRepository->updateUserVerifyStatusById($userTokenVarify[0]['id']);
                if ($users) {
                    $varifymessage = trans('label.email_verify_msg');
                } else {
                  $varifymessage = trans('label.default_error_msg');
                }
           }
            else
            {
                $varifymessage = trans('label.already_email_verify_msg');
            }
        }
        return view('front.VarifyUser', compact('varifymessage'));
    }
}