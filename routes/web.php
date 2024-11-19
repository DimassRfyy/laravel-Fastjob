<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyJobController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobCandidateController;

Route::get('/',[FrontController::class,'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/details/{companyJob:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/apply/{companyJob:slug}', [FrontController::class, 'apply'])->name('front.apply');
    Route::post('/apply/store/{companyJob:id}', [FrontController::class, 'store_apply'])->name('front.store_apply');

    Route::prefix('admin')->name('admin.')->middleware('can:manage categories')->group(function() {
        Route::resource('categories', CategoryController::class);
    });

    Route::prefix('employer')->name('employer.')->group(function() {
        Route::resource('company', CompanyController::class)->middleware('can:manage company jobs');
        Route::resource('companyJobs', CompanyJobController::class)->middleware('can:manage company jobs');
    });

    Route::prefix('employee')->name('employee.')->group(function() {
        Route::resource('applications', JobCandidateController::class)->middleware('can:manage job applications');
    });
});

require __DIR__.'/auth.php';
