<?php

namespace Tests\Feature;

use App\Contracts\Response;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Commons\WithUser;
use Tests\TestCase;

use function PHPSTORM_META\map;

class TransactionTest extends TestCase
{
    use WithUser, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_transaction()
    {
        $vehicle = Vehicle::factory()->create();
        $response = $this->post(
          '/api/transaction',
          [
              'vehicle_id' => $vehicle->id,
              'customer'   => $this->faker->name,
              'quantity'   => 1
          ],
          $this->getHeaders()
        );

        $response->assertStatus(Response::STATUS_CREATED);
        $response->assertJson(['message' => Response::MESSAGE_CREATED]);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'customer',
                'quantity',
                'price_per_unit',
                'price_total',
                'vehicle'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_get_transaction_report_by_vehicle()
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->get(
            '/api/transaction/' . $vehicle->id . '/report',
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
                'transactions'
            ]
        ]);
    }
}
