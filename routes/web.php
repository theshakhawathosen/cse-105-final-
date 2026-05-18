<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('homepage');
Route::get('/login', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "loginPost"])->name('loginPost');


// Admin Routes

Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// Student Rotues
Route::prefix('/student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
});
