<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\Api\NotificationController as Notify;
use App\Http\Controllers\ChurchBranchController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\GroupPlanController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('admin/test');
// });
Route::get('test', [DashboardController::class, 'update']);
Route::get('testload', [DashboardController::class, 'test']);
Route::get('abc', [DashboardController::class, 'abc'])->middleware("role");



Route::middleware(['auth', "role"])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('gereja/pusat', [ChurchController::class, 'index'])->name('gereja');
    Route::post('gereja/pusat', [ChurchController::class, 'store']);
    Route::put('gereja/pusat', [ChurchController::class, 'update']);
    Route::delete('gereja/pusat', [ChurchController::class, 'destroy']);
    Route::get('gereja/cabang', [ChurchBranchController::class, 'index'])->name('gereja.cabang');
    Route::post('gereja/cabang', [ChurchBranchController::class, 'store']);
    Route::put('gereja/cabang', [ChurchBranchController::class, 'update']);
    Route::delete('gereja/cabang', [ChurchBranchController::class, 'destroy']);
    Route::get('rencana-baca', [GroupPlanController::class, 'index'])->name('rencana.baca');
    Route::post('rencana-baca', [GroupPlanController::class, 'store']);
    Route::put('rencana-baca', [GroupPlanController::class, 'update']);
    Route::delete('rencana-baca', [GroupPlanController::class, 'destroy']);
    Route::get('group', [GroupController::class, 'index'])->name('group');
    Route::get('group/create', [GroupController::class, 'create'])->name('group.add');
    Route::post('group', [GroupController::class, 'store']);
    Route::delete('group', [GroupController::class, 'destroy']);
    Route::get('group/{id}', [GroupController::class, 'show'])->name('group.show');
    // Route::get('grup/{id}/edit', [GroupController::class, 'edit'])->name('group.edit');
    // Route::patch('grup/{id}/edit', [GroupController::class, 'update']);
    Route::patch('grup/time', [GroupController::class, 'updatetime']);
    Route::patch('grup/admin', [GroupController::class, 'updateadmin']);
    Route::patch('grup/todo', [GroupController::class, 'updatetodo']);
    Route::get('anggota/join', [MemberController::class, 'indexjoin'])->name('join');
    Route::get('anggota/leave', [MemberController::class, 'indexleave'])->name('leave');
    Route::get('anggota/transfer', [MemberController::class, 'indextf'])->name('transfer');
    Route::post('anggota/join', [MemberController::class, 'storejoin']);
    Route::post('anggota/leave', [MemberController::class, 'storeleave']);
    Route::post('anggota/transfer', [MemberController::class, 'storetf']);

    Route::get('profile', [MemberController::class, 'index'])->name('profile');
    Route::patch('profile', [MemberController::class, 'update']);
    Route::patch('profile/change-password', [MemberController::class, 'changepassword'])->name('change.password');

    Route::get('user/add', [UserController::class, 'create']);
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('user', [UserController::class, 'store']);

    // Route::get('chat', [ChatController::class, 'update'])->name('chat');
    // Route::view('chat/{path?}', 'admin.chat')
    //     ->where('path', '.*');

    Route::get('chat/group', [ChatController::class, 'update'])->name('chat');
    Route::view('chat/group/{path?}', 'admin.chat')
        ->where('path', '.*');
    Route::get('chat/broadcast', [ChatController::class, 'broadcast'])->name('broadcast');;
    Route::post('chat/broadcast', [ChatController::class, 'broadcaststore']);

    //json

    Route::post('messages/p', [ChatController::class, 'storep']);
    Route::post('messages/g', [ChatController::class, 'storeg']);
    Route::get('contact/user', [ChatController::class, 'contact']);
    Route::get('contact/group', [ChatController::class, 'group']);
    Route::get('messages/p/{id}', [ChatController::class, 'message']);
    Route::get('messages/g/{id}', [ChatController::class, 'messageGroup']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::get('g/{id}', [UserController::class, 'showg']);
    Route::get('auth', [UserController::class, 'index']);
    // route::post('token', [ProfileController::class, 'storetoken']);
    route::get('notifications', [Notify::class, 'index']);
    route::get('notification/unread', [Notify::class, 'unread']);
    route::post('notification/read/{id}', [Notify::class, 'update']);
    route::post('notification/readall', [Notify::class, 'all']);
    Route::get('t/{id}', [UserController::class, 'test']);
});

// Route::get('contact', [ChatController::class, 'contact']);


// Route::post('/approve/join', [DashboardController::class, 'approve'])->middleware(['auth']);
// Route::post('/approve/leave', [DashboardController::class, 'approveleave'])->middleware(['auth']);

Route::get('/member/data', function () {
    return view('admin.test');
})->middleware(['auth'])->name('member.data');

require __DIR__ . '/auth.php';


// ??????

Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
