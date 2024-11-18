<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyJobController;
use App\Http\Controllers\FrontController;

Route::get('/',[FrontController::class,'index'])->name('front.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->middleware('can:manage categories')->group(function() {
        Route::resource('categories', CategoryController::class);
    });

    Route::prefix('employer')->name('employer.')->group(function() {
        Route::resource('company', CompanyController::class)->middleware('can:manage company jobs');
        Route::resource('companyJobs', CompanyJobController::class)->middleware('can:manage company jobs');
    });
});

require __DIR__.'/auth.php';
