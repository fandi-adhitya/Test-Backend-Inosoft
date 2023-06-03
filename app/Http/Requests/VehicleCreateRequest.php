<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCreateRequest extends FormRequest
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
        $possibleTypes = [
            \App\Models\Vehicle::CAR_TYPE,
            \App\Models\Vehicle::MOTORCYCLE_TYPE
        ];

        return [
            'release_year'        => 'required|integer|digits:4|gte:1900|lte:'.date('Y'),
            'color'               => 'required|string',
            'price'               => 'required|integer',
            'stock'               => 'required|integer|min:1',
            'type'                => 'required|string|in:' . implode(',', $possibleTypes),
            'engine'              => 'required|string',
          
            'suspension_type'     => 'required_if:type,' . \App\Models\Vehicle::MOTORCYCLE_TYPE . '|string',
            'transmision_type'    => 'required_if:type,' . \App\Models\Vehicle::MOTORCYCLE_TYPE . '|string',

            'passenger_capacity'  => 'required_if:type,' . \App\Models\Vehicle::CAR_TYPE . '|integer|min:1',
            'car_type'            => 'required_if:type,' . \App\Models\Vehicle::CAR_TYPE . '|string',
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
            'release_year.required'           => 'release_year required',
            'release_year.integer'            => 'release_year must number',
            'release_year.digits'             => 'release_year must 4 digits',
            'release_year.gte'                => 'release_year must greather than 1900',
            'release_year.lte'                => 'release_year must less than ' . date('Y'),
            'color.required'                  => 'color required',               
            'color.string'                    => 'color must string',
            'price.required'                  => 'price required',
            'price.integer'                   => 'price must number',
            'stock.required'                  => 'stock required',
            'stock.integer'                   => 'stock must number',
            'stock.min'                       => 'stock minimum 1',
            'type.required'                   => 'type required',
            'type.string'                     => 'type must string',
            'type.in'                         => 'type invalid, please provide ' . \App\Models\Vehicle::CAR_TYPE . ' or ' .  \App\Models\Vehicle::MOTORCYCLE_TYPE,
            'engine.required'                 => 'engine required',
            'engine.string'                   => 'engine must string',

            'suspension_type.required_if'     => 'suspension_type required',
            'suspension_type.string'          => 'suspension_type must string',
            'transmision_type.required_if'    => 'transmision_type required',
            'transmision_type.string'         => 'transmision_type must string',

            'passenger_capacity.required_if'  => 'passenger_capacity required',
            'passenger_capacity.integer'      => 'passenger_capacity must number',
            'passenger_capacity.min'          => 'passenger_capacity minimum 1',
            'car_type.required_if'            => 'car_type required',
            'car_type.string'                 => 'car_type must string',

            
        ];
    }
}
