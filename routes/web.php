<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
})->name('home');

Route::get('/russian-roulette', function (){
    return view('games.russian-roulette');
})->name('russian.roulette');

Route::post('/make-shoot', [\App\Http\Controllers\AppController::class, 'makeShoot'])->name('check.shoot');

Route::get('/new-game', function (Request $request){
    \Illuminate\Support\Facades\Log::info('Проиграл: ' . $request->player);
    return redirect()->route('russian.roulette');
})->name('new.game');

Route::post('/create-game', [\App\Http\Controllers\AppController::class , 'createGame'])->name('create.game');
