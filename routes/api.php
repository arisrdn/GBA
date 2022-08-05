<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChurchBranchController;
use App\Http\Controllers\Api\ChurchController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\VerificationController;
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
    
    Route::post('register',[AuthController::class, 'register']);
    Route::post('login',[AuthController::class, 'login']);
    //countries
    Route::get('countries',[CountryController::class, 'index']);
    // -->church
    Route::get('churches',[ChurchController::class, 'index']);
    Route::get('church/{id}',[ChurchController::class, 'show']);
    // -->church branch
    Route::get('branch/{id}',[ChurchBranchController::class, 'show']);

    // auth
    //church auth
    Route::post('church',[ChurchController::class, 'store']);
    Route::put('church/{id}',[ChurchController::class, 'update']);
    Route::delete('church/{id}',[ChurchController::class, 'destroy']);
    //branch auth
    Route::post('branch',[ChurchBranchController::class, 'store']);
    Route::put('branch/{id}',[ChurchBranchController::class, 'update']);
    Route::delete('branch/{id}',[ChurchBranchController::class, 'destroy']);
    
    Route::middleware('auth:sanctum','verified')->group(function () {
        Route::get('/', function () {
            // Uses first & second middleware...
            return "aaaa";
        });
     
        
    });
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify.api');
    Route::get('email/verify-2/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
            ->name('verification.send');
    
        Route::apiResources([
            // 'posts' => PostController::class,
        ]);
    });
});
