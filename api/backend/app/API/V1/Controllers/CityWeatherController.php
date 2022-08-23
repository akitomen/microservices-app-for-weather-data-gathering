<?php

namespace App\API\V1\Controllers;

use App\API\V1\Traits\ApiResponseTrait;
use App\Models\City;
use App\Services\Weather\Stacks\Weatherstack;
use App\Services\WeatherService;
use Illuminate\Http\Resources\Json\JsonResource;

class CityWeatherController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Get  (
     *      tags={"Weather"},
     *      path="/",
     *      summary="All City weather",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful response with the result of the request",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="An error response.",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors.",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=403,
     *          description="User does not have the right permissions.",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * All City weather
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithResource(JsonResource::make([
            'cities' => City::with('lastWeather')->get()
        ]));
    }

    /**
     * @OA\Get  (
     *      tags={"Weather"},
     *      path="/update/{city_id}",
     *      summary="Weather Update city",
     *      security={{ "Bearer":{} }},
     *     @OA\Parameter(
     *        name="city_id",
     *        in="path",
     *        @OA\Schema(
     *           type="string"
     *        ),
     *        required=true,
     *        example="2"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful response with the result of the request",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="An error response.",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors.",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=403,
     *          description="User does not have the right permissions.",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * Weather Update city
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($city_id)
    {
        $city = City::findOrFail($city_id);

        $weather = (new WeatherService)->get(new Weatherstack, $city->name);

        if ($weather) {
            $city->weather()->create($weather);
            return $this->respondWithResource(JsonResource::make($weather));
        }

        return $this->respondWithResource(JsonResource::make(), 'Error', 500);
    }
}
