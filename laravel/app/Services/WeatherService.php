<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $apiKey = '2abebb2cfa654d61873232937240507';
    protected $baseUrl = 'https://api.weatherapi.com/v1';

    public function __construct()
    {
    }

    public function getCurrentWeather($location,$dt)
    {
        $client = new Client();

        // Example: Get current weather data by city name
        $response = $client->get("{$this->baseUrl}/forecast.json", [
            'query' => [
                'q' => $location,
                'key' => $this->apiKey,
                'days' => 7, 
                'dt' => $dt, 
                'aqi' => true,
                'alerts' => true,
                'lang' => 'ar', // Language for response (Arabic in this case)
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
