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
            'date'          => 'sometimes|nullable|date',
            'company_id'    => 'required|integer|exists:companies,id',
            'category_id'   => 'required|integer|exists:categories,id',
            'countries'   => 'required|array',
            'published_at'   => 'nullable',
            'countries.*'   => 'required|integer|exists:countries,id',

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

        if ($this->is('admin/offers*'))
        {
            $rules['featured']      = 'required|integer|in:1,2';
            $rules['state']         = 'required|integer|in:1,2';
            $rules['start_date']    = 'required_if:featured,2|sometimes|nullable|date';
            $rules['end_date']      = 'required_if:featured,2|sometimes|nullable|date|after:start_date';
            $rules['link']          = 'required_if:featured,2|sometimes|nullable|string|url';
        }

        return  $rules;
    }
}
