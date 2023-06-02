<?php

namespace Tests\Feature;

use App\Contracts\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @return void
     */
    public function test_success_authentication()
    {
        $response = $this->post(
            '/api/auth',
            [
                'email'     => 'admin@example.com',
                'password'  => 'password'
            ],
            [
              'Accept'      => 'application/json'
            ]
        );

        $response->assertStatus(Response::STATUS_OK);
        $response->assertJson(['message' => Response::MESSAGE_OK]);
        $response->assertJsonStructure([
            'data' => [
                'token'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_failed_authentication()
    {
        $response = $this->post(
            '/api/auth',
            [
                'email'     => 'admin@admin.com',
                'password'  => 'password'
            ],
            [
              'Accept'      => 'application/json'
            ]
        );
        
        $response->assertStatus(Response::STATUS_UNAUTHENTICATED);
        $response->assertJson(['message' => Response::MESSAGE_UNAUTHENTICATED]);
        $response->assertJsonStructure([
            'data' => [
                'message'
            ]
        ]);
    }
}
