<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route cho trang tạo đơn xin nghỉ phép
Route::get('/leave/create', [AttendanceController::class, 'showCreateForm'])->name('leave.create');
Route::post('/leave/store', [AttendanceController::class, 'create'])->name('leave.store');

// Route cho trang thống kê chấm công
Route::get('/attendance/statistics', [AttendanceController::class, 'showStatistics'])->name('attendance.statistics');

Route::get('/', function () {
    return view('welcome');
});
