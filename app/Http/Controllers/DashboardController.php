<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Karyawan;

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
            $tahunSekarang = now()->year;

            $maksimalCuti = 12;

            $karyawan = Karyawan::where('user_id', auth()->id())->first();
            
            if ($karyawan) {
                $totalCutiDiambil = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $totalPengajuanCuti = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->count();

                $totalCutiDisetujui = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 1)
                ->count();

                $totalCutiDitolak = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 2)
                ->count();

                $cutiSakit = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 1)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');;

                $cutiBesar = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 2)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');;

                $cutiTahunan = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 3)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');;

                $cutiMelahirkan = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 4)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');;

                $cutiAlasan = Cuti::where('karyawan_id', $karyawan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 5)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');;

            }   
            
            $sisaCuti = $maksimalCuti - $totalCutiDiambil;

            $tanggalSekarang = now()->toDateString();

            $dataKaryawanCuti = Cuti::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
            ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
            ->get();

            return view('karyawan.dashboard', compact('user','sisaCuti', 'totalCutiDisetujui', 'totalCutiDitolak', 'totalPengajuanCuti', 'cutiSakit', 'cutiBesar','cutiTahunan', 'cutiMelahirkan', 'cutiAlasan', 'dataKaryawanCuti'));
            // return view('karyawan.dashboard', compact('user'));
        } 
    }

   
}
