<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;

Route::prefix('password')->group(function () {
    Route::get('{type}/forgot', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('{type}/forgot', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

    Route::get('{type}/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('{type}/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});
