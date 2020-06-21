<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/standings', 'StandingsController@index');
Route::get('/matches/last-week', 'MatchResultsController@lastWeek');
Route::get('/matches/season', 'MatchResultsController@season');
Route::post('/matches/update/{matchId}', 'MatchResultsController@updateMatchScore');
Route::get('/prediction', 'PredictionController@index');
Route::post('/simulate/flush', 'SimulateController@flush');
Route::post('/simulate/{type}', 'SimulateController@index');
