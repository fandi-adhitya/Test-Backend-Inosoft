<?php

namespace Tests\Feature;

use App\Contracts\Response;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Commons\WithUser;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use WithUser, WithFaker;

    /**
     * @return void
     */
    public function test_index()
    {
        $response = $this->get(
          '/api/vehicle',
          $this->getHeaders()
        );

        $response->assertStatus(Response::STATUS_OK);
        $response->assertJson(['message' => Response::MESSAGE_OK]);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'release_year',
                    'color',
                    'price',
                    'stock',
                    'car',
                    'motorcycle',
                    'createdAt',
                    'updatedAt'
                ]
            ],
            'meta' => [
                'total',
                'perPage',
                'currentPage',
                'lastPage'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_store()
    {
        $response = $this->post(
            'api/vehicle',
            [
              'release_year'      => $this->faker->year,
              'color'             => $this->faker->colorName,
              'price'             => $this->faker->numberBetween(1000, 100000),
              'stock'             => $this->faker->numberBetween(1,5),
              'type'              => 'motorcycle',
              'engine'            => 'engine',
              'suspension_type'   => 'suspension',
              'transmision_type'  => 'transmision'
            ],
            $this->getHeaders()
        );

        $response->assertStatus(Response::STATUS_CREATED);
        $response->assertJson(['message' => Response::MESSAGE_CREATED]);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'release_year',
                'color',
                'price',
                'stock',
                'car',
                'motorcycle',
                'createdAt',
                'updatedAt'
            ]
            ]);
    }

    /**
     * @return void
     */
    public function test_update() {
        $vehicle = Vehicle::factory()->create();

        $response = $this->put(
            'api/vehicle/' . $vehicle->id,
            [
              'release_year'      => $this->faker->year,
              'color'             => $this->faker->colorName,
              'price'             => $this->faker->numberBetween(1000, 100000),
            ],
            $this->getHeaders()
        );

      $response->assertStatus(Response::STATUS_OK);
      $response->assertJson(['message' => Response::MESSAGE_OK]);
      $response->assertJsonStructure([
          'data' => [
              'id',
              'release_year',
              'color',
              'price',
              'stock',
              'car',
              'motorcycle',
              'createdAt',
              'updatedAt'
          ]
          ]);
    }

    /**
     * @return void
     */
    public function test_delete(){
        $vehicle = Vehicle::factory()->create();

        $response = $this->delete(
            'api/vehicle/' . $vehicle->id,
            [],
            $this->getHeaders()
        );

        $response->assertStatus(Response::STATUS_NO_CONTENT);
        $response->assertNoContent();
    }
}
