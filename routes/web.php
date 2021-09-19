<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SMSController;
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Users\UsersCreate;
use App\Http\Livewire\Users\UsersEdit;
use App\Http\Controllers\PhoneNumberController;


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

Route::post('/validate-phone-number', [PhoneNumberController::class, 'show'])->name('sms.validator');


// SMS
Route::get('sms', [SMSController::class, 'sms_index'])->name('sms.index');
Route::post('sms', [SMSController::class, 'sms_send'])->name('sms.send');

// Auth
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/credentials', [ProfileController::class, 'update_credentials'])->name('profile.update-credentials');
    Route::put('profile/password', [ProfileController::class, 'update_password'])->name('profile.update-password');

    Route::middleware('admin')->group(function () {
        // Users Livewire Component
        Route::get('users', UsersIndex::class)->name('users.index');
        Route::get('users/create', UsersCreate::class)->name('users.create');
        Route::get('users/{id}/edit', UsersEdit::class)->name('users.edit');
    });

    
});

require __DIR__.'/auth.php';
