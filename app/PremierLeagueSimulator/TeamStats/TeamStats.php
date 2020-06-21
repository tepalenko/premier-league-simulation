<?php

namespace PremierLeagueSimulator\TeamStats;

class TeamStats
{
    private $teamMatches;
    private $teamId;
    public $defaultState = [
        'points' => 0,
        'game_played' => 0,
        'wins' => 0,
        'draws' => 0,
        'loses' => 0,
        'goals_diff' => 0
    ];
    public function __construct($teamId, $teamMatches)
    {
        $this->teamMatches = $teamMatches;
        $this->teamId = $teamId;
    }

    /**
     * Calculate team stats based on finished matches.
     *
     * @return Array - calculated team stats points, wins, draws etc.
     */
    public function calculate()
    {
        $teamStats = $this->defaultState;
        foreach ($this->teamMatches as $match) {
            $teamStats['points'] += $this->getPointsFromMatch($match);
            $teamStats['game_played']++;
            $teamStats['wins'] += $this->getWinFromMatch($match);
            $teamStats['draws'] += $this->getDrawFromMatch($match);
            $teamStats['loses'] += $this->getLoseFromMatch($match);
            $teamStats['goals_diff'] += $this->getGoalsDiff($match);
        }
        return $teamStats;
    }
    /**
     * Calculate earned points by team from match.
     * Win - 3 points.
     * Draw - 1 point.
     * Lose - 0.
     *
     * @param [Object] $match - match model.
     * @return int - earn points value
     */
    private function getPointsFromMatch($match)
    {
        switch (true) {
            case $match->home_team_score == $match->away_team_score:
                return 1;
            case $match->home_team_id === $this->teamId && $match->home_team_score > $match->away_team_score:
                return 3;
            case $match->away_team_id === $this->teamId && $match->away_team_score > $match->home_team_score:
                return 3;
            default:
                return 0;
        }
    }

    /**
     * Calculate win increment by team from match.
     * Win - 1.
     * Draw - 0.
     * Lose - 0.
     *
     * @param [Object] $match - match model.
     * @return int - increment value.
     */
    private function getWinFromMatch($match)
    {
        switch (true) {
            case $match->home_team_id === $this->teamId && $match->home_team_score > $match->away_team_score:
                return 1;
            case $match->away_team_id === $this->teamId && $match->away_team_score > $match->home_team_score:
                return 1;
            default:
                return 0;
        }
    }

    /**
     * Calculate lose increment by team from match.
     * Win - 0.
     * Draw - 0.
     * Lose - 1.
     *
     * @param [Object] $match - match model.
     * @return int - increment value.
     */
    private function getLoseFromMatch($match)
    {
        switch (true) {
            case $match->home_team_id === $this->teamId && $match->home_team_score < $match->away_team_score:
                return 1;
            case $match->away_team_id === $this->teamId && $match->away_team_score < $match->home_team_score:
                return 1;
            default:
                return 0;
        }
    }

     /**
     * Calculate draw increment by team from match.
     * Win - 0.
     * Draw - 1.
     * Lose - 0.
     *
     * @param [Object] $match - match model.
     * @return int - increment value.
     */
    private function getDrawFromMatch($match)
    {
        return $match->away_team_score == $match->home_team_score ? 1 : 0;
    }

    /**
     * Calculate goal diff value by team from match.
     *
     * @param [Object] $match - match model.
     * @return int - goal diff value.
     */
    private function getGoalsDiff($match)
    {
        switch (true) {
            case $match->home_team_id === $this->teamId:
                return $match->home_team_score - $match->away_team_score;
            case $match->away_team_id === $this->teamId:
                return $match->away_team_score - $match->home_team_score;
            default:
                return 0;
        }
    }
}
