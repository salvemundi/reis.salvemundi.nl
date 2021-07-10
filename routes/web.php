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
//     return view('dashboard');
// });

// Login Azure
Route::get('/', [App\Http\Controllers\AuthController::class, 'signIn']);
Route::get('/callback', [App\Http\Controllers\AuthController::class, 'callback']);
Route::get('/signout', [App\Http\Controllers\AuthController::class, 'signOut']);

//AzureAuth group
Route::middleware(['AzureAuth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/participants', [App\Http\Controllers\ParticipantController::class, 'getAllIntroParticipantsWithInformation']);
    Route::get('/participants/{userId}', [App\Http\Controllers\ParticipantController::class, 'getAllIntroParticipantsWithInformation']);
    Route::post('/participants/{userId}/checkIn', [App\Http\Controllers\ParticipantController::class, 'checkIn']);
    Route::post('/participants/{userId}/checkOut', [App\Http\Controllers\ParticipantController::class, 'checkOut']);
    Route::get('/add', [App\Http\Controllers\ParticipantController::class, 'viewAdd']);
    Route::post('/add/store', [App\Http\Controllers\ParticipantController::class, 'store']);
    Route::get('/test', [App\Http\Controllers\ParticipantController::class, 'indexTestedPeople']);
    Route::get('/bus', [App\Http\Controllers\ParticipantController::class, 'viewAdd']);
});
