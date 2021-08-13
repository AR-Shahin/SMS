<?php

use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentAdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\YearController;
use App\Models\DepartmentAdmin;

Route::get('/', function () {
    return view('admin.auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Department
    Route::resource('department', DepartmentController::class);
    Route::get('department-fetch', [DepartmentController::class, 'departmentFetch'])->name('department.fetch');

    # Session
    Route::resource('session', SessionController::class);
    Route::get('session-fetch', [SessionController::class, 'sessionFetch'])->name('session.fetch');

    # Semester
    Route::resource('semester', SemesterController::class);
    Route::get('semester-fetch', [SemesterController::class, 'semesterFetch'])->name('semester.fetch');

    # Course
    Route::resource('course', CourseController::class);
    Route::get('course-fetch', [CourseController::class, 'courseFetch'])->name('course.fetch');

    # Department Admin
    Route::resource('d-admin', DepartmentAdminController::class);
    Route::get('d-admin-fetch', [DepartmentAdminController::class, 'departmentAdminFetch'])->name('d-admin.fetch');

    # Year
    Route::resource('year', YearController::class);
    Route::get('year-fetch', [YearController::class, 'yearFetch'])->name('year.fetch');
});
