<?php

namespace App\Http\Controllers;
use App\Models\Kepegawaian;
use App\Models\Cuti;
use App\Models\CutiAtasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListPengajuanCutiHRController extends Controller
{
    public function showPengajuanHR()
    {
        $userId = Auth::id();
        $HR = Kepegawaian::where('user_id', $userId)->first();
        

        if ($HR) {

            $cutikaryawan = Cuti::where('status_atasan', '1')
            ->get();

            $cutiatasan = CutiAtasan::where('status_id', '3')
            ->get();
        
            return view('kepegawaian.list-pengajuan-hr', compact('cutikaryawan', 'cutiatasan'));
        }
    }

    public function showListHR()
    {
        $userId = Auth::id();
        $HR = Kepegawaian::where('user_id', $userId)->first();

        if ($HR) {

            $cuti = Cuti::where('status_id', '!=', 3)
                    ->get();
        
            return view('kepegawaian.riwayat-verifikasi-hr', compact('cuti'));
        }
    }

    public function setujuiPengajuanHR($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_id = '1';
            $cuti->save();
            return redirect()->back()->with('success', 'Cuti berhasil disetujui.');
        }
    }

    public function tolakPengajuanHR($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_id = '2';
            $cuti->save();
            return redirect()->back()->with('success', 'Pengajuan cuti ditolak');
        }
    }
}
