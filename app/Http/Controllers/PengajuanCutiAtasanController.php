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
        $request->validate([
            'jenis_cuti_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lamanya_cuti' => 'required|integer|min:1',
            'alasan_cuti' => 'required',
        ]);
    
        $jenisCuti = JenisCuti::findOrFail($request->jenis_cuti_id);
        if ($jenisCuti->nama_cuti == 'Cuti Sakit') {
            if ($request->lamanya_cuti > 2) {
                return back()->withErrors(['lamanya_cuti' => 'Cuti sakit maksimal hanya dapat dua hari.'])->withInput();
            }
        }

        $data = $request->all();

        $user = $request->user();

        $atasan = $user->atasan;

        if ($request->hasFile('file_persyaratan')) {
            $filePath = $request->file('file_persyaratan')->store('persyaratan', 'public');
            $data['file_persyaratan'] = $filePath;
        } else {
            $data['file_persyaratan'] = null;
        }

        CutiAtasan::create([
            'alasan_cuti' => $data['alasan_cuti'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'jenis_cuti_id' => $data['jenis_cuti_id'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'lamanya_cuti' => $data['lamanya_cuti'],
            'atasan_id' => $atasan->id,
            'file_persyaratan' => $data['file_persyaratan']
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
        
        $request->validate([
            'jenis_cuti_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lamanya_cuti' => 'required|integer|min:1',
            'alasan_cuti' => 'required',
        ]);
    
        $jenisCuti = JenisCuti::findOrFail($request->jenis_cuti_id);
        if ($jenisCuti->nama_cuti == 'Cuti Sakit') {
            if ($request->lamanya_cuti > 2) {
                return back()->withErrors(['lamanya_cuti' => 'Cuti sakit maksimal hanya dapat dua hari.'])->withInput();
            }
        }

        $dataCuti = CutiAtasan::find($id);
        $dataCuti->update($request->all());

        return redirect()->route('pengajuan-cuti-atasan')->with('success', 'Data Berhasil di Update');

    }

    public function cancelDataCuti($id){

        $dataCuti = CutiAtasan::find($id);

        if($cuti){
            $cuti -> status_id = '4';
            $cuti -> status_atasan = '4';
            $cuti -> aktor = '3';
            $cuti->save();
            return redirect()->route('pengajuan-cuti-atasan');
        }

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
