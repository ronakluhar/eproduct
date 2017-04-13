<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ForgotAdminPasswordSendRequest extends Request {

    public function authorize() 
    {
        return true;
    }
    
    public function rules() 
    {
        return [
            'email' => 'required|email|exists:admin,email',
        ];
    }
}
