<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmploymentStatusQuestionsController;
use App\Http\Controllers\QuestionChoicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmploymentAnswerController;
use App\Http\Controllers\EmploymentQuestionsController;
use App\Http\Controllers\EmploymentStatusController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserEmploymentStatusController;
use App\Models\Announcement;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load('employmentStatus.status');
});


Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user('admin');
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
Route::apiResource('announcements', AnnouncementController::class);
Route::post('login',[UserController::class,'login']);

Route::post('admin/login',[AdminController::class,'login']);
Route::get('/account/activate/{token}', [AuthController::class, 'activateAccount']);
Route::post('/validate-token', [AuthController::class, 'validateToken']);
Route::post('/resend-activation-link', [AuthController::class, 'resendActivationLink']);
Route::post('/account/set-password', [AuthController::class, 'setPassword']);

Route::put('admin/change_password/{id}',[AdminController::class,'change_password']);
Route::put('user/change_password/{id}',[UserController::class,'change_password']);
Route::get('dashboard', [PagesController::class, 'dashboard']);
Route::get('logs', [PagesController::class, 'logs']);
Route::patch('/alumni/{id}/archive', [UserController::class, 'archive']);
Route::patch('/announcement/{id}/archive', [AnnouncementController::class, 'archive']);

Route::get('/analytics', [AnalyticsController::class, 'job_placements']);
Route::get('/analytics1', [AnalyticsController::class, 'getEmploymentStatusPerMonth']);
Route::get('/analytics2', [AnalyticsController::class, 'getPresentEmploymentStatus']);
Route::get('/analytics3', [AnalyticsController::class, 'getPresentOccupation']);
Route::get('/analytics4', [AnalyticsController::class, 'getPresentLineOfWork']);
Route::get('/analytics5', [AnalyticsController::class, 'getPresentPlaceOfWork']);
Route::get('/analytics6', [AnalyticsController::class, 'getPresentFirstJob']);
Route::get('/analytics7', [AnalyticsController::class, 'getPresentReasonStaying']);
Route::get('/analytics8', [AnalyticsController::class, 'getITRelated']);
Route::get('/analytics9', [AnalyticsController::class, 'getPresentReasonForAccept']);
Route::get('/analytics10', [AnalyticsController::class, 'getPresentReasonForChanging']);
Route::get('/analytics11', [AnalyticsController::class, 'getPresentStayFirstJob']);
Route::get('/analytics12', [AnalyticsController::class, 'getPresentHowFind']);
Route::get('/analytics13', [AnalyticsController::class, 'getPresentHowLong']);
Route::get('/analytics14', [AnalyticsController::class, 'getPresentPositionFirst']);
Route::get('/analytics15', [AnalyticsController::class, 'getPresentPositionPresent']);
Route::get('/analytics16', [AnalyticsController::class, 'getPresentInitialGross']);
Route::get('/analytics17', [AnalyticsController::class, 'getRelevantCurriculum']);
Route::get('/analytics18', [AnalyticsController::class, 'getPresentCompetencies']);



Route::post('upload-csv', [PagesController::class, 'uploadCSV']);
Route::get('/official_list', [PagesController::class, 'official_list']);