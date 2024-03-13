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

        $cuti = Cuti::where('karyawan_id', $userId)->get();

        return view('karyawan.pengajuan-cuti-karyawan', compact('cuti'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = $request->user();

        $karyawan = $user->karyawan;

        Cuti::create([
            'alasan_cuti' => $data['alasan_cuti'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'jenis_cuti_id' => $data['jenis_cuti'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'lamanya_cuti' => $data['lamanya_cuti'],
            'karyawan_id' => $user->id,
            'atasan_id' => $karyawan->atasan_id
        ]);

        return redirect()->route('pengajuan-cuti-karyawan');
    }
}
