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