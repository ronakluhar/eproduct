<?php

namespace App\Services\ForgotPassword\Repositories;

use DB;
use Auth;
use Config;
use Helpers;
use App\Services\ForgotPassword\Contracts\ForgotPasswordRepository;
use App\Services\Repositories\Eloquent\EloquentBaseRepository;


class EloquentForgotPasswordRepository extends EloquentBaseRepository implements ForgotPasswordRepository 
{
    /**
     * @return getExistTokenDetail Object
      Parameters
      @$forgotToken : forgotToken
      @$userType : userType
    */
    public function getExistTokenDetail($forgotToken, $userType) 
    {
        if($forgotToken != "" && in_array($userType, ['1', '2']))
        {
          $tokenDetail = $this->model->where(['forgot_token' => $forgotToken, 'is_active' => 1, 'users_type' => $userType])->first();
        }
        else
        {
          $tokenDetail = [];
        }
        
        return $tokenDetail;
    }
    /**
     * @return savePasswordRequestDetail Object
      Parameters
      @$dataArray : $data
    */
    public function savePasswordRequestDetail($data)
    {
      $checkRequestExistOrNot = $this->model->where( ['users_id' => $data['users_id'] , 'users_type' => $data['users_type'] ])->first();
      
      if($checkRequestExistOrNot)
      {
          $savePasswordDetail = $this->model->where('id', $checkRequestExistOrNot->id)->update($data);
      }
      else
      {
          $savePasswordDetail = $this->model->create($data);
      }
      return $savePasswordDetail;
    }
}