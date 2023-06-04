<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
        return [
            'vehicle_id'    => 'required|string|size:24|exists:' . \App\Models\Vehicle::class . ',_id',
            'customer'      => 'required|string',
            'quantity'      => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'vehicle_id.required'   => 'vehicle_id required',
            'vehicle_id.string'     => 'vehicle_id must string',
            'vehicle_id.exists'     => 'vehicle_id not found',
            'customer.required'     => 'customer required',
            'customer.string'       => 'custumer must string',
            'quantity.required'     => 'quantity required',
            'quantity.integer'      => 'quantity must number',
            'quantity.min'          => 'quantity minimum 1'
        ];
    }
}
