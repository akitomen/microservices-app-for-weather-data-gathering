<?php

namespace Tests\Feature\V1\City;

use App\Models\ApiUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ListingTest extends TestCase
{

    public function test_listing()
    {
        $user = ApiUser::where('login', 'login')->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = config()->get('app.url') . "/api/v1?token=$token";

        $this->getJson($baseUrl)
            ->assertStatus(200)
            ->assertJsonStructure([
                'result' => [
                    'cities' => [
                        ['id', 'name', 'last_weather' => ['temperature', 'wind_speed']]
                    ]
                ],
                'information' => ['timestamp', 'ttl', 'user' => ['id', 'name']],
                'success',
                'message'
            ]);
    }
}
