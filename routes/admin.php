<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\LabReportController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\NotificationController as AdminNotification;
use App\Http\Controllers\Admin\OnlineClassController;
use App\Http\Controllers\Admin\OnlineUserTrackController;
use App\Http\Controllers\Admin\PollController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\ResourceFileController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\StudentManage;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard, Profile & Password
        |--------------------------------------------------------------------------
        */
        Route::controller(AdminController::class)->group(function () {

            Route::get('/', 'dashboard')
                ->name('admin.dashboard');

            Route::get('/profile', 'profile')
                ->name('admin.profile');

            Route::post('/store-profile', 'storeProfile')
                ->name('admin.storeProfile');

            Route::get('/change-password', 'changePassword')
                ->name('admin.change-password');

            Route::post('/change-password', 'updatePassword')
                ->name('admin.updatePassword');
        });

        Route::get('/queue/pending-jobs', [AdminController::class, 'pendingJobs'])
            ->name('admin.queue.pending');

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */
        Route::get('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');

        /*
        |--------------------------------------------------------------------------
        | User Management
        |--------------------------------------------------------------------------
        */
        Route::resource('students', StudentManage::class);
        Route::resource('teachers', TeacherController::class);

        /*
        |--------------------------------------------------------------------------
        | Academic Management
        |--------------------------------------------------------------------------
        */
        Route::resource('subjects', SubjectController::class);
        Route::resource('routines', RoutineController::class);
        Route::resource('lessons', LessonController::class);

        /*
        |--------------------------------------------------------------------------
        | Notice Management
        |--------------------------------------------------------------------------
        */
        Route::resource('notices', NoticeController::class);

        Route::controller(NoticeController::class)->group(function () {

            Route::patch('/notices/{notice}/toggle-publish', 'togglePublish')
                ->name('notices.togglePublish');

            Route::patch('/notices/{notice}/toggle-scrolling', 'toggleScrolling')
                ->name('notices.toggleScrolling');
        });

        /*
        |--------------------------------------------------------------------------
        | Online Classes
        |--------------------------------------------------------------------------
        */
        Route::resource('online-classes', OnlineClassController::class);

        Route::controller(OnlineUserTrackController::class)->group(function () {

            Route::get('/online-users', 'index')
                ->name('admin.online-students');
        });

        /*
        |--------------------------------------------------------------------------
        | Learning Resources
        |--------------------------------------------------------------------------
        */
        Route::resource('resources', ResourceController::class);

        Route::controller(ResourceFileController::class)->group(function () {

            Route::get('resource-files/{id}', 'destroy')
                ->name('resource-files.destroy');
        });

        Route::resource('links', LinkController::class);

        /*
        |--------------------------------------------------------------------------
        | Assignments & Lab Reports
        |--------------------------------------------------------------------------
        */
        Route::resource('assignments', AssignmentController::class);
        Route::resource('lab-reports', LabReportController::class);

        /*
        |--------------------------------------------------------------------------
        | Polls & Voting
        |--------------------------------------------------------------------------
        */
        Route::resource('polls', PollController::class);

        Route::controller(PollController::class)->group(function () {

            Route::post('polls/{poll}/vote', 'vote')
                ->name('polls.vote');
        });

        /*
        |--------------------------------------------------------------------------
        | Examination Management
        |--------------------------------------------------------------------------
        */
        Route::resource('exams', ExamController::class);
        Route::resource('results', ResultController::class);

        Route::controller(ResultController::class)->group(function () {

            Route::get('/bulk-create/results', 'bulkCreate')
                ->name('results.bulk.create');

            Route::post('/bulk-store/results', 'bulkStore')
                ->name('results.bulk.store');
        });

        /*
        |--------------------------------------------------------------------------
        | Attendance Management
        |--------------------------------------------------------------------------
        */
        Route::resource('attendances', AttendanceController::class);

        Route::controller(AttendanceController::class)->group(function () {

            Route::delete(
                'attendances/delete-session/{subject}/{date}',
                'deleteSession'
            )->name('attendances.delete-session');
        });

        /*
        |--------------------------------------------------------------------------
        | Feedback Management
        |--------------------------------------------------------------------------
        */
        Route::resource('feedbacks', FeedbackController::class);

        /*
        |--------------------------------------------------------------------------
        | Notification Management
        |--------------------------------------------------------------------------
        */
        Route::controller(AdminNotification::class)->group(function () {

            Route::get('/notifications', 'index')
                ->name('notifications.index');

            Route::patch('/notifications/{id}/read', 'markAsRead')
                ->name('notifications.read');

            Route::patch('/notifications/read-all', 'markAllAsRead')
                ->name('notifications.read.all');

            Route::delete('/notifications/{id}', 'destroy')
                ->name('notifications.destroy');

            Route::delete('/notification/delete-all', 'deleteAll')
                ->name('notifications.delete-all');

            Route::get(
                '/read-and-redirect/{notificationid}/{route}',
                'readAndRedirect'
            )->name('admin.readAndRedirect');
        });

        /*
        |--------------------------------------------------------------------------
        | Mail Management
        |--------------------------------------------------------------------------
        */
        Route::controller(MailController::class)->prefix('/mail')->group(function () {
            Route::get('/mail-settings','index')->name('admin.mail-settings');

            Route::get('/invite-all','inviteAll')->name('admin.invite-all');
            Route::delete('/delete-job/{id}','deleteJob')->name('admin.delete.job');
            Route::post('/reset-student-password','resetPassword')->name('admin.reset.student-password');

        });
    });

/*
|--------------------------------------------------------------------------
| End of Admin Routes
|--------------------------------------------------------------------------
*/
