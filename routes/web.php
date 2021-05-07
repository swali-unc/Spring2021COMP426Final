<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/login', 'LoginController@LoginPage');
Route::get('/logout', 'LoginController@LogoutPage');
Route::get('/register', 'LoginController@RegisterPage');
Route::post('/register', 'LoginController@CreateUser');
Route::post('/login', 'LoginController@AttemptLogin');

Route::get('/play', 'PlayController@Home');
Route::get('/play/create/{fightid}', 'PlayController@CreateFight');

Route::get('/play/move/{mvindex}', 'PlayController@Move');
Route::get('/play/status', 'PlayController@Status');
Route::get('/play/finish', 'PlayController@FinishGame');

Route::get('/myscore', 'ScoreController@MyScores');
Route::get('/score', 'ScoreController@HighScores');
Route::get('/score/user/{userid}', 'ScoreController@UserScores');
Route::get('/score/fight/{fightid}', 'ScoreController@FightScores');

Route::get('/search/suggest', 'SearchController@SearchHints');
Route::post('/search','SearchController@SearchResults');