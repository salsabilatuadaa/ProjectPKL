<?php

namespace App\Http\Controllers;

use App\Models\Atasan;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListPengajuanCutiAtasanController extends Controller
{
    public function showPengajuan()
    {
        $userId = Auth::id();
        $atasan = Atasan::where('user_id', $userId)->first();
        

        if ($atasan) {

            $atasanId = $atasan->id;
            $cuti = Cuti::where('atasan_id', $atasanId)
                    ->where('status_atasan', '3')
                    ->get();
        
            return view('atasan.list-pengajuan-atasan', compact('cuti'));
        }
    }

    public function showList()
    {
        $userId = Auth::id();
        $atasan = Atasan::where('user_id', $userId)->first();

        if ($atasan) {

            $atasanId = $atasan->id;
            $cuti = Cuti::where('atasan_id', $atasanId)
                    ->where('status_atasan', '!=', 3)
                    ->get();
        
            return view('atasan.riwayat-verifikasi', compact('cuti'));
        }
    }

    public function setujuiPengajuan($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_atasan = '1';
            $cuti->save();
            return redirect()->back()->with('success', 'Cuti berhasil disetujui.');
        }
    }

    public function tolakPengajuan($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_atasan = '2';
            $cuti -> status_id = '2';
            $cuti->save();
            return redirect()->back()->with('success', 'Pengajuan cuti ditolak');
        }
    }
}
