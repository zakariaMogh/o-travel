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
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', 'regex:/^(\+?\d{1,3}|\d{1,4})$/'],
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:90', 'unique:users,email'],
            'state' => 'required|in:1,2'
        ];

        if ($this->method() === 'PUT')
        {
            $rules['email'] = 'required|email|max:90|unique:users,email,'.$this->user;
        }

        if ($this->routeIs('admin.users*'))
        {
            $rules['state'] = 'required|in:1,2';
        }
        return $rules;
    }
}
