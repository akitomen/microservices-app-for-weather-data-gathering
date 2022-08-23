<?php

namespace App\Services;

use App\Services\Weather\WeatherInterface;

class WeatherService
{
    public function get(WeatherInterface $weather, string $city, array $fields = [])
    {
        return $weather->get($city, $fields);
    }
}
