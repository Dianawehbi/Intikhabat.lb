<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ElectoralDistrictController;
use App\Http\Controllers\IdScanController;
use App\Http\Controllers\ListModelController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\VoteController;
use App\Models\Candidate;
use App\Models\ElectoralDistrict;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/votes', Vote::class);

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin can manage data, but listing/showing is public or user-limited
    //** i should add 2 factor auhtnetication when he want to log in */
    Route::resource('/candidates', CandidateController::class)->except(['index', 'show']);
    Route::resource('/elections', ElectionController::class)->except(['index', 'show']);
    Route::resource('/electoral_districts', ElectoralDistrictController::class)->except(['index', 'show']);
    Route::resource('/id_scans', IdScanController::class)->except(['index', 'show']);
    Route::resource('/list', ListModelController::class)->except(['index', 'show']);
    Route::resource('/parties', PartyController::class)->except(['index', 'show']);
    Route::resource('/votes', VoteController::class)->except(['index', 'show']);
});

Route::middleware(['auth'])->group(function () {
    //only regiter user can vote , and check their card id 
    Route::resource('/id_scans', IdScanController::class)->only(['index', 'show']);
    Route::resource('/votes', VoteController::class)->only(['index', 'show']);
});

// anyone can see them either he is not registered or loged in
Route::resource('/candidates', CandidateController::class)->only(['index', 'show']);
Route::resource('/elections', ElectionController::class)->only(['index', 'show']);
Route::resource('/electoral_districts', ElectoralDistrictController::class)->only(['index', 'show']);
Route::resource('/list', ListModelController::class)->only(['index', 'show']);
Route::resource('/parties', PartyController::class)->only(['index', 'show']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
