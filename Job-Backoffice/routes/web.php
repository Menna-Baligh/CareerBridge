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
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/application',[ApplicationController::class, 'index'])->name('application.index');
    Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
    Route::get('/job-vacany', [JobVacancyController::class, 'index'])->name('job-vacancy.index');
    Route::get('/user',[UserController::class, 'index'])->name('user.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
