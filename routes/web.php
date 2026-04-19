<?php

use App\Http\Controllers\GardenofPamController;
use App\Http\Controllers\CpeminaController;
use App\Http\Controllers\MinaPaulDataController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

// Root redirect to gardenofpam
Route::get('/', function () {
    return redirect('/gardenofpam');
});

// ─────────────────────────────────────────
// GardenofPam Routes
// ─────────────────────────────────────────
Route::prefix('gardenofpam')->group(function () {
    Route::get('/', [GardenofPamController::class, 'index'])
         ->name('gardenofpam.index');
});

// ─────────────────────────────────────────
// CPEmina Routes
// ─────────────────────────────────────────
Route::prefix('cpemina')->group(function () {
    Route::get('/', [CpeminaController::class, 'index'])
         ->name('cpemina.index');
    Route::get('/{slug}', [CpeminaController::class, 'show'])
         ->name('cpemina.projects.show');
});

// ─────────────────────────────────────────
// MinaPaulData Routes
// ─────────────────────────────────────────
Route::prefix('minapauldata')->group(function () {
    Route::get('/', [MinaPaulDataController::class, 'index'])
         ->name('minapauldata.index');
    Route::get('/resume/view', [ResumeController::class, 'view'])
         ->name('resume.view');
    Route::get('/resume/download', [ResumeController::class, 'download'])
         ->name('resume.download');
});

// ─────────────────────────────────────────
// Message Routes (shared across all niches)
// ─────────────────────────────────────────
Route::prefix('message')->group(function () {
    Route::post('/send-otp',   [MessageController::class, 'sendOtp'])  ->name('message.sendOtp');
    Route::post('/verify-otp', [MessageController::class, 'verifyOtp'])->name('message.verifyOtp');
    Route::post('/resend-otp', [MessageController::class, 'resendOtp'])->name('message.resendOtp');
});
