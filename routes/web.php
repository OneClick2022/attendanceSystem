<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GraphController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->group(function () {
    Route::get('', [HomeController::class, 'home']);
    Route::get('student', [HomeController::class, 'student']);
    Route::get('student/changePresence/{date}',[GraphController::class, 'change']);
    Route::get('/studentInfo/{id}', [StudentController::class, 'studentInfo'])->name('student.studentInfo');
    Route::get('subject', [HomeController::class, 'subject']);
    Route::get('profile', [HomeController::class, 'profile']);
    Route::get('upload', [HomeController::class, 'upload']);
    Route::post('upload/add', [GraphController::class, 'uploadAdd']);
    Route::prefix('admin')->group(function () {
        Route::get('', [HomeController::class, 'admin']);
        Route::prefix('/faculty')->group(function(){
            Route::get('', [HomeController::class, 'facultyAdmin']);
            Route::post('/add', [FacultyController::class, 'add']);
            Route::post('/update/{id}', [FacultyController::class, 'update']);
            Route::get('/delete/{id}', [FacultyController::class, 'delete'])->name('admin.faculty.delete');
        });

        Route::get('timetable', [HomeController::class, 'timetable']);

        Route::prefix('student')->group(function(){
            Route::get('', [HomeController::class, 'studentAdmin']);
            Route::post('/add', [StudentController::class, 'add']);
            Route::post('/update/{id}', [StudentController::class, 'update']);
            Route::get('/editSub/{id}', [StudentController::class, 'editSub']);
            Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('admin.student.delete');
        });
        Route::prefix('subject')->group(function(){
            Route::get('', [HomeController::class, 'subjectAdmin']);
            Route::get('/add', [SubjectController::class, 'add']);
            Route::get('/update/{id}', [SubjectController::class, 'update']);
            Route::get('/delete/{id}', [SubjectController::class, 'delete'])->name('admin.subject.delete');
        });
    });
});

Route::prefix('/main')->group(function () {
    Route::get('',[MainController::class, 'index']);
    Route::post('/checklogin', [MainController::class, 'checklogin']);
    Route::get('/successlogin', [MainController::class, 'successlogin']);
    Route::get('/logout', [MainController::class, 'logout']);
});

Route::get('/show-map',[GraphController::class, 'show']);
Route::get('/calendar',[GraphController::class, 'showCal']);
Route::get('/calendar/changePresence/{date}',[GraphController::class, 'change']);


