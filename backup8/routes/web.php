<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TVController;
use App\Http\Controllers\ActorsController;

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

Route::get('/',[MoviesController::class,'index'])->name('movie.index');
Route::get('/movies/{id}',[MoviesController::class,'show'])->name('movie.show');

Route::get('/tv',[TVController::class,'index'])->name('tv.index');
Route::get('/tv/{id}',[TVController::class,'show'])->name('tv.show');

Route::get('/actors/page/{page?}',[ActorsController::class,'index']);
Route::get('/actors',[ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/{id}',[ActorsController::class,'show'])->name('actors.show');