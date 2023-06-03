<?php

namespace Tests\Feature;

use App\Contracts\Response;
use Tests\Feature\Commons\WithUser;
use Tests\TestCase;

class MeTest extends TestCase
{
    use WithUser;
    /**
     * @return void
     */
    public function test_me()
    {
        $response = $this->get(
            '/api/me',
            $this->getHeaders()
          );
            
        $response->assertStatus(Response::STATUS_OK);
        $response->assertJson(['message' => Response::MESSAGE_OK]);
        $response->assertJsonStructure([
            'data' => [
                '_id',
                'name',
                'email',
                'updated_at',
                'created_at'
            ]
        ]);
    }
}
