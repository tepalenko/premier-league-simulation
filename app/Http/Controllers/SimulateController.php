<?php

namespace App\Http\Controllers;

use App\Match;
use App\Services\SimulateService;

class SimulateController extends Controller
{
    /**
     * Api call /simulate/{type} - runs simulate next week or all matches.
     *
     * @param [string] $type - type of simulation. Accepted values: week, all.
     * @return string JSON
     */
    public function index($type)
    {
        $last_match = Match::finishedMatches()->sortByDesc('id')->first();
        $simulate_week = $last_match === null ? 1 : $last_match->week_id + 1;
        switch ($type) {
            case 'week':
                $result = SimulateService::simulateWeek($simulate_week);
                break;
            case 'all':
                $result = SimulateService::simulateSeason($simulate_week);
                break;
            default:
                $result = false;
                break;
        }
        
        return response()->json([
            'success' => $result
        ]);
    }

    /**
     * Api call /simulate/flush - runs simulate all matches.
     *
     * @return string JSON
     */
    public function flush()
    {
        $result = SimulateService::flushSimulatedData();
        return response()->json([
            'success' => $result
        ]);
    }
}
