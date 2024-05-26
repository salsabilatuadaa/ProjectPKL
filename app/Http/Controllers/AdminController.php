<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\CutiAtasan;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showPengajuanAtasan()
    {
        $cuti = Cuti::where('status_atasan', '3')
        ->get();
        
        return view('admin.list-pengajuan-atasan', compact('cuti'));
    
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


    public function showPengajuanHR()
    {
        $cutikaryawan = Cuti::where('status_atasan', '1')
        ->get();

        $cutiatasan = CutiAtasan::where('status_id', '3')
        ->get();
        
        return view('admin.list-pengajuan-hr', compact('cutikaryawan', 'cutiatasan'));
    }


}
