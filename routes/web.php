<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tester/index');
});
Route::resource('grades', GradeController::class);
