<?php

namespace PremierLeagueSimulator\Simulation;

class SimulateMatch
{
    const HOME_TEAM_ADVANTAGE = 10; // percentage
    const AVERAGE_SCORING = 1.8;

    /**
     * Simulate score between two teams depends on team rating, avarage scoring in league etc.
     *
     * @param [Object] $home_team - home team model.
     * @param [Object] $away_team - away team model.
     * @return Array - 0 - home team score, 1 - away team score.
     */
    public function simulateMatch($home_team, $away_team)
    {
        $home_team_random_value = mt_rand() / mt_getrandmax();
        $away_team_random_value = mt_rand() / mt_getrandmax();
        $home_team_score = round(
            ($home_team->rating + self::HOME_TEAM_ADVANTAGE/100 - $away_team->rating)/2
            + $away_team_random_value
            + self::AVERAGE_SCORING
        );
        $away_team_score = round(
            ($away_team->rating - $home_team->rating)/2
            + $home_team_random_value
            + self::AVERAGE_SCORING
        );
        return [$home_team_score, $away_team_score];
    }
}
