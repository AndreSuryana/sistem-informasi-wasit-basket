<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Home Routes
Route::get('/', [HomeController::class, 'index'])
    ->name('root');

// User Auth Routes
Route::get('login', [LoginController::class, 'index'])
    ->name('login');
Route::post('login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');
Route::get('register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('register', [RegisterController::class, 'store'])
    ->name('register.store');
Route::post('logout', [DashboardController::class, 'logout'])
    ->name('logout');

// Dashboard Routes
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Profile Routes
Route::get('profile', [ProfileController::class, 'index'])
    ->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])
    ->name('profile.update');
Route::post('profile', [ProfileController::class, 'uploadPhoto'])
    ->name('profile.photo');

// User Routes
Route::resource('users', UserController::class)
    ->scoped(['user' => 'email']);

// Referee Routes
Route::resource('referee', RefereeController::class);
Route::resource('referee.event', RefereeController::class);