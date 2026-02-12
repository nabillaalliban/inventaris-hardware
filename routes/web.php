<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\InboundController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\AdminCartController;
use App\Http\Controllers\User\ItemCatalogController;
use App\Http\Controllers\Admin\LoanAdminController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    // Redirect setelah login
    // Route::get('/dashboard', function () {
    //     if (auth()->user()->role === 'admin') {
    //         return redirect()->route('admin.dashboard');
    //     }

    //     return redirect()->route('user.inventaris.index');
    // })->name('dashboard');

    // ================= ADMIN =================
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

              Route::get('/admin/loan-dashboard', [LoanAdminController::class,'dashboard'])->name('admin.loans.dashboard');
  Route::get('/admin/loans', [LoanAdminController::class,'index'])->name('admin.loans.index');

  Route::post('/admin/loans/{id}/approve', [LoanAdminController::class,'approve'])->name('admin.loans.approve');
  Route::post('/admin/loans/{id}/reject', [LoanAdminController::class,'reject'])->name('admin.loans.reject');
  Route::put('/admin/loans/{id}/returned', [LoanAdminController::class,'markReturned'])->name('admin.loans.returned');

   Route::get('/admin/items', [AdminItemController::class,'index'])->name('admin.items.index');

   Route::get('/admin/cart', [AdminCartController::class,'index'])->name('admin.cart.index');
Route::post('/admin/cart/add', [AdminCartController::class,'add'])->name('admin.cart.add');
Route::put('/admin/cart/{id}', [AdminCartController::class,'update'])->name('admin.cart.update');
Route::delete('/admin/cart/{id}', [AdminCartController::class,'remove'])->name('admin.cart.remove');
Route::post('/admin/cart/checkout', [AdminCartController::class,'checkout'])->name('admin.cart.checkout');
    });

    // ================= USER =================
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/inventaris', [InventarisController::class, 'index'])
            ->name('user.inventaris.index');

        Route::get('/user/inventaris/create', [InventarisController::class, 'create'])
            ->name('user.inventaris.create');

        Route::post('/user/inventaris', [InventarisController::class, 'store'])
            ->name('user.inventaris.store');

        Route::get('/user/inventaris/{id}/edit', [InventarisController::class, 'edit'])
            ->name('user.inventaris.edit');

        Route::put('/user/inventaris/{id}', [InventarisController::class, 'update'])
            ->name('user.inventaris.update');

        Route::delete('/user/inventaris/{id}', [InventarisController::class, 'destroy'])
            ->name('user.inventaris.destroy');

        // Categories
        Route::get('/user/categories', [CategoryController::class, 'index'])
            ->name('user.categories.index');

        Route::get('/user/categories/create', [CategoryController::class, 'create'])
            ->name('user.categories.create');

        Route::post('/user/categories', [CategoryController::class, 'store'])
            ->name('user.categories.store');

        Route::get('/user/categories/{id}/edit', [CategoryController::class, 'edit'])
            ->name('user.categories.edit');

        Route::put('/user/categories/{id}', [CategoryController::class, 'update'])
            ->name('user.categories.update');

        Route::delete('/user/categories/{id}', [CategoryController::class, 'destroy'])
            ->name('user.categories.destroy');

        // ===== PEMINJAMAN =====
        Route::get('/user/peminjaman', [PeminjamanController::class, 'index'])->name('user.peminjaman.index');
        Route::get('/user/peminjaman/create', [PeminjamanController::class, 'create'])->name('user.peminjaman.create');
        Route::post('/user/peminjaman', [PeminjamanController::class, 'store'])->name('user.peminjaman.store');

        // ===== PENGEMBALIAN =====
        Route::get('/user/pengembalian', [PeminjamanController::class, 'pengembalianIndex'])->name('user.pengembalian.index');
        Route::get('/user/pengembalian/{id}/proses', [PeminjamanController::class, 'pengembalianForm'])->name('user.pengembalian.form');
        Route::put('/user/pengembalian/{id}', [PeminjamanController::class, 'pengembalian'])->name('user.pengembalian.update');

        Route::get('/user/items', [ItemCatalogController::class,'index'])->name('user.items.index');
        Route::get('/user/items/create', [ItemCatalogController::class,'create'])->name('user.items.create');
        Route::post('/user/items', [ItemCatalogController::class,'store'])->name('user.items.store');

  Route::get('/user/loans', [LoanController::class,'index'])->name('user.loans.index');
  Route::get('/user/loans/stats', [LoanController::class,'stats'])->name('user.loans.stats');

  Route::get('/user/inbounds', [InboundController::class,'index'])->name('user.inbounds.index');
  Route::get('/user/inbounds/create', [InboundController::class,'create'])->name('user.inbounds.create');
  Route::post('/user/inbounds', [InboundController::class,'store'])->name('user.inbounds.store');

        // Export PDF
        Route::get('/inventaris/export-pdf', [InventarisController::class, 'exportPdf'])
            ->name('inventaris.exportPdf');
    });

});

require __DIR__.'/auth.php';
