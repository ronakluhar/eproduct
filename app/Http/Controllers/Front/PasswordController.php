<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Session;
use Redirect;
use App\Services\Users\Contracts\UsersRepository;
use App\Services\EmailTemplate\Contracts\EmailTemplatesRepository;
use App\Http\Requests\UserPasswordChangeRequest;
use App\User;
use Mail;
use Helpers;
use Config;
use App\ForgotPassword;

class PasswordController extends Controller
{
    public function __construct(UsersRepository $UsersRepository,EmailTemplatesRepository $EmailTemplatesRepository) {
        $this->objUsersData = new User();
        $this->UsersRepository = $UsersRepository;
        $this->EmailTemplatesRepository = $EmailTemplatesRepository;
    }
    /**
     * Display a forgot password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        if(Auth::guard('user')->check())
        {
            return Redirect::to('/home');
        }
        return view('front.user.forgotPassword');
    }

    public function sendPassword()
    {
        $email = e(Input::get('email'));
        $userDetail = $this->UsersRepository->getUserDetailByEmail($email);
        if (isset($userDetail) && count($userDetail) > 0){
            $token = Helpers::getVarifyToken();
            $saveForgotData = [];
            $saveForgotData['users_id'] = $userDetail['id'];
            $saveForgotData['forgot_token'] = $token;
            $saveForgotData['users_type'] = Config::get('constant.USER_TYPE_ID');
            $saveForgotData['is_active'] = Config::get('constant.ACTIVE_FLAG');;

            $objForgotPassword = new ForgotPassword();
            $result = $objForgotPassword->saveForgotPasswordData($saveForgotData);

            //Starting sending mail

            $replaceArray = array();
            $replaceArray['USER_NAME'] = $userDetail['first_name'];
            $replaceArray['URL'] = '<a href=' . url("reset-password?token=" . $token) . '>'. url("reset-password?token=" . $token) .'</a>';

            $emailTemplateContent = $this->EmailTemplatesRepository->getEmailTemplateDataByName(Config::get('constant.RESET_PASSWORD'));

            if($emailTemplateContent)
            {
                $content = $this->EmailTemplatesRepository->getEmailContent($emailTemplateContent->body, $replaceArray);
            }
            else
            {
                $content = 'Hi <strong>'.$userDetail['first_name'].'</strong>, <br/><br/> Please click on the link below to Reset your Password. <strong></strong> <br/><br/><a href=' . url("reset-password?token=" . $token) . '>'. url("reset-user?token=" . $token) .'</a>';
            }

            $data = array();
            $data['subject'] = (isset($emailTemplateContent->subject)) ? $emailTemplateContent->subject : "Forgot Password";
            $data['toEmail'] =$userDetail['email'];
            $data['toName'] = $userDetail['first_name'];
            $data['content'] = $content;

            Mail::send(['html' => 'emails.Template'], $data, function($message) use ($data) {
                $message->subject($data['subject']);
                $message->to($data['toEmail'], $data['toName']);
            });

            $responseMsg = 'Hi <strong>'.$userDetail['first_name'].'</strong>, <br/> The access link to reset your password has been sent to your registered eMailID <strong>'.$userDetail['email'].'</strong>';
            return Redirect::to("login")->with('success', $responseMsg);
            exit;

        } else {
            return Redirect::back()->withInput()->withErrors(trans('label.email_not_exist'));
        }
    }

    public function resetPassword() {
        $token=Input::get('token');
        if ($token) {
            $objForgotPassword = new ForgotPassword();
            $result = $objForgotPassword->getForgotPasswordData($token);
            if (isset($result) && count($result) > 0) {
                $id = $result[0]['users_id'];
                return view('front.user.resetPassword', compact('id','token'));
            } else {
                $varifymessage = trans('label.link_inactive');
                return Redirect::to("login")->with('success', $varifymessage);
            }
        }
    }

    public function setNewPassword() {
        $id= e(input::get('id'));
        $token= e(input::get('token'));
        $password= bcrypt(input::get('password'));

        $result = $this->UsersRepository->updateUserPassword($id,$password);
        if ($result) {
            $objForgotPassword = new ForgotPassword();
            $result = $objForgotPassword->updateForgotPasswordData($id,$token);
            $varifymessage = trans('label.resetpassword_success');
            return Redirect::to("login")->with('success', $varifymessage);
        }

    }

    public function changePassword(UserPasswordChangeRequest $UserPasswordChangeRequest) {

        //$user_id = e(input::get('id'));
        $user_id = Auth::guard('user')->id();
        $old_password = e(Input::get('currentPwd'));
        $new_password= bcrypt(Input::get('password'));
        $confirm_password= bcrypt(Input::get('confirm_password'));
        
        $user = User::find($user_id);
        $currentPassword = $user->password;
        if(Input::get('password') != Input::get('confirm_password'))
        {
            return Redirect::back()
                                ->withErrors(trans('label.both_password_not_match'));
        }
        if ($currentPassword != '') {
            if (Auth::guard('user')->attempt(['email' => $user->email, 'password' => $old_password, 'deleted' => 1])) {
                $user->password = $new_password;
                $user->save();
                return Redirect::to("/profile")->with('success', trans('label.resetpassword_success'));
            } else {
                return Redirect::back()
                                ->withErrors(trans('label.old_password_not_match'));
            }
        } else {
            $user->password = $new_password;
            $user->save();
            return Redirect::to("/profile")->with('success', trans('label.resetpassword_success'));
        }
    }
}