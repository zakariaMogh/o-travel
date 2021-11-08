<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name'          => 'required|string|max:200',
            'price'         => 'required|numeric',
            'description'   => 'sometimes|nullable|string',
            'date'          => 'required|date',
            'company_id'    => 'required|integer|exists:companies,id',
            'category_id'   => 'required|integer|exists:categories,id',

        ];

        if ($this->method() === 'POST')
        {
            $rules['images'] = 'required|array';
            $rules['images.*'] = 'required|file|image|max:5000';
        }

        if ($this->is('*company/offers*') && $this->method() === 'POST')
        {
            unset($rules['company_id']);
            $rules['images'] = 'required|array';
            $rules['images.*'] = 'required|file|image|max:5000';
        }

        if ($this->is('*company/offers*') && $this->method() === 'PUT')
        {
            unset($rules['company_id']);
        }

        if ($this->is('admin/Offer*'))
        {
            $rules['featured']      = 'required|boolean';
            $rules['start_date']    = 'required_if,featured,true|date';
            $rules['end_date']      = 'required_if,featured,true|date|after:start_date';
        }

        return  $rules;
    }
}
