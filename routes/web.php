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
Route::get('profile/data', [ProfileController::class, 'index'])
    ->name('profile.index');
Route::put('profile/data', [ProfileController::class, 'update'])
    ->name('profile.update');
Route::post('profile', [ProfileController::class, 'uploadPhoto'])
    ->name('profile.photo');

// User Routes
Route::resource('users', UserController::class)
    ->scoped(['user' => 'email']);

// Referee Routes
Route::get('referee/data', [RefereeController::class, 'index'])
    ->name('referee.index');
Route::post('referee', [RefereeController::class, 'update'])
    ->name('referee.update');

// Referee Event Routes
Route::get('referee/event/data', [RefereeController::class, 'showFormEvent'])
    ->name('referee.event.index');
Route::post('referee/event/store', [RefereeController::class, 'storeEvent'])
    ->name('referee.event.store');
Route::post('referee/event/{id}/update', [RefereeController::class, 'updateEvent'])
    ->name('referee.event.update');
Route::post('referee/event/{id}/delete', [RefereeController::class, 'deleteEvent'])
    ->name('referee.event.delete');

// Referee Event Games Routes
Route::post('referee/event/{eventId}/game/store', [RefereeController::class, 'storeGame'])
    ->name('referee.event.game.store');
Route::post('referee/event/game/{id}/update', [RefereeController::class, 'updateGame'])
    ->name('referee.event.game.update');
Route::post('referee/event/game/{id}/delete', [RefereeController::class, 'deleteGame'])
    ->name('referee.event.game.delete');

// Referee Licence Routes
Route::get('referee/licence/data', [RefereeController::class, 'showFormLicence'])
    ->name('referee.licence.index');
Route::post('referee/licence/store', [RefereeController::class, 'storeLicence'])
    ->name('referee.licence.store');
Route::post('referee/licence/{id}/update', [RefereeController::class, 'updateLicence'])
    ->name('referee.licence.update');
Route::post('referee/licence/{id}/delete', [RefereeController::class, 'deleteLicence'])
    ->name('referee.license.delete');