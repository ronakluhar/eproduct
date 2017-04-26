<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            'school_logo' => 'required'
        ];
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

        if($this->input('school_logo')) {
            $logos = $this->input('school_logo');
            foreach ($logos as $key => $logo) {
                $messages['school_logo.' . $key . '.image'] = 'The logo ' . $logo->getClientOriginalName() . ' must be an image.';
                $messages['school_logo.' . $key . '.mimes'] = 'The logo ' . $logo->getClientOriginalName() . ' must be a file of type: :values.';
                $messages['school_logo.' . $key . '.max'] = 'The logo ' . $logo->getClientOriginalName() . ' may not be greater than :max kilobytes.';
            }
        }

//        $v = $factory->make($this->all(), $this->rules(),$messages);
//        $v->each('doc', ['required','mimes:pdf,doc,docx,jpg,jpeg,png|max:2048']);
        return $messages;        
        
//        return [
//            'school_logo' => trans('label.namerequired'),
//            'school_logo[].image' => trans('label.imagefilerequired'),
//            'school_logo[].mimes' => trans('label.mimenotvalid')
//        ];
    }
    
}
