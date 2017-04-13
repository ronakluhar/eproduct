<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserSignupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:20',
            'username' => 'required|min:6|max:20|unique:users,username',
            'email'      => 'required|min:5|max:100|unique:users,email',
            'password'   => 'required|min:6|max:20',
            'phone' => 'required|min:10|numeric',
        ];
    }
}
