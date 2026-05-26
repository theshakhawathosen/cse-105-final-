<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\LabReportController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PollController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\ResourceFileController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\StudentManage;
use App\Http\Controllers\Admin\SubjectController;
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

    // Notice
    Route::resource('notices', NoticeController::class);
    // toggle publish
    Route::patch('/notices/{notice}/toggle-publish', [NoticeController::class, 'togglePublish'])
        ->name('notices.togglePublish');
    // toggle scrolling
    Route::patch('/notices/{notice}/toggle-scrolling', [NoticeController::class, 'toggleScrolling'])
        ->name('notices.toggleScrolling');

    // Subject
    Route::resource('subjects', SubjectController::class);

    // Routine
    Route::resource('routines', RoutineController::class);

    // Resource
    Route::resource('resources', ResourceController::class);

    // Resource Files Delete
    Route::get(
        'resource-files/{id}',
        [ResourceFileController::class, 'destroy']
    )->name('resource-files.destroy');

    // Assignment
    Route::resource('assignments', AssignmentController::class);


    // Lab Reports
    Route::resource('lab-reports', LabReportController::class);


    // Polls
    Route::resource('polls', PollController::class);

    // Student Vote
    Route::post('polls/{poll}/vote', [PollController::class, 'vote'])
        ->name('polls.vote');





    // Feedback
    Route::resource('feedbacks', FeedbackController::class);

    // Attendance
    Route::resource('attendances', AttendanceController::class);

    // Delete Full Attendance Session
    Route::delete('attendances/delete-session/{subject}/{date}', [AttendanceController::class, 'deleteSession'])->name('attendances.delete-session');
});





// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



// Student Rotues
Route::prefix('/student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('student.logout');

    // Classmate
    Route::get('/classmates', [StudentController::class, 'classmate'])->name('student.classmate');
    // Classmate
    Route::get('/attendances', [StudentController::class, 'attendances'])->name('student.attendances');
    Route::get('/attendances/{id}', [StudentController::class, 'showattendance'])->name('student.attendance.show');
    });


Route::fallback(function () {
    return view('errors.404');
});
