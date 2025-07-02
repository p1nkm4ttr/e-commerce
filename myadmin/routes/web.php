<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Authentication Routes (in web middleware group)
Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Protected Routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name("dashboard");
        Route::get('/invoices', [\App\Http\Controllers\Invoices::class, 'index'])->name("invoices");
        Route::get('/forms', [\App\Http\Controllers\Forms::class, 'index'])->name("forms");
        Route::post('/forms/save', [\App\Http\Controllers\Forms::class, 'save'])->name("form_save");
        Route::get('/imageform', [\App\Http\Controllers\ImageForms::class, 'index'])->name('imageform');
        Route::post('/imageform/save', [\App\Http\Controllers\ImageForms::class, 'save'])->name('imageform_save');
        Route::get('/pos', \App\Livewire\Pos\CreatePos::class)->name("pos");
        Route::get('/report',\App\Livewire\Report::class)->name("report");

        // Admin-only routes
        Route::middleware(['admin.only'])->group(function () {
            Route::get('/orders', \App\Livewire\OrderComponent::class)->name('orders');
            Route::get('/admin-users', \App\Livewire\AdminUserManagement::class)->name('admin-users');
            Route::get('/shipping', \App\Livewire\ShippingManagement::class)->name('shipping');
        });

        // Role-specific routes
        Route::get('/my-orders', \App\Livewire\PickerOrdersComponent::class)->name('picker.orders');
        Route::get('/my-packing', \App\Livewire\PackerOrdersComponent::class)->name('packer.orders');
    });
});