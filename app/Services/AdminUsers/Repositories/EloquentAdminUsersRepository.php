<?php

namespace App\Services\AdminUsers\Repositories;

use DB;
use Auth;
use Config;
use Helpers;
use App\Services\AdminUsers\Contracts\AdminUsersRepository;
use App\Services\Repositories\Eloquent\EloquentBaseRepository;


class EloquentAdminUsersRepository extends EloquentBaseRepository implements AdminUsersRepository 
{
    /**
     * @return getActiveUserDetailByEmail Object
      Parameters
      @$email : email
    */
    public function getActiveUserDetailByEmail($email) 
    {
        $userDetail = $this->model->where(['deleted' => '1', 'email' => $email])->first();

        return $userDetail;
    }

    /**
     * @return getActiveUserDetailById Object
      Parameters
      @$id : id
    */
    public function getActiveUserDetailById($id) 
    {
        $userDetail = $this->model->where(['deleted' => '1', 'id' => $id])->first();

        return $userDetail;
    }

    /**
     * @return saveUserProfileData Object
      Parameters
      @$array : array
    */
    public function saveUserProfileData($array) 
    {   
      if(isset($array['id']))
      {
        $userDetail = $this->model->where('id' , $array['id'])->update($array);  
      }
      else
      {
        $userDetail = 0;
      }
      return $userDetail;
    }
    
}