<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ChurchBranchController;
use App\Http\Controllers\Api\ChurchController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GroupChatController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\GroupMemberController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReadingPlanController;
use App\Http\Controllers\Api\TodoListController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\Api\WaitingListController;
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

    // auth admin
    //church admin
    Route::post('church', [ChurchController::class, 'store']);
    Route::put('church/{id}', [ChurchController::class, 'update']);
    Route::delete('church/{id}', [ChurchController::class, 'destroy']);
    //branch
    Route::post('branch', [ChurchBranchController::class, 'store']);
    Route::put('branch/{id}', [ChurchBranchController::class, 'update']);
    Route::delete('branch/{id}', [ChurchBranchController::class, 'destroy']);

    // region
    Route::get('provinces', [LocationController::class, 'index']);
    Route::get('regencies/{id}', [LocationController::class, 'show']);

    // auth user
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
    // passwor reset 
    Route::post('password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->middleware('throttle:6,2')->name('passwords.sent');
    Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse'])->name('passwords.reset');

    //    auth scantum
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
        // Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        //     ->name('verification.send');
        route::post('token', [ProfileController::class, 'storetoken']);
        route::get('notifications', [NotificationController::class, 'index']);
        route::get('notification/unread', [NotificationController::class, 'unread']);
        route::post('notification/read/:id', [NotificationController::class, 'update']);
        route::post('notification/readall', [NotificationController::class, 'all']);
    });


    // auth scantum + verify email
    Route::middleware('auth:sanctum', 'verifiedAPI')->group(function () {

        Route::get('reading-plans', [ReadingPlanController::class, 'index']);
        // Route::get('reading-plan/{id}', [ReadingPlanController::class, 'show']);
        // Route::post('group/join', [WaitingListController::class, 'join']);
        Route::post('group/join', [WaitingListController::class, 'join'])->middleware(["waitinglist", "active:join"]);
        Route::post('group/leave', [WaitingListController::class, 'leave'])->middleware(["waitinglist", "active:leave"]);
        Route::post('group/transfer', [WaitingListController::class, 'transfer'])->middleware(["waitinglist", "active:transfer"]);


        // Route::post('group/request-join', [GroupMemberController::class, 'store']);
        // Route::post('group/request-leave', [GroupMemberController::class, 'update']);
        // Route::post('group/request-transfer', [GroupMemberController::class, 'transfer']);
        Route::post('group/history', [GroupMemberController::class, 'index']);
        Route::get('groups', [GroupController::class, 'index']);

        route::get('todos', [TodoListController::class, 'index']);
        route::post('todo', [TodoListController::class, 'store'])->middleware(["waitinglist", "active:transfer"]);
        route::get('todo/today', [TodoListController::class, 'today']);
        route::get('todo/history', [TodoListController::class, 'history']);
        route::get('todo/summary', [TodoListController::class, 'summary']);


        route::get('chat/admins', [ChatController::class, 'index']);
        route::post('chat/admin', [ChatController::class, 'store']);
        route::get('chat/admin/{id}', [ChatController::class, 'show']);
        route::get('chat/groups', [GroupChatController::class, 'index']);
        route::get('chat/group/{id}', [GroupChatController::class, 'show']);
        route::post('chat/group', [GroupChatController::class, 'store']);

        route::get('profile', [ProfileController::class, 'index']);
        route::put('profile/update', [ProfileController::class, 'update2']);
        route::post('profile/update', [ProfileController::class, 'update']);
        route::put('password/change', [ProfileController::class, 'changepassword']);
    });
    route::get('tes', [ProfileController::class, 'tes']);
});
