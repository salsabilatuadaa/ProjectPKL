<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    // Route::get('/', [DashboardController::class, 'home']);
	// Route::get('dashboard', function () {
	// 	return view('dashboard');
	// })->name('dashboard');

	Route::get('riwayat-cuti', function () {
		return view('riwayat-cuti');
	})->name('riwayat-cuti');

	// Route::get('profile', function () {
	// 	return view('profile');
	// })->name('profile');

	Route::get('list-user', function () {
		return view('admin.list-user');
	})->name('list-user');

	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');

	Route::get('pengajuan-cuti', function () {
		return view('pengajuan-cuti');
	})->name('pengajuan-cuti');

    Route::get('list-pengajuan-cuti', function () {
		return view('admin.list-pengajuan-cuti');
	})->name('list-pengajuan-cuti');

	Route::get('list-pengajuan-cuti', function () {
		return view('karyawan.list-pengajuan-cuti');
	})->name('list-pengajuan-cuti');

    // Route::get('static-sign-in', function () {
	// 	return view('static-sign-in');
	// })->name('sign-in');

    // Route::get('static-sign-up', function () {
	// 	return view('static-sign-up');
	// })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/', function () {
    return view('session/login-session');
})->name('login');