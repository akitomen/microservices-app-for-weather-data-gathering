<?php

namespace Tests\Feature\V1\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {

        $baseUrl = config()->get('app.url') . '/api/v1/auth/login';
        $login = 'login';
        $password = 'password';

        $this->postJson($baseUrl, [
            'login' => $login,
            'password' => $password
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'result' => ['access_token', 'expires_in', 'token_type'],
                'information' => ['timestamp', 'ttl', 'user' => ['id', 'name']],
                'success',
                'message'
            ]);
    }
}
