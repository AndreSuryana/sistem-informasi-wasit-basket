<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
    return view('welcome');
});

// User Auth Routes
Route::get('/login', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.authenticate');
Route::get('/register', [RegisterController::class, 'index'])
    ->middleware('guest')
    ->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');
Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');