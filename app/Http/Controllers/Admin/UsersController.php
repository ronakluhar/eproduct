<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Users\Contracts\UsersRepository;
use App\Services\AdminUsers\Contracts\AdminUsersRepository;
use App\Http\Requests\UpdateAdminProfileRequest;
use Input;
use Auth;
use Session;
use Redirect;
use App\User;
use App\Admin;
use App\Http\Requests\ChangePasswordRequest;
use Helpers;
class UsersController extends Controller
{
    public function __construct(UsersRepository $usersRepository, AdminUsersRepository $adminUsersRepository)
    {
    	$this->middleware('auth.admin');
        $this->usersRepository = $usersRepository;
        $this->adminUsersRepository = $adminUsersRepository;
        $this->objUsers  = new User();
        $this->objAdmin  = new Admin();
    }

    public function index()
    {
        $users = $this->usersRepository->getAllUsersData();

    	return view('admin.listUser', compact('users'));
    }

    public function createUser()
    {
        $userDetail = [];
    	return view('admin.createUser',compact('userDetail'));
    }

    public function delete($id) 
    {
        $userDetail = $this->objUsers->find($id);
        if($userDetail)
        {
            $return = $this->usersRepository->deleteUser($id);
            if ($return) {
                return Redirect::to("admin/list-user")->with('success', trans('admin.userdeletesuccess'));
            } else {
                return Redirect::to("admin/list-user")->with('error', trans('admin.commonerrormessage'));
            }
        }
        else
        {
            return Redirect::to('admin/list-user')->with('error', trans('admin.usernotfoundonyourrequest'));
        }    
        
    }

    public function save(){
        $body = Input::all();

        $userDetail = [];
        $userDetail['id'] = (isset($body['id']) && $body['id'] != '') ? e($body['id']) : 0;
        $userDetail['first_name'] = (isset($body['first_name']) && $body['first_name'] != '') ? e($body['first_name']) : '';
        $userDetail['last_name'] = (isset($body['last_name']) && $body['last_name'] != '') ? e($body['last_name']) : '';
        $userDetail['username'] = (isset($body['username']) && $body['username'] != '') ? strtolower(e($body['username'])) : '';
        $userDetail['email'] = (isset($body['email']) && $body['email'] != '') ? $body['email'] : '';
        $userDetail['phone'] = (isset($body['phone']) && $body['phone'] != '') ? $body['phone'] : '';
        $userDetail['gender'] = (isset($body['gender']) && $body['gender'] != '') ? e($body['gender']) : 1;
        $userDetail['deleted'] = (isset($body['deleted']) && $body['deleted'] != '') ? e($body['deleted']) : 1;

        $password = (isset($body['password']) && $body['password'] != '') ? bcrypt($body['password']) : '';

        if ($password != '') {
            $userDetail['password'] = $password;
        }

        if ($userDetail['id'] == 0) {
          if($userDetail['email'] != ''){
              $userEmailExist = $this->usersRepository->checkActiveEmailExist($userDetail['email']);
          }
          if($userDetail['username'] != ''){
              $userNameExist = $this->usersRepository->checkUserNameExist($userDetail['username']);
          }
        }
        if (isset($userEmailExist) && $userEmailExist) {
            return Redirect::to("admin/list-user")->with('error', trans('label.exist_user_msg'));
            exit;
        } elseif(isset($userNameExist) && $userNameExist){
            return Redirect::to("admin/list-user")->with('error', trans('label.exist_username_msg'));
            exit;
        }else{
            $result = $this->usersRepository->saveUserDetail($userDetail);
            if($result) {
                return Redirect::to("admin/list-user")->with('success', trans('admin.userupdatesuccess'));
            } else {
                return Redirect::to("admin/list-user")->with('error', trans('admin.default_error_msg'));
            }
        }
    }

    public function edit($id)
    {
        $userDetail = $this->objUsers->find($id);
        if($userDetail)
        {
            return view('admin.createUser', compact('userDetail'));
        }
        else
        {
            return Redirect::to('admin/list-user')->with('error', trans('admin.usernotfoundonyourrequest'));
        }
        
    }

    public function profile()
    {
        $userDetail = $this->adminUsersRepository->getActiveUserDetailById(Auth::guard('admin')->id());
        return view('admin.userProfile', compact('userDetail'));
    }

    public function saveProfile(UpdateAdminProfileRequest $updateAdminProfileRequest)
    {
        $data = [];
        $data['id'] = Auth::guard('admin')->id();
        $data['first_name'] = e(Input::get('first_name'));
        $data['last_name'] = e(Input::get('last_name'));
        $data['gender'] = (in_array(Input::get('gender'),['1', '2', '3']))?Input::get('gender') : "1";

        $saveUserDetail = $this->adminUsersRepository->saveUserProfileData($data);
        
        return Redirect::to('/admin/user-profile')->with('success',trans('label.profileupdatesuccessfully'));
    }

    public function changePassword(ChangePasswordRequest $changePasswordRequest)
    {
        $data = [];
        $password = Input::get('password');
        $newPassword = Input::get('new_password');
        $newPasswordConfirm = Input::get('new_password_confirm');

        $user = $this->objAdmin->find(Auth::guard('admin')->id());
        
        if($user && Auth::guard('admin')->attempt(['email' => $user->email, 'password' => $password, 'deleted' => 1]))
        {
            if($newPassword === $newPasswordConfirm)
            {
                $user->password = bcrypt(e($newPassword));
                $user->save();
                return Redirect::to('admin/user-profile')->with('success', trans('passwords.update'));          
            }
            else
            {
                return Redirect::to('admin/user-profile')->with('error', trans('passwords.new_and_old_must_same'));       
            }
        }
        else
        {
            return Redirect::to('admin/user-profile')->with('error', trans('passwords.old_not_correct'));
        }
    }

    public function getUserMessages($userId)
    {
        $messages = array();
        $userDetails = $this->usersRepository->getUserDetailById($userId);
        $adminData = $this->usersRepository->getAdminData();
        //get user first message if available then only we fetch more data
        $userFirstMessage = $this->usersRepository->getUserFirstMessage($userId);

        if(isset($userFirstMessage) && !empty($userFirstMessage)){
            $parentMessageId = $userFirstMessage->id;
            $messages = $this->usersRepository->getUserMessages($userId,$parentMessageId);
        }

        return view('admin.userMessages',compact('messages','userId','userDetails','adminData'));
    }

    public function saveNewMessage()
    {
        $postMessage = Input::get('message');
        $userId = Input::get('user_id');

        if(isset($postMessage) && $postMessage != ''){
            $isMessageAvailable = $this->usersRepository->getUserFirstMessage($userId);
            $userMessageData = [];
            $userMessageData['sender_id'] = Auth::guard('admin')->id();
            $userMessageData['receiver_id'] = $userId;
            $userMessageData['sender_user_type'] = 2;
            $userMessageData['message'] = $postMessage;
            $userMessageData['is_parent'] = (isset($isMessageAvailable) && !empty($isMessageAvailable))?$isMessageAvailable->id:'0';

            $message = $this->usersRepository->saveMessage($userMessageData);
            if($message) {
                return Redirect::to("admin/user-messages/".$userId)->with('success', trans('admin.usermessagesuccess'));
            } else {
                return Redirect::to("admin/list-user")->with('error', trans('admin.default_error_msg'));
            }
        }
        {
            return Redirect::to('admin/user-messages/'.$userId)->with('error', trans('admin.validmessagerequires'));
            exit;
        }
    }
}
