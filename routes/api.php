<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\ChurchBranchController;
use App\Http\Controllers\Api\ChurchController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\GroupMemberController;
use App\Http\Controllers\Api\ReadingPlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return $request->user();
});


Route::prefix('v1')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    //countries
    Route::get('countries', [CountryController::class, 'index']);
    // -->church
    Route::get('churches', [ChurchController::class, 'index']);
    Route::get('church/{id}', [ChurchController::class, 'show']);
    // -->church branch
    Route::get('branch/{id}', [ChurchBranchController::class, 'show']);
    // email verify
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify.api');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
        Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
            ->name('verification.send');
    });

    // auth admin
    //church admin
    Route::post('church', [ChurchController::class, 'store']);
    Route::put('church/{id}', [ChurchController::class, 'update']);
    Route::delete('church/{id}', [ChurchController::class, 'destroy']);
    //branch
    Route::post('branch', [ChurchBranchController::class, 'store']);
    Route::put('branch/{id}', [ChurchBranchController::class, 'update']);
    Route::delete('branch/{id}', [ChurchBranchController::class, 'destroy']);

    // test verif email
    Route::middleware('auth:sanctum', 'verifiedAPI')->group(function () {
        Route::get('/', function () {
            // Uses first & second middleware...
            return "aaaa";
        });
    });

    // passwor reset 
    Route::post('password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->middleware('throttle:6,2')->name('passwords.sent');
    Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse'])->name('passwords.reset');

    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups', 'index');
        Route::post('group', 'store');
    });
    Route::get('reading-plans', [ReadingPlanController::class, 'index']);
    Route::get('reading-plan/{id}', [ReadingPlanController::class, 'show']);

    Route::post('group/request-join', [GroupMemberController::class, 'store']);
    Route::post('group/request-leave', [GroupMemberController::class, 'update']);
});
