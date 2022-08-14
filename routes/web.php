<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WebNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return view('admin/test');
// });
Route::get('test', [DashboardController::class, 'update']);
Route::get('testload', [DashboardController::class, 'test']);


Route::middleware(['auth',])->group(function () {
    Route::get('chat', [ChatController::class, 'update'])->name('chat');
    Route::post('chat', [ChatController::class, 'createmessage']);
    // Route::post('render', [ChatController::class, 'loadmessage'])->name('render');;
    Route::get('render', [ChatController::class, 'loadmessage'])->name('render');;
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/approve/join', [DashboardController::class, 'approve'])->middleware(['auth']);
Route::post('/approve/leave', [DashboardController::class, 'approveleave'])->middleware(['auth']);

Route::get('/member/data', function () {
    return view('admin.test');
})->middleware(['auth'])->name('member.data');

require __DIR__ . '/auth.php';


Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');

Route::get('push-notification', [NotificationController::class, 'index']);
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('send.notification');
