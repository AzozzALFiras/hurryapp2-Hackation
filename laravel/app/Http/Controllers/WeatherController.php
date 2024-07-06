<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SaveLog;
use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        // Example location (you can use a dynamic location input here)
        $location = $request->input('search', 'Baghdad, iraq');
         // Get the current day and date in Arabic
         $day = Carbon::now()->locale('ar')->translatedFormat('l'); // Day of the week in Arabic
         $date = Carbon::now()->locale('ar')->translatedFormat('j F، Y'); // Day of the month, month name, year in Arabic
         

        
        // Get current weather data
        $weatherData = $this->weatherService->getCurrentWeather($location,$date);

        
         $lastLog = SaveLog::latest()->first(); // Get the latest record based on created_at timestamp

       // Retrieve logs based on date range
       $date_from = $request->input('date_from');
       $date_to = $request->input('date_to');
   
       $saveLogsQuery = SaveLog::query();
   
       if ($date_from && $date_to) {
           // Filter by date range if both date_from and date_to are provided
           $saveLogsQuery->whereDate('created_at', '>=', $date_from)
                         ->whereDate('created_at', '<=', $date_to);
       }
       $saveLogsQuery->orderBy('id', 'desc'); // Add orderBy clause
       $saveLogs = $saveLogsQuery->latest()->paginate(25);    

    
        // Prepare data for view
        $viewData = [
            'day' => $day, // Current day
            'date' => $date, // Current date
            'location' => $location,
            'weather' => $weatherData,
            'info' => $request->input('search') ? '' : json_decode($lastLog->message),
            'saveLogs' => $saveLogs
        ];

        return view('weather.index', $viewData);
    }


    public function details(Request $request)
    {
         // Example location (you can use a dynamic location input here)
         $location = $request->input('search', 'Baghdad, iraq');
         $dt = $request->input('dt');

         // Get current weather data
         $weatherData = $this->weatherService->getCurrentWeather($location, $dt);
 
          // Get the current day and date in Arabic
          $day = Carbon::now()->locale('ar')->translatedFormat('l'); // Day of the week in Arabic
          $date = Carbon::now()->locale('ar')->translatedFormat('j F، Y'); // Day of the month, month name, year in Arabic

          // Prepare data for view
        $viewData = [
            'day' => $day, // Current day
            'date' => $date, // Current date
            'location' => $location,
            'weather' => $weatherData,
        ];

          
    return view('weather.details', $viewData);
    }
}
