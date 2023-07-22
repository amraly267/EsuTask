<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required','email', 'unique:users,email,'.last($this->segments()).',id'],
        ];

        if($this->_method == 'post')
        {
            $rules['password'] = 'required|min:8';
            $rules['confirm_password'] = 'required|same:password';
        }
        else
        {
            $rules['password'] = 'nullable|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
        }

        return $rules;
    }
}
