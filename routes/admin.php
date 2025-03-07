<?php

use App\Http\Controllers\AdminStaffController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Staff Routes
    Route::resource('staffs', AdminStaffController::class);
});