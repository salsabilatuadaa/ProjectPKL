<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardKaryawanController;
use App\Http\Controllers\DashboardKepegawaianController;
use App\Http\Controllers\DashboardAtasanController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ListPengajuanCutiAtasanController;
use App\Http\Controllers\ListPengajuanCutiHRController;
use App\Http\Controllers\PengajuanCutiKaryawanController;
use App\Http\Controllers\PengajuanCutiAtasanController;
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



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
});

Route::get('/', function () {
    return view('session.login-session');
})->name('login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');


    Route::group(['middleware' => 'profile.complete'], function () {
        Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
       
    });

    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('user-profile');
    Route::post('/user-profile', [InfoUserController::class, 'store'])->name('simpan-profile');
    Route::get('/edit-profile', [InfoUserController::class, 'editDataUser'])->name('edit-data-user');    
    Route::post('/update-profile/{id}', [InfoUserController::class, 'updateDataUser'])->name('update-data-user');

    //kepegawaian
    Route::middleware(['checkrole:1', 'profile.complete'])->group(function (){
        Route::get('/list-pengajuan-cuti-hr', [ListPengajuanCutiHRController::class, 'showPengajuanHR'])->name('list-pengajuan-cuti-hr');
        Route::get('/setujui-hr/{id}', [ListPengajuanCutiHRController::class, 'setujuiPengajuan'])->name('setujui-hr');
        Route::get('/tolak-hr/{id}', [ListPengajuanCutiHRController::class, 'tolakPengajuan'])->name('tolak-hr');
        Route::get('/setujui-hra/{id}', [ListPengajuanCutiHRController::class, 'setujuiPengajuanAts'])->name('setujui-hra');
        Route::get('/tolak-hra/{id}', [ListPengajuanCutiHRController::class, 'tolakPengajuanAts'])->name('tolak-hra');
        Route::get('/riwayat-verifikasi-hr', [ListPengajuanCutiHRController::class, 'showListHR'])->name('riwayat-verifikasi-hr');
    });

    //Admin
    Route::middleware(['checkrole:2', 'profile.complete'])->group(function (){
        Route::get('/list-pengajuan-atasan', [AdminController::class, 'showPengajuanAtasan'])->name('list-pengajuan-atasan');
        Route::get('/setujui-pengajuan-ats/{id}', [AdminController::class, 'setujuiPengajuanAtasan']);
        Route::get('/tolak-pengajuan-ats/{id}', [AdminController::class, 'tolakPengajuanAtasan']);
        Route::get('/setujui-pengajuan-hr/{id}', [AdminController::class, 'setujuiPengajuanHR']);
        Route::get('/tolak-pengajuan-hr/{id}', [AdminController::class, 'tolakPengajuanHR']);
        Route::get('/setujui-pengajuan-hra/{id}', [AdminController::class, 'setujuiPengajuanHRAts']);
        Route::get('/tolak-pengajuan-hra/{id}', [AdminController::class, 'tolakPengajuanHRAts']);
        Route::get('/list-pengajuan-hr', [AdminController::class, 'showPengajuanHR'])->name('list-pengajuan-hr');
    });

    //Atasan
    Route::middleware(['checkrole:3', 'profile.complete'])->group(function (){
        Route::get('/list-pengajuan-cuti', [ListPengajuanCutiAtasanController::class, 'showPengajuan'])->name('list-pengajuan-cuti');
        Route::get('/setujui-pengajuan/{id}', [ListPengajuanCutiAtasanController::class, 'setujuiPengajuan']);
        Route::get('/tolak-pengajuan/{id}', [ListPengajuanCutiAtasanController::class, 'tolakPengajuan']);
        Route::get('/riwayat-verifikasi', [ListPengajuanCutiAtasanController::class, 'showList'])->name('riwayat-verifikasi-atasan');
        Route::get('/pengajuan-cuti-atasan', [PengajuanCutiAtasanController::class, 'showCuti'])->name('pengajuan-cuti-atasan');
        Route::get('/form-pengajuan-atasan', [PengajuanCutiAtasanController::class, 'show'])->name('form-pengajuan-atasan');
        Route::post('/form-pengajuan-atasan', [PengajuanCutiAtasanController::class, 'store'])->name('simpan-pengajuan-atasan');
        Route::get('/edit-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'editDataCuti'])->name('edit-data-cuti-atasan');            
        Route::post('/update-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'updateDataCuti'])->name('update-data-cuti-atasan');            
        Route::get('/cancel-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'cancelDataCuti'])->name('cancel-data-cuti-atasan');    
        Route::get('/riwayat-cuti-atasan', [PengajuanCutiAtasanController::class, 'showRiwayat'])->name('riwayat-cuti-atasan');
    });

    //Karyawan
    Route::middleware(['checkrole:4', 'profile.complete'])->group(function (){
        Route::get('/form-pengajuan', [PengajuanCutiKaryawanController::class, 'show'])->name('form-pengajuan');
        Route::post('/form-pengajuan', [PengajuanCutiKaryawanController::class, 'store'])->name('simpan-pengajuan');
        Route::get('/pengajuan-cuti-karyawan', [PengajuanCutiKaryawanController::class, 'showCuti'])->name('pengajuan-cuti-karyawan');
        Route::get('/edit-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'editDataCuti'])->name('edit-data-cuti');            
        Route::post('/update-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'updateDataCuti'])->name('update-data-cuti');            
        Route::get('/cancel-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'cancelDataCuti'])->name('cancel-data-cuti');    
        Route::get('/riwayat-cuti-karyawan', [PengajuanCutiKaryawanController::class, 'showRiwayat'])->name('riwayat-cuti-karyawan');
    });

    Route::get('riwayat-cuti', function () {
        return view('riwayat-cuti');
    })->name('riwayat-cuti');

    Route::get('list-user', function () {
        return view('admin.list-user');
    })->name('list-user');

    Route::get('karyawan-list-pengajuan-cuti', function () {
        return view('karyawan.list-pengajuan-cuti');
    })->name('list-pengajuan-cuti');
});


// Route::group(['middleware' => 'auth', 'profile.complete'], function () {
//     Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
//     Route::get('/logout', [SessionsController::class, 'destroy']);

//     Route::get('/user-profile', [InfoUserController::class, 'create'])->name('user-profile');
//     Route::post('/user-profile', [InfoUserController::class, 'store'])->name('simpan-profile');
// 	Route::get('/edit-profile', [InfoUserController::class, 'editDataUser'])->name('edit-data-user');	
// 	Route::post('/update-profile/{id}', [InfoUserController::class, 'updateDataUser'])->name('update-data-user');


	
	
// 	//kepegawaian
// 	Route::middleware(['checkrole:1', 'profile.complete'])->group(function (){
// 		Route::get('/list-pengajuan-cuti-hr', [ListPengajuanCutiHRController::class, 'showPengajuanHR'])->name('list-pengajuan-cuti-hr');
// 		Route::get('/setujui-pengajuan-hr/{id}', [ListPengajuanCutiHRController::class, 'setujuiPengajuanHR']);
// 		Route::get('/tolak-pengajuan-hr/{id}', [ListPengajuanCutiHRController::class, 'tolakPengajuanHR']);
// 		Route::get('/riwayat-verifikasi-hr', [ListPengajuanCutiHRController::class, 'showListHR'])->name('riwayat-verifikasi-hr');


// 	});

// 	//admin
// 	Route::middleware(['checkrole:2', 'profile.complete'])->group(function (){
// 		Route::get('/list-pengajuan-atasan', [AdminController::class, 'showPengajuanAtasan'])->name('list-pengajuan-atasan');
// 		Route::get('/setujui-pengajuan-ats/{id}', [AdminController::class, 'setujuiPengajuanAtasan']);
// 		Route::get('/tolak-pengajuan-ats/{id}', [AdminController::class, 'tolakPengajuanAtasan']);
// 		Route::get('/setujui-pengajuan-hr/{id}', [AdminController::class, 'setujuiPengajuanHR']);
// 		Route::get('/tolak-pengajuan-hr/{id}', [AdminController::class, 'tolakPengajuanHR']);
// 		Route::get('/setujui-pengajuan-hra/{id}', [AdminController::class, 'setujuiPengajuanHRAts']);
// 		Route::get('/tolak-pengajuan-hra/{id}', [AdminController::class, 'tolakPengajuanHRAts']);
// 		Route::get('/list-pengajuan-hr', [AdminController::class, 'showPengajuanHR'])->name('list-pengajuan-hr');

		
// 	});

// 	//atasan
// 	Route::middleware(['checkrole:3', 'profile.complete'])->group(function (){
// 		Route::get('/list-pengajuan-cuti', [ListPengajuanCutiAtasanController::class, 'showPengajuan'])->name('list-pengajuan-cuti');
// 		Route::get('/setujui-pengajuan/{id}', [ListPengajuanCutiAtasanController::class, 'setujuiPengajuan']);
// 		Route::get('/tolak-pengajuan/{id}', [ListPengajuanCutiAtasanController::class, 'tolakPengajuan']);
// 		Route::get('/riwayat-verifikasi', [ListPengajuanCutiAtasanController::class, 'showList'])->name('riwayat-verifikasi-atasan');
// 		Route::get('/pengajuan-cuti-atasan', [PengajuanCutiAtasanController::class, 'showCuti'])->name('pengajuan-cuti-atasan');
// 		Route::get('/form-pengajuan-atasan', [PengajuanCutiAtasanController::class, 'show'])->name('form-pengajuan-atasan');
// 		Route::post('/form-pengajuan-atasan', [PengajuanCutiAtasanController::class, 'store'])->name('simpan-pengajuan-atasan');
// 		Route::get('/edit-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'editDataCuti'])->name('edit-data-cuti-atasan');			
// 		Route::post('/update-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'updateDataCuti'])->name('update-data-cuti-atasan');			
// 		Route::get('/cancel-data-cuti-atasan/{id}', [PengajuanCutiAtasanController::class, 'cancelDataCuti'])->name('cancel-data-cuti-atasan');	
// 		Route::get('/riwayat-cuti-atasan', [PengajuanCutiAtasanController::class, 'showRiwayat'])->name('riwayat-cuti-atasan');




// 	});

// 	//karyawan
// 	Route::middleware(['checkrole:4'])->group(function (){
// 		Route::get('/form-pengajuan', [PengajuanCutiKaryawanController::class, 'show'])->name('form-pengajuan');
// 		Route::post('/form-pengajuan', [PengajuanCutiKaryawanController::class, 'store'])->name('simpan-pengajuan');
// 		Route::get('/pengajuan-cuti-karyawan', [PengajuanCutiKaryawanController::class, 'showCuti'])->name('pengajuan-cuti-karyawan');
// 		Route::get('/edit-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'editDataCuti'])->name('edit-data-cuti');			
// 		Route::post('/update-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'updateDataCuti'])->name('update-data-cuti');			
// 		Route::get('/cancel-data-cuti/{id}', [PengajuanCutiKaryawanController::class, 'cancelDataCuti'])->name('cancel-data-cuti');	
// 		Route::get('/riwayat-cuti-karyawan', [PengajuanCutiKaryawanController::class, 'showRiwayat'])->name('riwayat-cuti-karyawan');


// 	});



// 	Route::get('riwayat-cuti', function () {
// 		return view('riwayat-cuti');
// 	})->name('riwayat-cuti');

// 	// Route::get('profile', function () {
// 	// 	return view('profile');
// 	// })->name('profile');

// 	Route::get('list-user', function () {
// 		return view('admin.list-user');
// 	})->name('list-user');

// 	// Route::get('karyawan.pengajuan-cuti-karyawan', function () {
// 	// 	return view('karyawan.pengajuan-cuti-karyawan');
// 	// })->name('pengajuan-cuti-karyawan');

    

// 	Route::get('karyawan-list-pengajuan-cuti', function () {
// 		return view('karyawan.list-pengajuan-cuti');
// 	})->name('list-pengajuan-cuti');


	
    
// 	// Route::get('/user-profile', [InfoUserController::class, 'create']);
// 	// Route::post('/user-profile', [InfoUserController::class, 'store']);
//     Route::get('/login', function () {
// 		return view('dashboard');
// 	})->name('sign-up');
// });



// Route::group(['middleware' => 'guest'], function () {
//     Route::get('/login', [SessionsController::class, 'create']);
//     Route::post('/session', [SessionsController::class, 'store']);
// });

// Route::get('/', function () {
//     return view('session/login-session');
// })->name('login');