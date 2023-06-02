<?php

namespace Tests\Feature\Commons;

trait WithUser {
    /**
     * @return void
     */
    protected function getToken() 
    {
        return auth()->attempt([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
    }
}