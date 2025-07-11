<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ElectoralDistrictController;
use App\Http\Controllers\ElectoralDistrictSeatController;
use App\Http\Controllers\IdScanController;
use App\Http\Controllers\ListModelController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES (anyone can access)
Route::resource('/candidates', CandidateController::class)->only(['index', 'show']);
Route::resource('/elections', ElectionController::class)->only(['index', 'show']);
Route::resource('/electoral_districts', ElectoralDistrictController::class)->only(['index', 'show']);
Route::resource('/electoral_district_seats', ElectoralDistrictSeatController::class)->only(['index', 'show']);
Route::resource('/lists', ListModelController::class)->only(['index', 'show']);
Route::resource('/parties', PartyController::class)->only(['index', 'show']);
Route::get('/', [MainController::class, 'index'])->name('dashboard');

// AUTHENTICATED USERS (can vote, view their ID scans - no verification required)
Route::middleware(['auth'])->group(function () {
    Route::resource('/id_scans', IdScanController::class)->only(['index', 'show']);
    Route::resource('/votes', VoteController::class)->only(['index', 'show']);
});

// ADMINS ONLY (must be authenticated + verified)
Route::middleware([
    'auth',
    'verified',  //  email verification only for admins
    config('jetstream.auth_session'), // Applies Jetstream's session authentication middleware (like auto-logout on new device)
    'admin',     //  your custom middleware that checks user is admin
])->group(function () {
    Route::resource('/candidates', CandidateController::class)->except(['index', 'show']);
    Route::resource('/elections', ElectionController::class)->except(['index', 'show']);
    Route::resource('/electoral_districts', ElectoralDistrictController::class)->except(['index', 'show']);
    Route::resource('/electoral_district_seats', ElectoralDistrictSeatController::class)->except(['index', 'show']);
    Route::resource('/id_scans', IdScanController::class)->except(['index', 'show']);
    Route::resource('/lists', ListModelController::class)->except(['index', 'show']);
    Route::resource('/parties', PartyController::class)->except(['index', 'show']);
    Route::resource('/votes', VoteController::class)->except(['index', 'show']);
});
