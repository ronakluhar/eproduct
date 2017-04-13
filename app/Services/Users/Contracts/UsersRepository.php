<?php

namespace App\Services\Users\Contracts;

use App\Services\Repositories\BaseRepository;
use App\Services\Users\Entities\Users;

interface UsersRepository extends BaseRepository
{
    /**
     * @return array of all active Users in the application
    */
    public function getAllUsersData();

    /**
     * Save User detail passed in $userDetail array
    */
    public function saveUserDetail($userDetail);

    /**
     * $return boolean value for email exist in application
    */
    public function checkActiveEmailExist($email, $id = '');

    /**
     * $return boolean value for username exist in application
    */
    public function checkUserNameExist($username, $id = '');

    /**
     * $return array of Userdetail by username
    */
    public function getUserDetailByUsername($username);

    /**
     * $return array of Userdetail by email id
    */
    public function getUserDetailByEmail($email);

    public function updateUserTokenStatusByToken($token);

    public function updateUserVerifyStatusById($id);

    /**
     * update user password detail by user id
    */
    public function updateUserPassword($id,$password);

    /**
     * Delete user detail by user id
    */
    public function deleteUser($id);

    public function updateUserDetailById($profileData);

    public function getUserDetailById($id);
    /**
     * @return Array
     * @params
     * @facebookId : Facebook Id
     */
    public function checkFacbookIdExist($facebookId);
    /**
     * @return Array
     * @params
     * @googleId : Google Id
     */
    public function checkGoogleIdExist($googleId);
    /**
     * @return Array
     * @params
     * @email : email
     */
    public function checkEmailIdExist($emailId);

}
