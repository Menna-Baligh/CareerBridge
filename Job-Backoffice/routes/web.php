<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ApplicationController;


//* shared routes
Route::middleware(['auth','role:admin,company-owner'])->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-vacancy', JobVacancyController::class);
    Route::post('job-vacancy/{jobVacancy}/restore', [JobVacancyController::class, 'restore'])->name('job-vacancy.restore');
    Route::resource('application', ApplicationController::class);
    Route::post('application/{application}/restore', [ApplicationController::class, 'restore'])->name('application.restore');
});
//* company routes
Route::middleware(['auth','role:company-owner'])->group(function () {
    Route::get('my-company',[CompanyController::class,'show'])->name('my-company.show');
    Route::get('my-company/edit',[CompanyController::class, 'edit'])->name('my-company.edit');
    Route::put('my-company',[CompanyController::class, 'update'])->name('my-company.update');
});
//* admin routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::post('category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::resource('user', UserController::class);
    Route::post('user/{user}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::resource('company', CompanyController::class);
    Route::post('company/{company}/restore', [CompanyController::class, 'restore'])->name('company.restore');
});
require __DIR__.'/auth.php';
