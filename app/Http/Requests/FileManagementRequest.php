<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class FileManagementRequest extends FormRequest
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
        if($this->input('id') > 0 && $this->input('school_logo') != '') {
            $rules = [
                'school_logo' => 'required'
            ];
        }
        $logos = count($this->input('school_logo'));
        foreach(range(0, $logos) as $index) {
            $rules['school_logo.' . $index] = 'image|mimes:jpeg,bmp,png|max:5024';
        }
 
        return $rules;        
    }

    public function messages() {
        $messages = [
            'school_logo' => trans('label.namerequired'),
        ];
        
        if(Input::hasFile('school_logo')) {
            $logos = Input::file('school_logo');
            foreach ($logos as $key => $logo) {
                $messages['school_logo.' . $key . '.image'] = 'The logo ' . $logo->getClientOriginalName() . ' must be an image.';
                $messages['school_logo.' . $key . '.mimes'] = 'The logo ' . $logo->getClientOriginalName() . ' must be a file of type: :values.';
                $messages['school_logo.' . $key . '.max'] = 'The logo ' . $logo->getClientOriginalName() . ' may not be greater than :max kilobytes.';
            }
        }

        return $messages;        
    }
    
}
