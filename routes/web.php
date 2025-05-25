<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
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
