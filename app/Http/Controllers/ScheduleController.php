<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ScheduleController extends Controller
{
    public function CalcDailyBalance()
    {
        $url     = config('app.url').'/api/CalcDailyBalance';
        $client = new Client(['verify' => false]);
        $client->get($url);
        
    }
}
