<?php

namespace App\Services\Weather\Stacks;

use App\Services\Weather\WeatherInterface;
use Illuminate\Support\Facades\Http;

class Weatherstack implements WeatherInterface
{

    protected const NAME_FIELDS = [
        'temperature' => 'temperature',
        'wind_speed' => 'wind_speed',
    ];

    public function __construct()
    {
        $this->token = '0193cfaf201329f8b62f62e55cd979e4';
    }

    public function get(string $city, array $fields = [])
    {

        $fields = $this->getFields($fields);

        $response = Http::get('http://api.weatherstack.com/current', [
            'access_key' => $this->token,
            'query' => $city,
        ]);

        $result = $response->collect('current');

        return $this->setField($result->only($fields));
    }

    private function getFields($fields)
    {
        if ($fields) {
            $result = [];

            foreach ($fields as $field) {
                if (isset(self::NAME_FIELDS[$field]))
                    $result[] = self::NAME_FIELDS[$field];
            }

            return $result;
        }

        return array_values(self::NAME_FIELDS);
    }

    private function setField($items)
    {
        $data = [];
        foreach ($items as $filed => $value) {
            $name = array_search($filed, self::NAME_FIELDS);
            $data[$name] = $value;
        }

        return $data;
    }
}
