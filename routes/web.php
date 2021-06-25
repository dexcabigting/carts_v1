<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->prefix($prefix)->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/credentials', [ProfileController::class, 'update_credentials'])->name('profile.update-credentials');
    Route::put('profile/password', [ProfileController::class, 'update_password'])->name('profile.update-password');

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class, [
            'only' => ['index', 'create', 'edit']
        ]);
    });

    
});

require __DIR__.'/auth.php';
