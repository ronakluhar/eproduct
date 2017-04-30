<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class ImageRequest extends FormRequest
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
        if($this->input('school_id')) {
            $rules = [
                'school_id' => 'required',
                'school_logo' => 'required|image|mimes:jpeg,bmp,png|max:5024',
                'school_main_image' => 'required|image|mimes:jpeg,bmp,png|max:5024',
                'school_seal_image' => 'required|image|mimes:jpeg,bmp,png|max:5024',
            ];
        }
        return $rules;        
    }
    
    public function messages() {
        
        $messages =[];
        if($this->input('school_id')) {
            $messages = [
                'school_id' => trans('label.namerequired'),
            ];
        }
        
        if(Input::hasFile('school_logo')) {
            $logo = Input::file('school_logo');
            $messages['school_logo.image'] = 'The logo ' . $logo->getClientOriginalName() . ' must be an image.';
            $messages['school_logo.mimes'] = 'The logo ' . $logo->getClientOriginalName() . ' must be a file of type: :values.';
            $messages['school_logo.max'] = 'The logo ' . $logo->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }
        if(Input::hasFile('school_main_image')) {
            $main = Input::file('school_main_image');
            $messages['school_main_image.image'] = 'The logo ' . $main->getClientOriginalName() . ' must be an image.';
            $messages['school_main_image.mimes'] = 'The logo ' . $main->getClientOriginalName() . ' must be a file of type: :values.';
            $messages['school_main_image.max'] = 'The logo ' . $main->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }
        if(Input::hasFile('school_logo')) {
            $seal = Input::file('school_logo');
            $messages['school_seal_image.image'] = 'The logo ' . $seal->getClientOriginalName() . ' must be an image.';
            $messages['school_seal_image.mimes'] = 'The logo ' . $seal->getClientOriginalName() . ' must be a file of type: :values.';
            $messages['school_seal_image.max'] = 'The logo ' . $seal->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }

        return $messages;        
    }
}
