<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;
use Config;

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
        $rules = [];
        if($this->input('school_id')) {
            $rules = [
                'school_id' => 'required',
                'school_logo' => 'image|max:5024',
                'school_main_image' => 'image|max:5024',
                'school_seal_image' => 'image|max:5024',
            ];
        }
        
        if($this->input('id')) {
            $logo_exists_in_directory = file_exists(public_path(Config::get('constant.SCHOOL_ORIGINAL_LOGO_PATH').$this->input('school_logo_image')));
            $main_exists_in_directory = file_exists(public_path(Config::get('constant.SCHOOL_ORIGINAL_LOGO_PATH').$this->input('school_main')));
            $seal_exists_in_directory = file_exists(public_path(Config::get('constant.SCHOOL_ORIGINAL_LOGO_PATH').$this->input('school_seal')));
            
            if(!$logo_exists_in_directory || empty($this->input('school_logo_image')) ){
                $rules['school_logo'] = 'image|max:5024';
            }            
            if(!$main_exists_in_directory || empty($this->input('school_main')) ){
                $rules['school_main_image'] = 'image|max:5024';
            }      
            if(!$seal_exists_in_directory || empty($this->input('school_seal')) ){
                $rules['school_seal_image'] = 'image|max:5024';
            }            
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
        
        $logo = Input::file('school_logo');
        $messages['school_logo.required'] = 'Please select logo image.';
        if(Input::hasFile('school_logo')) {
            $messages['school_logo.image'] = 'The logo ' . $logo->getClientOriginalName() . ' must be an image.';
            $messages['school_logo.max'] = 'The logo ' . $logo->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }
        $main = Input::file('school_main_image');
        $messages['school_main_image.required'] = 'Please select main image.';
        if(Input::hasFile('school_main_image')) {
            $messages['school_main_image.image'] = 'The main image ' . $main->getClientOriginalName() . ' must be an image.';
            $messages['school_main_image.max'] = 'The main image ' . $main->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }
        $seal = Input::file('school_seal_image');
        $messages['school_seal_image.required'] = 'Please select seal image.';
        if(Input::hasFile('school_seal_image')) {
            $messages['school_seal_image.image'] = 'The seal image ' . $seal->getClientOriginalName() . ' must be an image.';
            $messages['school_seal_image.max'] = 'The seal image ' . $seal->getClientOriginalName() . ' may not be greater than :max kilobytes.';
        }

        return $messages;        
    }
}
