<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetNewAdminPasswordRequest extends Request {

    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'password' => 'required|min:6|max:20',
        ];
    }
}
