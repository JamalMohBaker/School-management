<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tester/index');
});
Route::resource('grades', GradeController::class);
Route::resource('classrooms', ClassroomController::class);
Route::resource('users', UserController::class);
