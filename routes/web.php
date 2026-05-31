<?php

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
require __DIR__.'/admin.php';
// End of Admin Routes


// Student Rotues
require __DIR__.'/student.php';
// End of Student Routes

Route::fallback(function () {
    return view('errors.404');
});
