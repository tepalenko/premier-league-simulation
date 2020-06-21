<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MatchService;
use App\Match;

class MatchResultsController extends Controller
{
    /**
     * Api call /matches/last-week return results last week played matches
     *
     * @return string JSON
     */
    public function lastWeek()
    {
        $lastWeekMatches = MatchService::getLastWeekMatches();
        $response = [
            'week' => Match::currentWeek(),
            'matches' => $lastWeekMatches->map(function ($match) {
                return MatchService::matchResultsFormatResponse($match);
            })
        ];
        return response()->json($response);
    }

    /**
     * Api call /matches/season return all results for played matches
     *
     * @return string JSON
     */
    public function season()
    {
        $matches = MatchService::getSeasonMatches();
        
        $response = [];
        foreach ($matches as $match) {
            $response['weeks'][$match->week_id][] = MatchService::matchResultsFormatResponse($match);
        }
        
        return response()->json($response);
    }

   /**
    * Api call /matches/update/{matchId} - update one match score
    *
    * @param Request $request - score and field values for update
    * @param [int] $matchId - match id in DB
    * @return string JSON
    */
    public function updateMatchScore(Request $request, $matchId)
    {
        $score = $request->input('score');
        $participant = $request->input('field');
        MatchService::updateMatchScore($matchId, $participant, $score);
        return response()->json([ 'success' => true ]);
    }
}
