<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
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
Route::get('test', [MemberController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/approve/join', [DashboardController::class, 'approve'])->middleware(['auth']);
Route::post('/approve/leave', [DashboardController::class, 'approveleave'])->middleware(['auth']);

Route::get('/member/data', function () {
    return view('admin.test');
})->middleware(['auth'])->name('member.data');

require __DIR__ . '/auth.php';
