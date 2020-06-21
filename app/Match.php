<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public static function finishedMatches()
    {
        return self::where('finished', true)->get();
    }
    
    public static function flushAllResults()
    {
        $matches = self::all();
        foreach ($matches as $match) {
            $score = self::find($match->id);
            $score->home_team_score = 0;
            $score->away_team_score = 0;
            $score->finished = false;
            $score->save();
        }
    }

    public static function currentWeek()
    {
        $lastWeekMatch = self::finishedMatches()->sortByDesc('id')->first();
        return $lastWeekMatch === null ? 0 : $lastWeekMatch->week_id;
    }
    public static function updateScore($matchId, $home_team_score, $away_team_score) {
        $match = self::find($matchId);
        $match->home_team_score = $home_team_score;
        $match->away_team_score = $away_team_score;
        $match->finished = true;
        $match->save();
    }
    public function getHomeTeam()
    {
        return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function getAwayTeam()
    {
        return $this->belongsTo('App\Team', 'away_team_id');
    }
}
