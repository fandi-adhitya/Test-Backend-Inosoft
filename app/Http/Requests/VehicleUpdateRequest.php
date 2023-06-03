<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
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
            'release_year'        => 'sometimes|integer|digits:4|gte:1900|lte:' . date('Y'),
            'color'               => 'sometimes|string',
            'price'               => 'sometimes|integer',
            'stock'               => 'sometimes|integer|min:1',
            'type'                => 'sometimes|string|in:' . implode(',', $possibleTypes),
            'engine'              => 'sometimes|string',
          
            'suspension_type'     => 'sometimes|required_if:type,' . \App\Models\Vehicle::MOTORCYCLE_TYPE . '|string',
            'transmision_type'    => 'sometimes|required_if:type,' . \App\Models\Vehicle::MOTORCYCLE_TYPE . '|string',

            'passenger_capacity'  => 'sometimes|required_if:type,' . \App\Models\Vehicle::CAR_TYPE . '|integer|min:1',
            'car_type'            => 'sometimes|required_if:type,' . \App\Models\Vehicle::CAR_TYPE . '|string',
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
            'release_year.integer'            => 'release_year must number',
            'release_year.digits'             => 'release_year must 4 digits',
            'release_year.gte'                => 'release_year must greather than 1900',
            'release_year.lte'                => 'release_year must less than ' . date('Y'),
            'color.string'                    => 'color must string',
            'price.integer'                   => 'price must number',
            'stock.integer'                   => 'stock must number',
            'stock.min'                       => 'stock minimum 1',
            'type.string'                     => 'type must string',
            'type.in'                         => 'type invalid, please provide ' . \App\Models\Vehicle::CAR_TYPE . ' or ' .  \App\Models\Vehicle::MOTORCYCLE_TYPE,
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
