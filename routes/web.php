<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutUsController;

// Livewire Users Components
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Users\UsersEdit;

// Livewire Products Components
use App\Http\Livewire\Products\ProductsIndex;
use App\Http\Livewire\Products\ProductsCustomize;
use App\Http\Livewire\Products\ProductsCustomerList;

// Livewire Fabrics Components
use App\Http\Livewire\Fabrics\FabricsIndex;

// Livewire Categories Components
use App\Http\Livewire\Categories\CategoriesIndex;

// Livewire Shop Component
use App\Http\Livewire\Shop\ShopIndex;
use App\Http\Livewire\Shop\Carts\CartsIndex;

// Livewire Checkout Component
use App\Http\Livewire\Checkout\CheckoutIndex;

// Livewire Orders Component
use App\Http\Livewire\Orders\OrdersIndex;

// Livewire Notifications Component
use App\Http\Livewire\Notifications\NotificationsIndex;

// Livewire Sales Component
use App\Http\Livewire\Sales\SalesIndex;

// For Testing
use App\Http\Controllers\TestController;

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

// Landing Page
Route::view('/', 'welcome');

// Testing Page
Route::get('/test', [TestController::class, 'index']);

// About Us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Auth
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/credentials', [ProfileController::class, 'update_credentials'])->name('profile.update-credentials');
    Route::put('profile/password', [ProfileController::class, 'update_password'])->name('profile.update-password');
    Route::put('profile/address', [ProfileController::class, 'update_address'])->name('profile.update-address');

    // Notifications
    Route::get('notifications', NotificationsIndex::class)->name('notifications.index');
    
    // Admin
    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::view('dashboard', 'dashboard')->name('dashboard');

        // Users Livewire Component
        Route::get('users', UsersIndex::class)->name('users.index');
        Route::get('users/{id}/edit', UsersEdit::class)->name('users.edit');

        // Products Livewire Component
        Route::get('products', ProductsIndex::class)->name('products.index');

        // Fabrics Livewire Component
        Route::get('fabrics', FabricsIndex::class)->name('fabrics.index');

        // Categories Livewire Component
        Route::get('categories', CategoriesIndex::class)->name('categories.index');

        // Orders Livewire Component
        Route::get('orders', OrdersIndex::class)->name('admin-orders.index');
        Route::get('products/customerlist', ProductsCustomerList::class)->name('products.customerlist');

        // Sales Livewire Component
        Route::get('sales', SalesIndex::class)->name('sales.index');
       
    });

    // Users
    Route::middleware('user')->group(function () {
        // Shop Livewire Component
        Route::get('shop', ShopIndex::class)->name('shop.index');
        Route::get('my-carts', CartsIndex::class)->name('carts.index');

        // Checkout Livewire Component
        Route::get('checkout/{ids}', CheckoutIndex::class)->name('checkout.index');

        // Orders Livewire Component
        Route::get('my-orders', OrdersIndex::class)->name('orders.index');
         //2d
        Route::get('products/customize', ProductsCustomize::class)->name('products.customize');
    });
    
});

// For Testing

require __DIR__.'/auth.php';
