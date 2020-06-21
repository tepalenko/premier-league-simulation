<?php

namespace PremierLeagueSimulator\Prediction;

class Prediction
{
    private $teamsStats;
    private $pointsDiffSum = 0;
    public function __construct($teamsStats)
    {
        $this->teamsStats = $teamsStats;
    }

    /**
     * Calculate prediction for win title based on played matches and current stats.
     *
     * @param [int] $totalWeeksCount - total weeks played.
     * @param [int] $currentWeek - last played week.
     * @return @Illuminate\Support\Collection teams collection with "win_probability" calculated value.
     */
    public function calculate($totalWeeksCount, $currentWeek)
    {
        $pointsDiffByTeam = $this->calculatePointsDiffByTeam($totalWeeksCount, $currentWeek);
        
        return $pointsDiffByTeam->map(function ($team) {
            $team->win_probability = $this->formatPredictionValue($this->calculateWinProbability($team->points_diff));
            return $team;
        });
    }

    /**
     * Calculate point differential between allowed points and current team points value.
     * Set value for total points differential sum between all teams.
     *
     * @param [int] $totalWeeksCount - total weeks played.
     * @param [int] $currentWeek - last played week.
     * @return @Illuminate\Support\Collection teams collection with "points_diff" calculated value.
     */
    public function calculatePointsDiffByTeam($totalWeeksCount, $currentWeek)
    {
        $pointsLeft = ($totalWeeksCount- $currentWeek) * 3;
        $firstPlacePoints = $this->teamsStats->max('stats.points');
        $pointsDiffByTeam  = $this->teamsStats->map(function ($team) use ($pointsLeft, $firstPlacePoints) {
            $pointsDiffValue = $pointsLeft - ($firstPlacePoints - $team->stats['points']);
            if ($pointsDiffValue > 0) {
                $this->pointsDiffSum += $pointsDiffValue;
            }
            $team->points_diff = $pointsDiffValue;
            return $team;
        });
        
        return $pointsDiffByTeam;
    }

    /**
     * Calculate win probability based on team points differential
     * and sum of all points differential for all teams.
     *
     * @param [int] $pointsDiff
     * @return float
     */
    public function calculateWinProbability($pointsDiff)
    {
        return $pointsDiff > 0 && $this->pointsDiffSum > 0 ? round($pointsDiff / $this->pointsDiffSum, 2) : 0;
    }

    /**
     * Return default (equal) values as prediction in case no matches played.
     * Prediction for each team calc as 1/teamsCount.
     *
     * @return @Illuminate\Support\Collection teams collection with "win_probability" default value.
     */
    public function defaultValues()
    {
        $win_probability = 1/sizeof($this->teamsStats);
        $prediction = $this->teamsStats->map(function ($item) use ($win_probability) {
            $item['win_probability'] = $this->formatPredictionValue($win_probability);
            return $item;
        });
        
        return $prediction;
    }

    /**
     * Format win probability value as percent.
     *
     * @param [float] $value - win probability value.
     * @return int
     */
    public function formatPredictionValue($value)
    {
        return intval($value * 100);
    }
}
