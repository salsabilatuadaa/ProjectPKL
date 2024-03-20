<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataCutiKaryawanRequest;
use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanCutiKaryawanController extends Controller
{
    public function create()
    {
    }

    public function show()
    {

        $jenisCuti = JenisCuti::all();

        return view('karyawan.form-pengajuan', compact('jenisCuti'));
    }

    public function showCuti()
    {
        $userId = Auth::id();
        $karyawan = Karyawan::where('user_id', $userId)->first();
        

        if ($karyawan) {

            $karyawanId = $karyawan->id;
            $cuti = Cuti::where('karyawan_id', $karyawanId)
                    ->where('status_id', '3')
                    ->get();

            return view('karyawan.pengajuan-cuti-karyawan', compact('cuti'));
        }
    }

    public function showRiwayat()
    {
        $userId = Auth::id();
        $karyawan = Karyawan::where('user_id', $userId)->first();

        if ($karyawan) {

            $karyawanId = $karyawan->id;
            $cuti = Cuti::where('karyawan_id', $karyawanId)
                    ->where('status_id', '!=', 3)
                    ->get();
        
            return view('karyawan.riwayat-cuti-karyawan', compact('cuti'));
        }
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $user = $request->user();

        $karyawan = $user->karyawan;

        Cuti::create([
            'alasan_cuti' => $data['alasan_cuti'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'jenis_cuti_id' => $data['jenis_cuti_id'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'lamanya_cuti' => $data['lamanya_cuti'],
            'karyawan_id' => $karyawan->id,
            'atasan_id' => $karyawan->atasan_id
            // 'file_persyaratan' => $data[]
        ]);

        
        return redirect()->route('pengajuan-cuti-karyawan');
    }

    public function editDataCuti($id){
        
        $dataCuti = Cuti::find($id);

        $jenisCuti = JenisCuti::all();

        return view('karyawan.form-edit-pengajuan', compact('dataCuti', 'jenisCuti'));
    }

    public function updateDataCuti(Request $request, $id){
        $dataCuti = Cuti::find($id);
        $dataCuti->update($request->all());

        return redirect()->route('pengajuan-cuti-karyawan')->with('success', 'Data Berhasil di Update');

    }

    public function deleteDataCuti($id){

        $dataCuti = Cuti::find($id);
        $dataCuti->delete();

        return redirect()->route('pengajuan-cuti-karyawan');
    }
}
