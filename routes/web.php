<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentManage;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('homepage');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, "login"])->name('login');
    Route::post('/login', [AuthController::class, "loginPost"])->name('loginPost');
});


// Admin Routes
Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    // Profile 
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/store-profile', [AdminController::class, 'storeProfile'])->name('admin.storeProfile');
    // Change Password
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    // Students
    Route::resource('students', StudentManage::class);
    // Teachers
    Route::resource('teachers', TeacherController::class);
});


// Student Rotues
Route::prefix('/student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('student.logout');
});


Route::fallback(function () {
    return view('errors.404');
});
