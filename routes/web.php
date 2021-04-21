<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductController as ShopProductController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('homeAdmin');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cartInc', [CartController::class, 'cartInc'])->name('cartInc');
Route::post('/cartDec', [CartController::class, 'cartDec'])->name('cartDec');
Route::get('/{category_slug}/', [ShopProductController::class, 'showCategory'])->name('showCategory');
Route::get('/{category_slug}/{product_slug}', [ShopProductController::class, 'showProduct'])->name('showProduct');




