<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name' => 'required|string|max:40|unique:countries,name',
            'latitude' => 'sometimes|nullable|between:-90,90',
            'longitude' => 'sometimes|nullable|between:-180,180',
        ];

        if ($this->method() == 'PUT')
        {
            $rules['name'] = 'required|string|max:40|unique:countries,name,'.$this->country;
        }

        return $rules;
    }
}
