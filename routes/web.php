<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\CourseController;
use \App\Http\Controllers\LessonController;
use \App\Http\Controllers\AssessmentController;
use \App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // courses
    Route::resource('courses', CourseController::class);
    Route::post('delete-course', [CourseController::class, 'destroy']);

    // lessons
    Route::resource('lessons', LessonController::class);
    Route::post('store-lesson', [LessonController::class, 'storeLesson']);
    Route::post('update-lesson', [LessonController::class, 'updateLesson']);
    Route::post('delete-lesson', [LessonController::class, 'destroy']);
    //  component ajax
    Route::get('lesson-data', [LessonController::class, 'lessonData'])->name('lesson-data');

    // assessments
    Route::resource('assessments', AssessmentController::class);
    Route::post('store-assessment', [AssessmentController::class, 'storeAssessment']);
    Route::post('update-assessment', [AssessmentController::class, 'updateAssessment']);
    Route::post('delete-assessment', [AssessmentController::class, 'destroy']);
    //  component ajax
    Route::get('assessment-data', [AssessmentController::class, 'assessmentData'])->name('assessment-data');
});

Route::middleware(['auth', 'role:instructor'])->group(function (){
    Route::get('instructor/dashboard', [AdminController::class, 'dashboard'])->name('instructor.dashboard');
});

// user
Route::middleware(['auth'])->group(function (){
    Route::get('user-profile', [UserController::class, 'userProfile'])->name('user-profile');
    Route::get('browse-course', [UserController::class, 'browseCourse'])->name('browse-course');
    Route::get('learn-course/{courseId}', [UserController::class, 'learnCourse'])->name('learn-course');
    Route::get('complete-lessons', [UserController::class, 'completeLesson'])->name('complete-lessons');

    Route::get('enroll/{courseId}', [EnrollmentController::class, 'enroll'])->name('enroll');
});
