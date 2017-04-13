<?php

namespace App\Http\Requests;

use Config;
use App\Http\Requests\Request;

class EmailTemplateRequest extends Request
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
                'templatename'         => 'required',
                'templatepseudoname'         => 'required',
                'subject'     => 'required',
                'body'    => 'required',
                'deleted' => 'required',
                 ];
    }

    public function messages() {
        return [
            'templatename.required' => trans('validation.templatenamerequiredfield'),
            'tempatepseudoname.required' => trans('validation.templatepseudonamerequiredfield'),
            'subject.required' => trans('validation.templatesubjectrequiredfield'),
            'body.required' => trans('validation.templatebobyrequiredfield'),
            'deleted.required' => trans('validation.templatestatusrequiredfield'),
           
        ];
    }
}
