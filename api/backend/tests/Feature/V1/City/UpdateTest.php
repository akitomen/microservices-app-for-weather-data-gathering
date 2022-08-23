<?php

namespace Tests\Feature\V1\City;

use App\Models\ApiUser;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateTest extends TestCase
{

    public function test_update()
    {
        $user = ApiUser::where('login', 'login')->first();
        $city = City::first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = config()->get('app.url') . "/api/v1/update/$city->id?token=$token";

        $this->getJson($baseUrl)
            ->assertStatus(200)
            ->assertJsonStructure([
                'result' => ['temperature', 'wind_speed'],
                'information' => ['timestamp', 'ttl', 'user' => ['id', 'name']],
                'success',
                'message'
            ]);
    }
}
