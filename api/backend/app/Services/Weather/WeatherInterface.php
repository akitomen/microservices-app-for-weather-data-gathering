<?php

namespace App\Services\Weather;

interface WeatherInterface
{

    public function get(string $city, array $fields = []);

}
