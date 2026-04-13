<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventarisController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\InboundController;
use App\Http\Controllers\Admin\LoanAdminController;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\ItemCatalogController;

/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'));

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.items.index');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware(['role:admin'])
        ->name('admin.')
        ->group(function () {

        Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

        // PDF
        Route::get('/inventaris/export-pdf', [InventarisController::class, 'exportPdf'])
            ->name('inventaris.exportPdf');

        // INVENTARIS & CATEGORY
        Route::resource('inventaris', InventarisController::class);
        Route::resource('categories', CategoryController::class);

        // ITEMS
        Route::resource('items', AdminItemController::class);
        Route::delete('/admin/items/{id}', [AdminItemController::class, 'destroy'])
    ->name('admin.items.destroy');

        // INBOUND
        Route::get('/inbounds', [InboundController::class,'index'])->name('inbounds.index');
        Route::get('/inbounds/create', [InboundController::class,'create'])->name('inbounds.create');
        Route::post('/inbounds', [InboundController::class,'store'])->name('inbounds.store');

        // LOANS ADMIN
        Route::get('/loans', [LoanAdminController::class,'index'])->name('loans.index');
        Route::get('/loan-dashboard', [LoanAdminController::class,'dashboard'])->name('loans.dashboard');

        Route::post('/loans/{id}/approve', [LoanAdminController::class,'approve'])->name('loans.approve');
        Route::post('/loans/{id}/reject', [LoanAdminController::class,'reject'])->name('loans.reject');
        Route::put('/loans/{id}/returned', [LoanAdminController::class,'markReturned'])->name('loans.returned');
    });


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')
        ->middleware(['role:user'])
        ->name('user.')
        ->group(function () {

        // ITEMS
        Route::resource('items', ItemCatalogController::class);

        // CART
        Route::get('/cart', [CartController::class,'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
        Route::put('/cart/{id}', [CartController::class,'update'])->name('cart.update');
        Route::delete('/cart/{id}', [CartController::class,'remove'])->name('cart.remove');
        Route::post('/cart/checkout', [CartController::class,'checkout'])->name('cart.checkout');

        // LOANS USER
        Route::get('/loans', [LoanController::class,'index'])->name('loans.index');
        Route::get('/loans/stats', [LoanController::class,'stats'])->name('loans.stats');
    });

});
