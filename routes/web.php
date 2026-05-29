<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\LabReportController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\NotificationController as AdminNotification;
use App\Http\Controllers\Admin\PollController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\ResourceFileController;
use App\Http\Controllers\Admin\ResultController;
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

    // Links
    Route::resource('links', LinkController::class);

    // Exams
    Route::resource('exams', ExamController::class);

    // Bulk Create
    Route::get('/bulk-create/results', [ResultController::class, 'bulkCreate'])
        ->name('results.bulk.create');

    // Bulk Store
    Route::post('/bulk-store/results', [ResultController::class, 'bulkStore'])
        ->name('results.bulk.store');

    // Resource Route
    Route::resource('results', ResultController::class);

    // Feedback
    Route::resource('feedbacks', FeedbackController::class);

    // Attendance
    Route::resource('attendances', AttendanceController::class);

    // Delete Full Attendance Session
    Route::delete('attendances/delete-session/{subject}/{date}', [AttendanceController::class, 'deleteSession'])->name('attendances.delete-session');


    // Notifications
    Route::get('/notifications', [AdminNotification::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{id}/read', [AdminNotification::class, 'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [AdminNotification::class, 'markAllAsRead'])
        ->name('notifications.read.all');

    Route::delete('/notifications/{id}', [AdminNotification::class, 'destroy'])
    ->name('notifications.destroy');

    Route::delete('/notification/delete-all', [AdminNotification::class, 'deleteAll'])
    ->name('notifications.delete-all');

    Route::get('read-and-redirect/{notificationid}/{route}', [AdminNotification::class, 'readAndRedirect'])
        ->name('admin.readAndRedirect');
}); // End of Admin Routes


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


// Student Rotues
Route::prefix('/student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('student.logout');

    // Classmate
    Route::get('/classmates', [StudentController::class, 'classmate'])->name('student.classmates');
    // Classmate
    Route::get('/attendances', [StudentController::class, 'attendances'])->name('student.attendances');
    Route::get('/attendances/{id}', [StudentController::class, 'showattendance'])->name('student.attendance.show');

    // teacher
    Route::get('/teachers', [StudentController::class, 'teachers'])->name('student.teachers');
    // subject
    Route::get('/subjects', [StudentController::class, 'subjects'])->name('student.subjects');
    // Poll
    Route::get('/polls', [StudentController::class, 'polls'])->name('student.polls');
    Route::post('/polls/{poll}/vote', [StudentController::class, 'vote'])
        ->name('student.poll.vote');

    // feedback
    Route::get('/feedback', [StudentController::class, 'feedback'])
        ->name('student.feedback');

    Route::post('/feedback/store', [StudentController::class, 'feedbackStore'])
        ->name('student.feedback.store');


    // routine
    Route::get('/routine', [StudentController::class, 'routine'])
        ->name('student.routine');


    // resource
    Route::get('/resources', [StudentController::class, 'resources'])
        ->name('student.resources');

    Route::get('/resources/{resource}', [StudentController::class, 'resourceShow'])
        ->name('student.resources.show');

    Route::get('/resources/download/{file}', [StudentController::class, 'downloadResource'])
        ->name('student.resources.download');

    // Links
    Route::get('/links', [StudentController::class, 'links'])
        ->name('student.links');
    // Result
    Route::get('/results', [StudentController::class, 'results'])
        ->name('student.results');

    // Assignment
    Route::get('assignments', [StudentController::class, 'assignments'])
        ->name('student.assignment');

    Route::get('assignments/{assignment}', [StudentController::class, 'assignmentshow'])
        ->name('student.assignment.show');


    // Lab Reports

    Route::get('lab-reports', [StudentController::class, 'labReports'])->name('student.lab-report');
    Route::get('lab-reports/{labReport}', [StudentController::class, 'labreportShow'])->name('student.lab-report.show');


    // Notice
    Route::get('notices', [StudentController::class, 'notices'])->name('student.notice');
    Route::get('notices/{notice}', [StudentController::class, 'noticeshow'])->name('student.notice.show');


    Route::get('/profile', [StudentController::class, 'profile'])
        ->name('student.profile');

    Route::put('/profile/update', [StudentController::class, 'updateProfile'])
        ->name('student.profile.update');

    // Password
    Route::get('/change-password', [StudentController::class, 'changePassword'])->name('student.change.password');
    Route::put('/change-password/update', [StudentController::class, 'updatePassword'])->name('student.change.password.update');

    // Notifications

    // Notifications page
    Route::get('notifications', [StudentController::class, 'notifications'])
        ->name('student.notifications');

    Route::get('read-and-redirect/{notificationid}/{route}', [StudentController::class, 'readAndRedirect'])
        ->name('student.readAndRedirect');

    // Mark single notification as read
    Route::post('notifications/{id}/mark-as-read', [StudentController::class, 'markNotificationRead'])
        ->name('student.notifications.markAsRead');


    // Mark all notifications as read
    Route::post('notifications/mark-all-as-read', [StudentController::class, 'markAllNotificationsRead'])
        ->name('student.notifications.markAllAsRead');


    // Delete single notification
    Route::delete('notifications/{id}/delete', [StudentController::class, 'deleteNotification'])
        ->name('student.notifications.delete');


    // Delete all notifications
    Route::delete('notifications/delete-all', [StudentController::class, 'deleteAllNotifications'])
        ->name('student.notifications.deleteAll');
}); // End of Student Routes

Route::fallback(function () {
    return view('errors.404');
});

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\NotificationController;
