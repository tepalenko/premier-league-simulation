<?php

namespace App\Http\Controllers;

use App\Services\StatsService;

class StandingsController extends Controller
{
    /**
     * Return teams standings and stats calculated for finished matches (weeks).
     *
     * @return string JSON
     */
    public function index()
    {
        $response = StatsService::getCurrentStats();
        return response()->json($response);
    }
}
