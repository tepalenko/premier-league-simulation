<?php

namespace App\Services;

use App\Match;
use App\Team;
use App\Week;
use PremierLeagueSimulator\Simulation\SimulateMatch;

class SimulateService
{
    public static function simulateWeek($week)
    {
        $matches = Match::where('week_id', $week)->get();
        foreach ($matches as $match) {
            $home_team = Team::find($match->home_team_id);
            $away_team = Team::find($match->away_team_id);
            $simulate = new SimulateMatch();
            list($home_team_score, $away_team_score) = $simulate->simulateMatch($home_team, $away_team);
            Match::updateScore($match->id, $home_team_score, $away_team_score);
        }
        return true;
    }

    public static function simulateSeason($fromWeek)
    {
        $weeks_left = Week::where('id', '>=', $fromWeek)->get();
        foreach ($weeks_left as $week) {
            self::simulateWeek($week->id);
        }
        return true;
    }

    public static function flushSimulatedData()
    {
        Match::flushAllResults();
        return true;
    }
}
