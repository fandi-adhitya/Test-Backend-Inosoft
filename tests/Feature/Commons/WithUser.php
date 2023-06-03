<?php

namespace Tests\Feature\Commons;

trait WithUser {
    /**
     * @return array $headers
     */
    protected function getHeaders() 
    {
        $headers = [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $this->getToken()
        ];

        return $headers;
    }

    /**
     * @return \Illuminate\Contracts\Auth\StatefulGuard 
     */
    protected function getToken() {
        return auth()->attempt([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
    }
}