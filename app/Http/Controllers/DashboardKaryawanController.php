<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;

class DashboardKaryawanController extends Controller
{
    public function sisaCuti(){
        
        $tahunSekarang = now()->year;

        $maksimalCuti = 12;

        $totalCutiDiambil = Cuti::where('karyawan_id', auth()->id())
            ->whereYear('created_at', $tahunSekarang)
            ->sum('lamanya_cuti');

        $sisaCuti = $maksimalCuti - $totalCutiDiambil;

        return view('karyawan.dashboard', compact('sisaCuti'));
    }
}
