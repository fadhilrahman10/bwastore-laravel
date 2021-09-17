<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Models\ProductGallery;

// use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/categories/detail/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/detail/{id}', [DetailController::class, 'index'])->name('details');
Route::post('/detail/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [CartController::class, 'success'])->name('success');

Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('carts');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('carts-delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])
        ->name('dashboard-products');
    Route::get('/dashboard/products/add', [DashboardProductController::class, 'create'])
        ->name('dashboard-products-create');
    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])
        ->name('dashboard-products-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])
        ->name('dashboard-products-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])
        ->name('dashboard-products-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-products-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])
        ->name('dashboard-products-gallery-delete');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-detail');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-setting-store');

    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');

    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('gallery', ProductGalleryController::class);
    });


Auth::routes();
