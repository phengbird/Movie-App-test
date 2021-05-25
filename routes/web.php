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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','MoviesController@index')->name('movie.index');
Route::get('/movies/{movie}','MoviesController@show')->name('movie.show');

Route::get('/actors/page/{page?}','ActorsController@index');
Route::get('/actors','ActorsController@index')->name('actors.index');
Route::get('/actors/{actors}','ActorsController@show')->name('actors.show');