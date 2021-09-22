<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordSelectMethodController;
use App\Http\Controllers\Auth\OTPController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password-email', [PasswordResetLinkController::class, 'index_email'])
                ->middleware('guest')
                ->name('password.request-email');

Route::post('/forgot-password-email', [PasswordResetLinkController::class, 'store_email'])
                ->middleware('guest')
                ->name('password.email');

// Custom Phone Password Reset View
Route::get('/forgot-password-phone', [PasswordResetLinkController::class, 'index_phone'])
                ->middleware('guest')
                ->name('password.request-phone');

// Custom Phone Password Reset Logic
Route::post('/forgot-password-phone', [PasswordResetLinkController::class, 'store_phone'])
                ->middleware('guest')
                ->name('password.phone');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

// Custom Phone Password Reset View              
Route::get('/reset-password-phone/{user}/{token}', [OTPController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset-phone');

// Custom Phone Password Reset Logic
Route::post('/reset-password-phone', [OTPController::class, 'store'])
                ->middleware('guest')
                ->name('password.update-phone');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

// Password Reset Method (Custom)
Route::middleware('guest')->group( function () {
    // Select Method for Password Reset
    Route::get('password-reset-method', [PasswordSelectMethodController::class, 'index'])->name('select.method-index');
    Route::post('password-reset-method', [PasswordSelectMethodController::class, 'store'])->name('select.method-store');
});
