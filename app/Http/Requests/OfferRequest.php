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
        return false;
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

        if ($this->is('admin/Offer*'))
        {
            $rules['featured']      = 'required|boolean';
            $rules['start_date']    = 'required_if,featured,true|date';
            $rules['end_date']      = 'required_if,featured,true|date|after:start_date';
        }

        return  $rules;
    }
}
