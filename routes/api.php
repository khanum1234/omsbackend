<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\StudentRegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\QuestionsController;
use  App\Http\Controllers\AnswersController;
use  App\Http\Controllers\AttendancesController;
Route::prefix('auth')->group(function(){
    Route::post('signup',[AuthController::class,'signup']);
    Route::post('login',[AuthController::class,'login']);
});

//users
Route::prefix('users')->middleware('auth:sanctum')->group(function(){
    Route::get('profile',[UsersController::class,'profile']);
    Route::put('update_profile/{id}',[UsersController::class,'update_profile']);
});

// categories
Route::resource('categories',CategoryController::class)->middleware('auth:sanctum');

Route::resource('StudentReg',StudentRegistrationController::class)->middleware('auth:sanctum');

Route::resource('lessons',LessonsController ::class)->middleware('auth:sanctum');

Route::resource('Session',SessionsController ::class)->middleware('auth:sanctum');


Route::get('/lessons/{lessonId}/questions', [QuestionsController::class, 'show'])->name('questions.show');
Route::post('/questions', [QuestionsController::class, 'store'])->name('questions.store');


Route::post('/answers', [AnswersController::class, 'store'])->name('answers.store');


Route::get('/attendance', [AttendancesController::class, 'index'])->name('attendance.index');