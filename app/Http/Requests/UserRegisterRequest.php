<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        return [
            'name'=> 'required|string|max:255',
            'email'=> 'nullable|string|email|unique:users|max:255',
            'mobile'=> 'nullable|string|unique:users|max:11',
            'password'=> 'required|string|min:6|confirmed',
            'role' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users',
            'referd_from' => 'nullable|exists:users,id',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->email && !$this->mobile) {
                $validator->errors()->add('email', 'Either email or mobile is required.');
                $validator->errors()->add('mobile', 'Either email or mobile is required.');
            }
        });
    }
}