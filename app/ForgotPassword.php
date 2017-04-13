<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ForgotPassword extends Authenticatable
{
    use Notifiable;

    const DEFAULT_PASSWORD = 'sonawala123';
    protected $table = 'forgot_password';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'users_id',
        'forgot_token',
        'users_type',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function saveForgotPasswordData($saveForgotData) {
        if (isset($saveForgotData['id']) && $saveForgotData['id'] != '' && $saveForgotData['id'] > 0) {
            $returnUpdate = $this->where('id', $saveForgotData['id'])->update($saveForgotData);
            $return = $this->where('id', $saveForgotData['id'])->first();
        } else {
            $return = $this->create($saveForgotData);
        }
        return $return;
    }

    public function getForgotPasswordData($token) {
        $return = $this->where('is_active',1)->where('forgot_token', $token)->get();
        return $return;
    }

    public function updateForgotPasswordData($id,$token) {
        $return = $this->where('users_id', '=', $id)->where('forgot_token',$token)->update(['is_active' => 2]);
        return $return;
    }
}

