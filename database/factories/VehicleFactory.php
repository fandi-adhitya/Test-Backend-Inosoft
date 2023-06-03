<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'release_year'      => $this->faker->year,
          'color'             => $this->faker->colorName,
          'price'             => $this->faker->numberBetween(1000, 100000),
          'stock'             => $this->faker->numberBetween(1,5),
          'type'              => 'motorcycle',
          'engine'            => 'engine',
          'suspension_type'   => 'suspension',
          'transmision_type'  => 'transmision'
        ];
    }
}
