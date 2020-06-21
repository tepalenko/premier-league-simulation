<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PremierLeagueSimulator\Prediction\Prediction;

class PredictionTest extends TestCase
{
    /**
     * Check default values before season start.
     * All teams should have equal prediction value.
     *
     * @test
     */
    public function checkDefaultValuesBeforeSeasonStart()
    {
        $teams = collect([
            [
                'name' => 'Liverpool',
                'id' => 1
            ],
            [
                'name' => 'Napoli',
                'id' => 2
            ]
        ]);
        $prediction = new Prediction($teams);
        $predictionDefaultValues = $prediction->defaultValues();
        $this->assertTrue(sizeof($predictionDefaultValues) === 2);
        foreach ($predictionDefaultValues as $team) {
            $this->assertTrue(isset($team['win_probability']));
            $this->assertTrue(isset($team['name']));
            $this->assertTrue($team['win_probability'] === 50);
        }
        $this->assertTrue(true);
    }

    /**
     *
     * Check prediction for 4 teams with different points and 3 matches left
     *
     * @test
     */
    public function checkPredictionCalculatedValues()
    {
        $teams = collect([
            (object)[
                'name' => 'Liverpool',
                'id' => 1,
                'stats' => [
                    'points' => 3
                ]
            ],
            (object)[
                'name' => 'Napoli',
                'id' => 2,
                'stats' => [
                    'points' => 6
                ]
            ],
            (object)[
                'name' => 'Man City',
                'id' => 3,
                'stats' => [
                    'points' => 9
                ]
            ],
            (object)[
                'name' => 'Inter',
                'id' => 4,
                'stats' => [
                    'points' => 0
                ]
            ],
        ]);
        $prediction = new Prediction($teams);
        $currentPrediction =  $prediction->calculate(6, 3);
        $this->assertTrue(sizeof($currentPrediction) === 4);
        foreach ($currentPrediction as $key => $team) {
            $this->assertTrue(isset($team->win_probability));
            $this->assertTrue(isset($team->name));
            switch ($key) {
                case 0:
                    $this->assertTrue($team->win_probability === 17);
                    break;
                case 1:
                    $this->assertTrue($team->win_probability === 33);
                    break;
                case 2:
                    $this->assertTrue($team->win_probability === 50);
                    break;
                case 3:
                    $this->assertTrue($team->win_probability === 0);
                    break;
            }
        }
        $this->assertTrue(true);
    }
    /**
     *
     * Check calculatePointsDiffByTeam method of Prediction class
     *
     * @test
     */
    public function checkPointsDiffMethod()
    {
        $teams = collect([
            (object)[
                'name' => 'Liverpool',
                'id' => 1,
                'stats' => [
                    'points' => 3
                ]
            ],
            (object)[
                'name' => 'Napoli',
                'id' => 2,
                'stats' => [
                    'points' => 6
                ]
            ],
            (object)[
                'name' => 'Man City',
                'id' => 3,
                'stats' => [
                    'points' => 9
                ]
            ],
            (object)[
                'name' => 'Inter',
                'id' => 4,
                'stats' => [
                    'points' => 0
                ]
            ],
        ]);
        $prediction = new Prediction($teams);
        $pointsDiffByTeam =  $prediction->calculatePointsDiffByTeam(6, 3);
        $this->assertTrue(sizeof($pointsDiffByTeam) === 4);
        foreach ($pointsDiffByTeam as $key => $team) {
            $this->assertTrue(isset($team->points_diff));
            $this->assertTrue(isset($team->name));
            switch ($key) {
                case 0:
                    $this->assertTrue($team->points_diff === 3);
                    break;
                case 1:
                    $this->assertTrue($team->points_diff === 6);
                    break;
                case 2:
                    $this->assertTrue($team->points_diff === 9);
                    break;
                case 3:
                    $this->assertTrue($team->points_diff === 0);
                    break;
            }
        }
        $this->assertTrue(true);
    }
    
     /**
     *
     * Check calculateWinProbability method of Prediction class
     *
     * @test
     */
    public function checkCalculateWinProbability()
    {
        $teams = collect([
            (object)[
                'name' => 'Liverpool',
                'id' => 1,
                'stats' => [
                    'points' => 3
                ]
            ],
            (object)[
                'name' => 'Napoli',
                'id' => 2,
                'stats' => [
                    'points' => 6
                ]
            ],
            (object)[
                'name' => 'Man City',
                'id' => 3,
                'stats' => [
                    'points' => 9
                ]
            ],
            (object)[
                'name' => 'Inter',
                'id' => 4,
                'stats' => [
                    'points' => 0
                ]
            ],
        ]);

        $prediction = new Prediction($teams);
        $prediction->calculatePointsDiffByTeam(6, 3);
        $winProbability = $prediction->calculateWinProbability(6);
        $this->assertTrue($winProbability === 0.33);
        $winProbability = $prediction->calculateWinProbability(9);
        $this->assertTrue($winProbability === 0.5);
    }
}
