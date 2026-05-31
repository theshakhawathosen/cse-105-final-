<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::prefix('student')
    ->middleware(['auth', 'role:student'])
    ->controller(StudentController::class)
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */
        Route::get('/', 'dashboard')
            ->name('student.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Profile Management
        |--------------------------------------------------------------------------
        */
        Route::get('/profile', 'profile')
            ->name('student.profile');

        Route::put('/profile/update', 'updateProfile')
            ->name('student.profile.update');


        /*
        |--------------------------------------------------------------------------
        | Password Management
        |--------------------------------------------------------------------------
        */
        Route::get('/change-password', 'changePassword')
            ->name('student.change.password');

        Route::put('/change-password/update', 'updatePassword')
            ->name('student.change.password.update');


        /*
        |--------------------------------------------------------------------------
        | Academic Information
        |--------------------------------------------------------------------------
        */
        Route::get('/subjects', 'subjects')
            ->name('student.subjects');

        Route::get('/teachers', 'teachers')
            ->name('student.teachers');

        Route::get('/classmates', 'classmate')
            ->name('student.classmates');

        Route::get('/routine', 'routine')
            ->name('student.routine');

        Route::get('/calendar', 'calendar')
            ->name('student.calendar');


        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */
        Route::get('/attendances', 'attendances')
            ->name('student.attendances');

        Route::get('/attendances/{id}', 'showattendance')
            ->name('student.attendance.show');


        /*
        |--------------------------------------------------------------------------
        | Results
        |--------------------------------------------------------------------------
        */
        Route::get('/results', 'results')
            ->name('student.results');


        /*
        |--------------------------------------------------------------------------
        | Resources
        |--------------------------------------------------------------------------
        */
        Route::get('/resources', 'resources')
            ->name('student.resources');

        Route::get('/resources/{resource}', 'resourceShow')
            ->name('student.resources.show');

        Route::get('/resources/download/{file}', 'downloadResource')
            ->name('student.resources.download');


        /*
        |--------------------------------------------------------------------------
        | Useful Links
        |--------------------------------------------------------------------------
        */
        Route::get('/links', 'links')
            ->name('student.links');


        /*
        |--------------------------------------------------------------------------
        | Assignments
        |--------------------------------------------------------------------------
        */
        Route::get('/assignments', 'assignments')
            ->name('student.assignment');

        Route::get('/assignments/{assignment}', 'assignmentshow')
            ->name('student.assignment.show');


        /*
        |--------------------------------------------------------------------------
        | Lab Reports
        |--------------------------------------------------------------------------
        */
        Route::get('/lab-reports', 'labReports')
            ->name('student.lab-report');

        Route::get('/lab-reports/{labReport}', 'labreportShow')
            ->name('student.lab-report.show');


        /*
        |--------------------------------------------------------------------------
        | Notices
        |--------------------------------------------------------------------------
        */
        Route::get('/notices', 'notices')
            ->name('student.notice');

        Route::get('/notices/{notice}', 'noticeshow')
            ->name('student.notice.show');


        /*
        |--------------------------------------------------------------------------
        | Polls & Voting
        |--------------------------------------------------------------------------
        */
        Route::get('/polls', 'polls')
            ->name('student.polls');

        Route::post('/polls/{poll}/vote', 'vote')
            ->name('student.poll.vote');


        /*
        |--------------------------------------------------------------------------
        | Feedback
        |--------------------------------------------------------------------------
        */
        Route::get('/feedback', 'feedback')
            ->name('student.feedback');

        Route::post('/feedback/store', 'feedbackStore')
            ->name('student.feedback.store');


        /*
        |--------------------------------------------------------------------------
        | Online Classes
        |--------------------------------------------------------------------------
        */
        Route::get('/online-classes', 'onlineClasses')
            ->name('student.online-class.index');

        Route::get('/online-classes/join/{id}', 'joinClass')
            ->name('student.online-class.join');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */
        Route::get('/notifications', 'notifications')
            ->name('student.notifications');

        Route::get('/read-and-redirect/{notificationid}/{route}', 'readAndRedirect')
            ->name('student.readAndRedirect');

        Route::post('/notifications/{id}/mark-as-read', 'markNotificationRead')
            ->name('student.notifications.markAsRead');

        Route::post('/notifications/mark-all-as-read', 'markAllNotificationsRead')
            ->name('student.notifications.markAllAsRead');

        Route::delete('/notifications/{id}/delete', 'deleteNotification')
            ->name('student.notifications.delete');

        Route::delete('/notifications/delete-all', 'deleteAllNotifications')
            ->name('student.notifications.deleteAll');
    });

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->get('/student/logout', [AuthController::class, 'logout'])
    ->name('student.logout');

/*
|--------------------------------------------------------------------------
| End of Student Routes
|--------------------------------------------------------------------------
*/
