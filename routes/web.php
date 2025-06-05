<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomsStudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\Sub_teacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tester/index');
});
Route::resource('grades', GradeController::class);
Route::resource('classrooms', ClassroomController::class);
Route::resource('users', UserController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('sub_teachers', controller: Sub_teacherController::class);
Route::resource('lectures', controller: LectureController::class);
Route::resource('class_students', controller: ClassroomsStudentController::class);
Route::get('class_students/{classroom_id}/{user_id}/edit', [ClassroomsStudentController::class, 'edit'])->name('class_students.edit');
Route::put('class_students/{classroom_id}/{user_id}', [ClassroomsStudentController::class, 'update'])->name('class_students.update');
Route::delete('/class_students', [ClassroomsStudentController::class, 'destroy']);
