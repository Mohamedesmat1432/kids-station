<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Cart\ShoppingCart;
use App\Livewire\Category\ListCategory;
use App\Livewire\Dashboard\DashboardComponent;
use App\Livewire\Offer\ListOffer;
use App\Livewire\Order\ListOrder;
use App\Livewire\Permission\ListPermission;
use App\Livewire\Product\ListProduct;
use App\Livewire\ProductOrder\ListProductOrder;
use App\Livewire\Role\ListRole;
use App\Livewire\Type\ListType;
use App\Livewire\TypeName\ListTypeName;
use App\Livewire\Unit\ListUnit;
use App\Livewire\User\ListUser;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Route::get('/', [HomeController::class, 'home']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
    Route::get('/users', ListUser::class)->name('users');
    Route::get('/roles', ListRole::class)->name('roles');
    Route::get('/permissions', ListPermission::class)->name('permissions');
    Route::get('/types', ListType::class)->name('types');
    Route::get('/type-names', ListTypeName::class)->name('type-names');
    Route::get('/offers', ListOffer::class)->name('offers');
    Route::get('/orders', ListOrder::class)->name('orders');
    Route::get('/categories', ListCategory::class)->name('categories');
    Route::get('/units', ListUnit::class)->name('units');
    Route::get('/products', ListProduct::class)->name('products');
    Route::get('/shopping-cart', ShoppingCart::class)->name('shopping.cart');
    Route::get('/product-orders', ListProductOrder::class)->name('product.orders');
});
