<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomsStudentController;
use App\Http\Controllers\ExamAnswer;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Sub_teacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tester/index');
})->name('home')->middleware('auth');
Route::resource('grades', GradeController::class); //->middleware(['auth.type:secretary'])
Route::resource('classrooms', ClassroomController::class); //->middleware(['auth.type:secretary'])
Route::resource('users', UserController::class); //->middleware(['auth.type:admin,secretary'])
Route::resource('subjects', SubjectController::class); //->middleware(['auth.type:secretary'])
Route::resource('sub_teachers', controller: Sub_teacherController::class); //->middleware(['auth.type:teacher,admin,student'])
Route::resource('lectures', controller: LectureController::class); //->middleware(['auth.type:teacher'])
Route::middleware(['auth.type:secretary,teacher,admin,student'])->group(function (){
    Route::resource('class_students', controller: ClassroomsStudentController::class);
    Route::get('class_students/{classroom_id}/{user_id}/edit', [ClassroomsStudentController::class, 'edit'])->name('class_students.edit');
    Route::put('class_students/{classroom_id}/{user_id}', [ClassroomsStudentController::class, 'update'])->name('class_students.update');
    Route::delete('/class_students', [ClassroomsStudentController::class, 'destroy']);
});
Route::resource('exams', controller: ExamController::class);
Route::resource('questions', controller: QuestionController::class);
Route::get('/exam/addQuestion/{id}', [QuestionController::class, 'addQuestion'])->name('exam.addQuestion');

Route::resource('students', controller: StudentController::class);
Route::get('/students/ExamInfo/{id}',[StudentController::class, 'information'])->name('student.info');
Route::get('/students/questinExam/{id}',[StudentController::class, 'questinExam'])->name('student.questinExam');
// ->middleware(['auth.type:teacher'])
Route::resource('examAnswer', controller: ExamAnswer::class);

// Route::middleware(['auth.type:secretary,teacher'])->group(function () {
//     Route::get('class_students', [ClassroomsStudentController::class, 'index'])->name('class_students.index');
//     Route::get('class_students/create', [ClassroomsStudentController::class, 'create'])->name('class_students.create');
//     Route::post('class_students', [ClassroomsStudentController::class, 'store'])->name('class_students.store');

//     Route::get('class_students/{classroom_id}/{user_id}/edit', [ClassroomsStudentController::class, 'edit'])->name('class_students.edit');
//     Route::put('class_students/{classroom_id}/{user_id}', [ClassroomsStudentController::class, 'update'])->name('class_students.update');
//     Route::delete('class_students/{classroom_id}/{user_id}', [ClassroomsStudentController::class, 'destroy'])->name('class_students.destroy');

//     Route::get('class_students/{classroom_id}/{user_id}', [ClassroomsStudentController::class, 'show'])->name('class_students.show');
// });
