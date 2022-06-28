<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout'])->name('login');
Route::post('/register',[RegisterController::class, 'register'])->name('register');
Route::get('/user',fn() => Auth::user())->name('user');

// Route::group(['middleware' => ['auth:sanctum']],function(){

//     Route::get('/',function(){
//         return response()->json([
//             'message' => 'ログイン完了',
//         ],200);
//     });
// });
