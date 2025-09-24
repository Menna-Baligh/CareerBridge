<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ApplicationController;



Route::middleware('auth')->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('company', CompanyController::class);
    Route::post('company/{company}/restore', [CompanyController::class, 'restore'])->name('company.restore');
    Route::resource('job-vacancy', JobVacancyController::class);
    Route::post('job-vacancy/{jobVacancy}/restore', [JobVacancyController::class, 'restore'])->name('job-vacancy.restore');
    Route::resource('application', ApplicationController::class);
    Route::resource('category', CategoryController::class);
    Route::post('category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::resource('user', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
