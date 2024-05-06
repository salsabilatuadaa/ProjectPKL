<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user->role === 1) {
            return view('kepegawaian.dashboard', compact('user'));
        }else if($user->role === 2){
            return view('admin.dashboard', compact('user'));
        } else if ($user->role === 3) {
            return view('atasan.dashboard', compact('user'));
        } else if ($user->role === 4) {
            return view('karyawan.dashboard', compact('user'));
        } 
    }

    // public function sisaCuti()
    // {
    //     $tahunSekarang = now()->year;

    //     $maksimalCuti = 12;

    //     $totalCutiDiambil = Cuti::where('user_id', auth()->id())
    //         ->whereYear('created_at', $tahunSekarang)
    //         ->sum('lamanya_cuti');

    //     $sisaCuti = $maksimalCuti - $totalCutiDiambil;

    //     return view('karyawan.dashboard', compact('sisaCuti'));

    // }
}
