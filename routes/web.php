<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseAssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Pages
Route::get('/login', fn() => view('login'))->name('login');
Route::get('/register', fn() => view('register'));

// Auth Actions
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Dashboard redirect
Route::get('/dashboard', function () {

    $role = auth()->user()->role;

    if ($role == 'admin') {
        return redirect('/admin');
    }

    if ($role == 'teacher') {
        return redirect('/teacher');
    }

    return redirect('/student');

})->middleware('auth');

Route::middleware(['auth'])->group(function(){

    Route::get('/admin', function () {
        return view('superadmin');
    })->middleware('role:admin')->name('admin');

    Route::get('/teacher', function () {
        return view('teacher');
    })->middleware('role:teacher')->name('teacher');

    Route::get('/student', function () {
        return view('student');
    })->middleware('role:student')->name('student');


    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::post('/users/{id}/update', [UserController::class,'update'])->name('users.update');
    Route::get('/users/{id}/delete', [UserController::class,'delete'])->name('users.delete');

    Route::resource('courses', CourseController::class)->except(['show']);;

    Route::middleware(['auth', 'role:admin'])->group(function() {
        Route::get('courses/assign', [CourseAssignmentController::class,'index'])->name('assign.index');
        Route::post('courses/assign/teacher/{teacher_id}', [CourseAssignmentController::class,'assignTeacher'])->name('assign.teacher.update');
        Route::post('courses/assign/student/{student_id}', [CourseAssignmentController::class,'assignStudent'])->name('assign.student.update');
    });
    Route::middleware(['auth', 'role:teacher'])->group(function() {
        // Show teacher's courses
        Route::get('/take-attendance', [AttendanceController::class,'showCourses'])->name('teacher.courses');

        // Show students of selected course
        Route::get('/take-attendance/{course}', [AttendanceController::class,'showStudents'])->name('teacher.attendance.form');

        // Submit attendance
        Route::post('/take-attendance/{course}', [AttendanceController::class,'storeAttendance'])->name('teacher.attendance.store');
        Route::get('/teacher/attendance-report', [AttendanceController::class, 'teacherReport'])
            ->name('teacher.attendance.report');
    });

    Route::get('/attendance-report', [AttendanceController::class, 'report'])->name('attendance.report');

    Route::middleware(['auth','role:student'])->group(function () {
        Route::get('/my-attendance', [AttendanceController::class, 'studentAttendance'])
            ->name('student.attendance');
    });

});
