<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
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
            'name' => 'required|string|max:40|unique:domains,name',
            'description' => 'required|string|max:1000',
        ];

        if ($this->method() == 'PUT')
        {
            $rules['name'] = 'required|string|max:40|unique:domains,name,'.$this->domain;
        }

        return $rules;
    }
}
