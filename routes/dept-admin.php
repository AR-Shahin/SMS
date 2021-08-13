<?php

use App\Http\Controllers\Department\AssignTeacherController;
use App\Http\Controllers\Department\Auth\LoginController;
use App\Http\Controllers\Department\CourseSemesterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Department\DashboardController;
use App\Http\Controllers\Department\TeacherController;

Route::prefix('dept-admin')->name('dept-admin.')->group(function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    // Auth
    Route::middleware('auth:dept_admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        # Semester Course
        Route::resource('course', CourseSemesterController::class);
        Route::get('course-fetch', [CourseSemesterController::class, 'courseSemesterFetch'])->name('course-fetch');

        # Teacher
        Route::resource('teacher', TeacherController::class);
        Route::get('teacher-fetch', [TeacherController::class, 'teacherFetch'])->name('teacher-fetch');

        # Teacher Assign Course
        Route::get('teacher-course', [AssignTeacherController::class, 'teacherAssignCourse'])->name('teacher-course');
        Route::post('teacher-course', [AssignTeacherController::class, 'teacherAssignCourseStore'])->name('teacher-course');
        Route::get('fetch-teacher-course', [AssignTeacherController::class, 'fetchTeacherCourses'])->name('fetch-teacher-course');
    });
});
