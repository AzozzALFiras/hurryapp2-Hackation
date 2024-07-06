<?php

namespace App\Http\Controllers;

use App\Models\SaveLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function getLastResponse()
    {
        $lastLog = SaveLog::latest()->first(); // Get the latest record based on created_at timestamp
    
        if ($lastLog) {
           return json_decode($lastLog->message, true);
        }
    
        return response()->json(['error' => 'No logs found'], 404);
    }
}
