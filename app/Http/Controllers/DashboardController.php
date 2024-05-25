<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\Atasan;
use App\Models\CutiAtasan;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user->role === 1) {
            $tahunSekarang = now()->year;

            $tanggalSekarang = now()->toDateString();

            $dataKaryawanCuti = Cuti::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
            ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
            ->where('status_id', 1)
            ->get();

            $dataAtasanCuti = CutiAtasan::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
            ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
            ->where('status_id', 1)
            ->get();

            $karyawanCutiTerbanyak = Cuti::select('karyawan_id', DB::raw('SUM(lamanya_cuti) as total_cuti')) 
            ->whereYear('tanggal_selesai', $tahunSekarang)
            ->where('status_id', 1)
            ->groupBy('karyawan_id')
            ->orderBy('total_cuti', 'DESC')
            ->with('karyawan') 
            ->take(5)
            ->get();

            return view('kepegawaian.dashboard', compact('user', 'dataKaryawanCuti', 'dataAtasanCuti', 'karyawanCutiTerbanyak'));
        }else if($user->role === 2){
            return view('admin.dashboard', compact('user'));
        } else if ($user->role === 3) {
            $tahunSekarang = now()->year;

            $maksimalCuti = 12;

            $atasan = Atasan::where('user_id', auth()->id())->first();

            if($atasan) {
                $totalCutiDiambil = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $totalPengajuanCuti = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->count();

                $totalCutiDisetujui = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 1)
                ->count();

                $totalCutiDitolak = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('status_id', 2)
                ->count();

                $cutiSakit = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 1)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $cutiBesar = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 2)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $cutiTahunan = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 3)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $cutiMelahirkan = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 4)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');

                $cutiAlasan = CutiAtasan::where('atasan_id', $atasan->id)
                ->whereYear('tanggal_selesai', $tahunSekarang)
                ->where('jenis_cuti_id', 5)
                ->where('status_id', 1)
                ->sum('lamanya_cuti');
                
            }

            $sisaCuti = $maksimalCuti - $totalCutiDiambil;

            $tanggalSekarang = now()->toDateString();

            $dataKaryawanCuti = Cuti::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
            ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
            ->where('status_id', 1)
            ->get();

            $dataAtasanCuti = CutiAtasan::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
            ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
            ->where('status_id', 1)
            ->get();

            $karyawanCutiTerbanyak = Cuti::select('karyawan_id', DB::raw('SUM(lamanya_cuti) as total_cuti')) 
            ->whereYear('tanggal_selesai', $tahunSekarang)
            ->where('status_id', 1)
            ->groupBy('karyawan_id')
            ->orderBy('total_cuti', 'DESC')
            ->with('karyawan') 
            ->take(5)
            ->get();

            return view('atasan.dashboard', compact('user', 'sisaCuti', 'totalCutiDisetujui', 'totalCutiDitolak', 'totalPengajuanCuti', 'cutiSakit', 'cutiBesar','cutiTahunan', 'cutiMelahirkan', 'cutiAlasan', 'dataKaryawanCuti', 'dataAtasanCuti', 'karyawanCutiTerbanyak'));


        } else if ($user->role === 4) {

            $karyawan = Karyawan::where('user_id', auth()->id())->first();

            if ($karyawan && empty($karyawan->nip)) {
                return redirect()->route('karyawan.user-profile'); // Ubah ini ke route halaman isi profil Anda
            }
            else{
                $tahunSekarang = now()->year;

                $maksimalCuti = 12;

                $totalCutiDiambil = 0;
                $totalPengajuanCuti = 0;
                $totalCutiDisetujui = 0;
                $totalCutiDitolak = 0;
                $cutiSakit = 0;
                $cutiBesar = 0;
                $cutiTahunan = 0;
                $cutiMelahirkan = 0;
                $cutiAlasan = 0;

                
                if ($karyawan) {
                    $totalCutiDiambil = Cuti::where('karyawan_id', $karyawan->id)
                    ->whereYear('tanggal_selesai', $tahunSekarang)
                    ->where('status_id', 1)
                    ->sum('lamanya_cuti') ?? 0;

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
                    ->sum('lamanya_cuti');

                    $cutiBesar = Cuti::where('karyawan_id', $karyawan->id)
                    ->whereYear('tanggal_selesai', $tahunSekarang)
                    ->where('jenis_cuti_id', 2)
                    ->where('status_id', 1)
                    ->sum('lamanya_cuti');

                    $cutiTahunan = Cuti::where('karyawan_id', $karyawan->id)
                    ->whereYear('tanggal_selesai', $tahunSekarang)
                    ->where('jenis_cuti_id', 3)
                    ->where('status_id', 1)
                    ->sum('lamanya_cuti');

                    $cutiMelahirkan = Cuti::where('karyawan_id', $karyawan->id)
                    ->whereYear('tanggal_selesai', $tahunSekarang)
                    ->where('jenis_cuti_id', 4)
                    ->where('status_id', 1)
                    ->sum('lamanya_cuti');

                    $cutiAlasan = Cuti::where('karyawan_id', $karyawan->id)
                    ->whereYear('tanggal_selesai', $tahunSekarang)
                    ->where('jenis_cuti_id', 5)
                    ->where('status_id', 1)
                    ->sum('lamanya_cuti');

                }   
                
                $sisaCuti = $maksimalCuti - $totalCutiDiambil;

                $tanggalSekarang = now()->toDateString();

                $dataKaryawanCuti = Cuti::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
                ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
                ->where('status_id', 1)
                ->get();

                $dataAtasanCuti = CutiAtasan::whereDate('tanggal_mulai', '<=', $tanggalSekarang)
                ->whereDate('tanggal_selesai', '>=', $tanggalSekarang)
                ->where('status_id', 1)
                ->get();

                return view('karyawan.dashboard', compact('user','sisaCuti', 'totalCutiDisetujui', 'totalCutiDitolak', 'totalPengajuanCuti', 'cutiSakit', 'cutiBesar','cutiTahunan', 'cutiMelahirkan', 'cutiAlasan', 'dataKaryawanCuti', 'dataAtasanCuti'));
                // return view('karyawan.dashboard', compact('user'));
                }
        } 
    }

   
}
