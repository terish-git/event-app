<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\CommonController;

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

Auth::routes();

// Public routes
Route::get('events', [PublicEventController::class, 'getAllEvents'])->name('public.events');
Route::get('event-reports', [PublicEventController::class, 'eventReport'])->name('public.event.reports');
Route::get('events/fetch_data', [PublicEventController::class, 'fetch_data']);

// Logged user routes
Route::prefix('home/')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('events', EventController::class);
        Route::resource('invitations', InvitationController::class);
    });
});

Route::post('common/is-unique-email', [CommonController::class, 'checkUniqueEmail']);

Route::get('/', function () {
    return view('welcome');
});


