<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\OtpVerificationController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/staff/login', [LoginController::class, 'show'])->name('staff.login');
Route::post('/staff/login', [LoginController::class, 'login']);
Route::get('/otp/verification', [OtpVerificationController::class, 'show'])->name('otp.verify');
Route::post('/otp/verification', [OtpVerificationController::class, 'verify'])->name('otp.verify');
Route::post('/otp/resend', [OtpVerificationController::class, 'resend'])->name('otp.resend');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/user/create', [UserController::class, 'store'])->name('user.insert');
    Route::get('/admin/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('admin/user/edit', [UserController::class, 'update'])->name('user.update');
});
