<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FrontLoginRequest extends Request
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
            //'email'      => 'required|max:100|exists:users,email',
            'password'   => 'required|max:20|min:6'
        ];
    }
}
