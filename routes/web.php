<?php

use App\Http\Controllers\CircularController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewAndUpdatesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

// Landing page routes
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/about', [LandingPageController::class, 'about'])->name('landing.about');
Route::get('/features', [LandingPageController::class, 'features'])->name('landing.features');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('landing.contact');
Route::get('/login-as', [LandingPageController::class, 'loginRedirection'])->name('landing.login-redirection');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
    Route::get('/teacher/transfer-application', [TeacherController::class, 'transferApplication'])->name('teacher.transfer-application');
    Route::get('/teacher/transfer-application-status', [TeacherController::class, 'transferApplicationStatus'])->name('teacher.transfer-application-status');

    /* Teacher Section */
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/reportlist', [TeacherController::class, 'reportlist'])->name('teacher.reportlist');
    Route::get('/teacher/fullreportcurrent', [TeacherController::class, 'fullreportcurrent'])->name('teacher.fullreportcurrent');
    Route::get('/teacher/register', [TeacherController::class, 'create'])->name('teacher.register');
    Route::post('/teacher/register', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/search', [TeacherController::class, 'search'])->name('teacher.search');

    //Route::get('/teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
    Route::get('/teacher/profileedit', [TeacherController::class, 'profileedit'])->name('teacher.profileedit');
    Route::post('/teacher/profileupdate', [TeacherController::class, 'profileupdate'])->name('teacher.profileupdate');

    Route::get('/school/search', [SchoolController::class, 'search'])->name('school.search');
    Route::get('/school/profile/{id?}', [SchoolController::class, 'profile'])->name('school.profile');
    Route::get('/school/classprofile/{id?}', [SchoolController::class, 'classprofile'])->name('school.classprofile');
    Route::get('/school/classsetup', [SchoolController::class, 'classsetup'])->name('school.classsetup');
    Route::post('/school/classprofile/{id?}', [SchoolController::class, 'classstore'])->name('school.classstore');

    Route::get('/school/dashboard', [SchoolController::class, 'index'])->name('school.dashboard');
    Route::get('/school/reports', [SchoolController::class, 'reports'])->name('school.reports');
    Route::get('/school/classdashboard', [SchoolController::class, 'classindex'])->name('school.classdashboard');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employer/profile', [EmploymentController::class, 'employment'])->name('employer.employment');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/news', [NewAndUpdatesController::class, 'news'])->name('news');
    Route::get('/notifications', [NotificationsController::class, 'notifications'])->name('notifications');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/circular', [CircularController::class, 'circular'])->name('circular');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/inquiry', [InquiryController::class, 'inquiry'])->name('inquiry');
});


Route::get('/send-test-mail', [EmailController::class, 'testMailSend']);

require __DIR__.'/auth.php';
