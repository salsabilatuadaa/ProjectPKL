<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListPengajuanCutiAtasanController extends Controller
{
    public function showPengajuan()
    {
        $userId = Auth::id();

        $cuti = Cuti::where('atasan_id', $userId)->get();

        return view('atasan.list-pengajuan-atasan', compact('cuti'));
    }

    public function setujuiPengajuan($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_id = '1';
            $cuti->save();
            return redirect()->back()->with('success', 'Cuti berhasil disetujui.');
        }
    }

    public function tolakPengajuan($id){
        $cuti = Cuti::find($id);

        if($cuti){
            $cuti -> status_id = '2';
            $cuti->save();
            return redirect()->back()->with('success', 'Pengajuan cuti ditolak');
        }
    }
}
