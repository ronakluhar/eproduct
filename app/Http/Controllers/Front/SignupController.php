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
use App\User;
use App\Http\Requests\UserSignupRequest;
use Mail;
use Helpers;
use Config;

class SignupController extends Controller
{

    public function __construct(UsersRepository $UsersRepository, EmailTemplatesRepository $EmailTemplatesRepository) {
        $this->objUsersData = new User();
        $this->UsersRepository = $UsersRepository;
        $this->EmailTemplatesRepository = $EmailTemplatesRepository;
    }

    public function signup()
    {
        if(Auth::guard('user')->check())
        {
            return Redirect::to('/home');
        }
        return view('front.user.signupLogin');
    }

    /**
     * Signup for user
     * @param : first_name,last_name, password,email
     * @method : doSignup[POST]
     * @return \Illuminate\Http\Response
     */
    public function doSignup(UserSignupRequest $UserSignupRequest)
    {
        $postData = Input::all();
        $userDetail = [];
        $userDetail['first_name'] = (isset($postData['first_name']) && $postData['first_name'] != '') ? e($postData['first_name']) : '';
        $userDetail['last_name'] = (isset($postData['last_name']) && $postData['last_name'] != '') ? e($postData['last_name']) : '';
        $userDetail['username'] = (isset($postData['username']) && $postData['username'] != '') ? strtolower(e($postData['username'])) : '';
        $userDetail['email'] = (isset($postData['email']) && $postData['email'] != '') ? $postData['email'] : '';
        $userDetail['password'] = (isset($postData['password']) && $postData['password'] != '') ? bcrypt($postData['password']) : '';
        $userDetail['phone'] = (isset($postData['phone']) && $postData['phone'] != '') ? e($postData['phone']) : '';
        $userDetail['deleted'] = Config::get('constant.INACTIVE_FLAG');

        if($userDetail['email'] != ''){
            $userEmailExist = $this->UsersRepository->checkActiveEmailExist($userDetail['email']);
        }

        if($userDetail['username'] != ''){
            $userNameExist = $this->UsersRepository->checkUserNameExist($userDetail['username']);
        }
        if (isset($userEmailExist) && $userEmailExist) {
            return Redirect::to("signup")->with('error', trans('label.exist_user_msg'));
            exit;
        } elseif(isset($userNameExist) && $userNameExist){
            return Redirect::to("signup")->with('error', trans('label.exist_username_msg'));
            exit;
        }else{
            $varifyToken = Helpers::getVarifyToken();
            $userDetail['verification_token'] = $varifyToken;
            $result = $this->UsersRepository->saveUserDetail($userDetail);

            //Starting sending mail

            $replaceArray = array();
            $replaceArray['USER_NAME'] = $userDetail['first_name'];
            $replaceArray['URL'] = '<a href=' . url("verify-user?token=" . $varifyToken) . '>'. url("verify-user?token=" . $varifyToken) .'</a>';

            $emailTemplateContent = $this->EmailTemplatesRepository->getEmailTemplateDataByName(Config::get('constant.USER_VARIFY'));
            if($emailTemplateContent)
            {
                $content = $this->EmailTemplatesRepository->getEmailContent($emailTemplateContent->body, $replaceArray);
            }
            else
            {
                $content = 'Hi <strong>'.$userDetail['first_name'].'</strong>, <br/><br/> Thank you for your registration request . Please click on the link below to complete your verification. <strong></strong> <br/><br/><a href=' . url("verify-user?token=" . $varifyToken) . '>'. url("verify-user?token=" . $varifyToken) .'</a>';
            }

            $data = array();
            $data['subject'] = (isset($emailTemplateContent->subject) && $emailTemplateContent->subject != "") ? $emailTemplateContent->subject : trans('label.lblheadsignup');
            $data['toEmail'] = $result['email'];
            $data['toName'] = $result['first_name'];
            $data['content'] = $content;

            Mail::send(['html' => 'emails.Template'], $data, function($message) use ($data) {
                $message->subject($data['subject']);
                $message->to($data['toEmail'], $data['toName']);
            });

            if($result){
                $responseMsg = 'Hi <strong>'.$userDetail['first_name'].'</strong>, <br/> The access link to activate your account has been sent to your registered eMailID <strong>'.$userDetail['email'].'</strong>';
                return Redirect::to("login")->with('success', $responseMsg);
                exit;
            }else{
                return Redirect::to("signup")->with('error', trans('label.missing_data_msg'));
                exit;
            }
        }
    }
}