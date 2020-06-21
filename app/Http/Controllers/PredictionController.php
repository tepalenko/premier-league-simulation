<?php

namespace App\Http\Controllers;

use App\Services\PredictionService;
use App\Match;

class PredictionController extends Controller
{
    /**
     * Api call /prediction return prediction for all team after last week played matches.
     * If no matches played - return equal chances for win title for all teams
     *
     * @return string JSON
     */
    public function index()
    {
        $prediction = PredictionService::getPrediction();
        $response = [
            'week' => Match::currentWeek(),
            'prediction' => $prediction
        ];
        return response()->json($response);
    }
}
