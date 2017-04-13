<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserPasswordChangeRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
            return [
                //'currentPwd'  => ' | min : 6 | max : 20',
                'password'    => 'required | min : 6 | max : 20',
                'confirm_password'    => 'required | same:password',
           ];
    }
    
}
