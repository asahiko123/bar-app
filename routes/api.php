<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\FavoriteController;


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

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/register',[RegisterController::class, 'register'])->name('register');
Route::get('/cards/index',[CardsController::class, 'index'])->name('cards.index');
Route::get('/user',fn() => Auth::user())->name('user');
Route::get('/phpinfo',fn() => phpinfo());


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/cards',[CardsController::class, 'create'])->name('cards.create');
    Route::put('cards/{id}/like',[FavoriteController::class,'like'])->name('cards.like');
    Route::delete('cards/{id}/unlike',[FavoriteController::class,'unlike'])->name('cards.unlike');

});

