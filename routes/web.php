<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Users\UsersCreate;
use App\Http\Livewire\Users\UsersEdit;

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

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/credentials', [ProfileController::class, 'update_credentials'])->name('profile.update-credentials');
    Route::put('profile/password', [ProfileController::class, 'update_password'])->name('profile.update-password');

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);

        // User CRUD
        Route::get('users', UsersIndex::class)->name('users.index');
        Route::get('users/{user}/edit', UsersEdit::class)->name('users.edit');
        Route::get('users/create', UsersCreate::class)->name('users.create');
    });

    
});

require __DIR__.'/auth.php';
