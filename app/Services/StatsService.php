<?php

namespace App\Services;

use App\Match;
use App\Team;
use PremierLeagueSimulator\TeamStats\TeamStats;

class StatsService
{
    public static function getCurrentStats()
    {
        $finishedMatches = Match::finishedMatches();
        return self::teamsStats($finishedMatches)->sortByDesc('stats.points')->values();
    }

    public static function teamsStats($finishedMatches)
    {
        $teamsStats = Team::all()->map(function ($item) use ($finishedMatches) {
            $teamMatches = $finishedMatches->filter(function ($match) use ($item) {
                return $match->home_team_id === $item->id || $match->away_team_id === $item->id;
            });
            $teamStats = new TeamStats($item->id, $teamMatches);
            $item['stats'] = $teamStats->calculate();
            return $item;
        });
        return $teamsStats;
    }
}
