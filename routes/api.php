<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmploymentStatusQuestionsController;
use App\Http\Controllers\QuestionChoicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmploymentAnswerController;
use App\Http\Controllers\EmploymentQuestionsController;
use App\Http\Controllers\EmploymentStatusController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEmploymentStatusController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('courses', CoursesController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('employment_status', EmploymentStatusController::class);
Route::apiResource('employmentquestions', EmploymentQuestionsController::class);
Route::apiResource('employmentstatusquestions', EmploymentStatusQuestionsController::class);
Route::apiResource('employmentanswer', EmploymentAnswerController::class);
Route::apiResource('useremploymentstatus', UserEmploymentStatusController::class);
Route::apiResource('notifications', NotificationsController::class);
Route::apiResource('question_choices', QuestionChoicesController::class);
Route::post('login',[UserController::class,'login']);
