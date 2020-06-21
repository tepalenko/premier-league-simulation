<?php

namespace App\Services;

use App\Match;
use App\Team;

class MatchService
{
    public static function getLastWeekMatches()
    {
        return Match::finishedMatches()->sortByDesc('id')->take(2);
    }
    
    public static function getSeasonMatches()
    {
        return Match::finishedMatches()->sortByDesc('id');
    }

    public static function updateMatchScore($matchId, $participant, $score)
    {
        $match = Match::find($matchId);
        if ($participant === 'home_team_score') {
            $home_team_score = $score;
            $away_team_score = $match->away_team_score;
        } else {
            $away_team_score = $score;
            $home_team_score = $match->home_team_score;
        }
        Match::updateScore($matchId, $home_team_score, $away_team_score);
        return true;
    }

    public static function matchResultsFormatResponse($match)
    {
        return [
            'home_team_score' => $match->home_team_score,
            'away_team_score' => $match->away_team_score,
            'home_team_name' => $match->getHomeTeam->name,
            'away_team_name' => $match->getAwayTeam->name,
            'match_id' => $match->id
        ];
    }
}
