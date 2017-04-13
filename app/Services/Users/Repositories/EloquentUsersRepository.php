<?php

namespace App\Services\Users\Repositories;

use DB;
use Auth;
use Config;
use Helpers;
use App\Services\Users\Contracts\UsersRepository;
use App\Services\Repositories\Eloquent\EloquentBaseRepository;
use App\Services\Users\Entities\Messages;
use App\Admin;

class EloquentUsersRepository extends EloquentBaseRepository implements UsersRepository {

    /**
     * @return UserDetail Object
    */
    public function getAllUsersData()
    {
        $usersData = $this->model->where('deleted', '<>', 3)->get();
        //$usersData = $this->model->get();
        return $usersData;
    }
    /**
     * @return UserDetail Object
      Parameters
      @$userDetail : userDetail
    */
    public function saveUserDetail($userDetail) {
        if (isset($userDetail['id']) && $userDetail['id'] != '' && $userDetail['id'] > 0) {
            $returnUpdate = $this->model->where('id', $userDetail['id'])->update($userDetail);
            $return = $this->model->where('id', $userDetail['id'])->first();
        } else {
            $return = $this->model->create($userDetail);
        }
        return $return;
    }

    /**
     * @return Boolean True/False
      Parameters
      @$email : User's email
     */
    public function checkActiveEmailExist($email, $id = '') {
        if ($id != '') {
            $user = $this->model->where([['deleted', '<>', 3],['email','=', $email],['id', '!=', $id]])->first();
        } else {
            $user = $this->model->where([['deleted', '<>', 3],['email','=', $email]])->first();
        }

        if (count($user) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return Boolean True/False
      Parameters
      @$email : Username
     */
    public function checkUserNameExist($username, $id = '') {
        if ($id != '') {
            $user = $this->model->where([['deleted', '<>', 3],['username', $username],['id', '!=', $id]])->first();
        } else {
            $user = $this->model->where([['deleted', '<>', 3],['username', $username]])->first();
        }
        if (count($user) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDetailByUsername($username) {
        $user = $this->model->where([['deleted', 1],['username', $username]])->first();
        return $user;
    }

    public function getUserDetailByEmail($email) {
        $user = $this->model->where([['deleted', 1],['email', $email]])->first();
        return $user;
    }

    public function updateUserTokenStatusByToken($token) {
        $user = $this->model->where('verification_token', $token)->get();
        return $user;
    }

    public function updateUserVerifyStatusById($id){
        $user = $this->model->where('id', '=', $id)->update(['verification_token' => '','deleted' => 1]);
        return $user;
    }

    public function updateUserPassword($id,$password) {
        $user = $this->model->where('id', '=', $id)->update(['password' => $password]);
        return $user;
    }

    /**
     * @return Boolean True/False
      Parameters
      @$id : User ID
     */
    public function deleteUser($id) {
        $flag = true;
        $user = $this->model->find($id);
        $user->deleted = config::get('constant.DELETED_FLAG');
        $response = $user->save();
        if ($response) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserDetailById($profileData) {
        $return = $this->model->where('id', $profileData['id'])->update($profileData);

        return $return;
    }

    public function getUserDetailById($id) {
        $user = $this->model->where([['deleted', 1],['id', $id]])->first();
        return $user;
    }

    /**
     * @return Array
     * @params
     * @facebookId : Facebook Id
     */
    public function checkFacbookIdExist($facebookId)
    {
        $return = $this->model->where('facebook_id', $facebookId)->first();
        return $return;
    }
    /**
     * @return Array
     * @params
     * @googleId : Google Id
     */
    public function checkGoogleIdExist($googleId)
    {
        $return = $this->model->where('google_id', $googleId)->first();
        return $return;
    }
    /**
     * @return Array
     * @params
     * @email : email
     */
    public function checkEmailIdExist($emailId)
    {
        $return = $this->model->where('email', $emailId)->first();
        return $return;
    }
    
    /**
     * @return MessageDetail Object
      Parameters
      @MessageDetail : MessageDetail
    */
    public function saveMessage($messageData) {
        $return = Messages::create($messageData);
        return $return;
    }
    
    /**
     * @return Array
     * @params
     * @userId : userId
     */
    public function getUserMessages($userId,$parentMessageId)
    {
        $messagesData =  DB::table(config::get('databaseconstants.TBL_MESSAGES') . " AS msg ")
                ->Leftjoin(config::get('databaseconstants.TBL_USERS') . " AS user ", 'msg.sender_id', '=', 'user.id')
                ->select('msg.*','user.first_name','user.last_name')
                ->where('msg.id',$parentMessageId)
                ->OrWhere('msg.is_parent',$parentMessageId)
                ->where('msg.deleted',1)                
                ->orderBy('created_at','DESC')                
                ->get()
                ->toArray();
     
        return $messagesData;
    }
    
    /**
     * @return Array
     * @params
     * @userId : userId
     */
    public function getUserFirstMessage($userId)
    {        
        $matchSender = ['msg.sender_id' => $userId, 'sender_user_type' => 1];
        $matchReceiver = ['msg.receiver_id' => $userId, 'sender_user_type' => 2];
        $messageData =  DB::table(config::get('databaseconstants.TBL_MESSAGES') . " AS msg ")
                ->select('msg.*')
                ->where($matchSender)
                ->OrWhere($matchReceiver)                
                ->where('msg.deleted',1)                 
                ->first();
        return $messageData;
    }
    
    /**
     * @return Boolean True/False
      Parameters
      @$id : message Id
     */
    public function deleteMessage($messageId) {
        $flag = true;
        $message = Messages::find($messageId);        
        $message->deleted = config::get('constant.DELETED_FLAG');
        $response = $message->save();
        if ($response) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getAdminData()
    {
        $adminData = Admin::first();
        return $adminData;
    }
}