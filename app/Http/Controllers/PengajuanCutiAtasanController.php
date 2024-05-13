<?php

namespace App\Http\Controllers;
use App\Models\CutiAtasan;
use App\Models\JenisCuti;
use App\Models\Atasan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PengajuanCutiAtasanController extends Controller
{

    public function show()
    {

        $jenisCuti = JenisCuti::all();

        return view('atasan.form-pengajuan-atasan', compact('jenisCuti'));
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $user = $request->user();

        $atasan = $user->atasan;

        CutiAtasan::create([
            'alasan_cuti' => $data['alasan_cuti'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'jenis_cuti_id' => $data['jenis_cuti_id'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'lamanya_cuti' => $data['lamanya_cuti'],
            'atasan_id' => $atasan->id
            // 'file_persyaratan' => $data[]
        ]);

        
        return redirect()->route('pengajuan-cuti-atasan');
    }



    public function showCuti()
    {
        $userId = Auth::id();
        $atasan = Atasan::where('user_id', $userId)->first();
        

        if ($atasan) {

            $atasanId = $atasan->id;
            $cuti = CutiAtasan::where('atasan_id', $atasanId)
                    ->where('status_id', '3')
                    ->get();

            return view('atasan.pengajuan-cuti-atasan', compact('cuti'));
        }
    }


    public function editDataCuti($id){
        
        $dataCuti = CutiAtasan::find($id);

        $jenisCuti = JenisCuti::all();

        return view('atasan.form-edit-pengajuan-atasan', compact('dataCuti', 'jenisCuti'));
    }

    public function updateDataCuti(Request $request, $id){
        $dataCuti = CutiAtasan::find($id);
        $dataCuti->update($request->all());

        return redirect()->route('pengajuan-cuti-atasan')->with('success', 'Data Berhasil di Update');

    }

    public function deleteDataCuti($id){

        $dataCuti = CutiAtasan::find($id);
        $dataCuti->delete();

        return redirect()->route('pengajuan-cuti-atasan');
    }

    public function showRiwayat()
    {
        $userId = Auth::id();
        $atasan = Atasan::where('user_id', $userId)->first();

        if ($atasan) {

            $atasanId = $atasan->id;
            $cuti = CutiAtasan::where('atasan_id', $atasanId)
                    ->where('status_id', '!=', 3)
                    ->get();
        
            return view('atasan.riwayat-cuti-atasan', compact('cuti'));
        }
    }


}
