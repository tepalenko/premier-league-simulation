<?php

namespace App\Services;

use App\Match;
use App\Team;
use App\Week;
use PremierLeagueSimulator\Prediction\Prediction;

class PredictionService
{
    public static function getPrediction()
    {
        $response = [];
        $finishedMatches = Match::finishedMatches();
        $totalWeeks = Week::getTotalWeeksNumber();
        if ($finishedMatches->isEmpty()) {
            $prediction = new Prediction(Team::all());
            $response =  $prediction->defaultValues();
        } else {
            $teamsStats = StatsService::teamsStats($finishedMatches);
            $prediction = new Prediction($teamsStats);
            $currentPrediction =  $prediction->calculate($totalWeeks, $finishedMatches->max('week_id'));
            $response = $currentPrediction->sortByDesc('win_probability')->values();
        }
        return $response;
    }
}
