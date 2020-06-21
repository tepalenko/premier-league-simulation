<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PremierLeagueSimulator\TeamStats\TeamStats;

class TeamStatsTest extends TestCase
{
    /**
     * Check one team stats calculate base on pre-set matches results
     *
     * @test
     */
    public function checkOneTeamStatsCalculate()
    {
        $matches = collect([
            (object)[
                'home_team_id' => 1,
                'away_team_id' => 2,
                'home_team_score' => 3,
                'away_team_score' => 2,
            ],
            (object)[
                'home_team_id' => 1,
                'away_team_id' => 3,
                'home_team_score' => 1,
                'away_team_score' => 2,
            ],
            (object)[
                'home_team_id' => 1,
                'away_team_id' => 4,
                'home_team_score' => 2,
                'away_team_score' => 2,
            ],
            (object)[
                'home_team_id' => 3,
                'away_team_id' => 1,
                'home_team_score' => 4,
                'away_team_score' => 2,
            ],
        ]);
        $teamId = 1;
        $prediction = new TeamStats($teamId, $matches);
        $teamStats =  $prediction->calculate();
        $requiredFields = [
            'points',
            'game_played',
            'wins',
            'draws',
            'loses',
            'goals_diff'
        ];
        foreach ($requiredFields as $filedName) {
            $this->assertTrue(isset($teamStats[$filedName]));
        }
        $this->assertTrue($teamStats['points'] === 4);
        $this->assertTrue($teamStats['game_played'] === 4);
        $this->assertTrue($teamStats['wins'] === 1);
        $this->assertTrue($teamStats['draws'] === 1);
        $this->assertTrue($teamStats['loses'] === 2);
        $this->assertTrue($teamStats['goals_diff'] === -2);
    }
}
