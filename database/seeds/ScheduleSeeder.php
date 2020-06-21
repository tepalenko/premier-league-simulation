<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = DB::table('teams')->get()->toArray();
        $team_ids = array_column($test, 'id');
        $first_circle = $this->schedule($team_ids);
        foreach ($first_circle as $match_week => $matches) {
            DB::table('weeks')->insert([
                'date' => Carbon::now()->sub($match_week + 1, 'days'),
                'created_at' => Carbon::now(),
            ]);
            foreach ($matches as $match) {
                DB::table('matches')->insert([
                    'home_team_id' => $match[0],
                    'away_team_id' => $match[1],
                    'week_id' => $match_week + 1
                ]);
            } 
            
        }
        // second circle it the same as first one - except home/away team switch
        foreach ($first_circle as $match_week => $matches) {
            DB::table('weeks')->insert([
                'date' => Carbon::now()->sub(count($first_circle) + $match_week + 1, 'days'),
                'created_at' => Carbon::now(),
            ]);
            foreach ($matches as $match) {
                DB::table('matches')->insert([
                    'home_team_id' => $match[1],
                    'away_team_id' => $match[0],
                    'week_id' => count($first_circle) + $match_week + 1
                ]);
            } 
            
        }
    }
    function schedule( array $teams ){

        if (count($teams)%2 != 0){
            array_push($teams,"free week");
        }
        $away = array_splice($teams,(count($teams)/2));
        $home = $teams;
        for ($i=0; $i < count($home)+count($away)-1; $i++)
        {
            for ($j=0; $j<count($home); $j++)
            {
                $round[$i][$j][]=$home[$j];
                $round[$i][$j][]=$away[$j];
            }
            if(count($home)+count($away)-1 > 2)
            {
                $s = array_splice( $home, 1, 1 );
                $slice = array_shift( $s  );
                array_unshift($away,$slice );
                array_push( $home, array_pop($away ) );
            }
        }
        return $round;
    }
}
