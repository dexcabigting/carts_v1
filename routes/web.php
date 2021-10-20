<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Livewire Users Components
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Users\UsersCreate;
use App\Http\Livewire\Users\UsersEdit;

// Livewire Products Components
use App\Http\Livewire\Products\ProductsIndex;

// Livewire Shop Component
use App\Http\Livewire\Shop\ShopIndex;
use App\Http\Livewire\Shop\Carts\CartsIndex;

// Livewire Checkout Component
use App\Http\Livewire\Checkout\CheckoutIndex;

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

Route::view('3d', 'three-js');

// Auth
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/credentials', [ProfileController::class, 'update_credentials'])->name('profile.update-credentials');
    Route::put('profile/password', [ProfileController::class, 'update_password'])->name('profile.update-password');
    Route::put('profile/address', [ProfileController::class, 'update_address'])->name('profile.update-address');

    // Admin
    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::view('dashboard', 'dashboard')->name('dashboard');

        // Users Livewire Component
        Route::get('users', UsersIndex::class)->name('users.index');
        Route::get('users/create', UsersCreate::class)->name('users.create');
        Route::get('users/{id}/edit', UsersEdit::class)->name('users.edit');

        // Products Livewire Component
        Route::get('products', ProductsIndex::class)->name('products.index');
    });

    // Users
    Route::middleware('user')->group(function () {
        // Shop Livewire Component
        Route::get('shop', ShopIndex::class)->name('shop.index');
        Route::get('carts', CartsIndex::class)->name('carts.index');

        // Checkout Livewire Component
        Route::get('checkout/{ids}', CheckoutIndex::class)->name('checkout.index');
    });
    
});

// For Testing

require __DIR__.'/auth.php';
