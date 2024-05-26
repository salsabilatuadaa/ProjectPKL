@extends('layouts.user_type.auth')

@section('content')

@if(Auth::check())
    @php
        $hr = Auth::user()->admin;
        $namaArray = explode(' ', $hr->nama);
        $namaDepan = $namaArray[0]; 
    @endphp
    <div class="welcome">
        <h3>Welcome, {{ $namaDepan }}!</h3>
    </div>
@endif

<div class="row">

    <div class="col-xl-5 col-sm-5 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">List Karyawan Cuti Terbanyak</h3>
            </div>

            <table class=" w-full">
                <thead>
                  <tr>
                      <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                      <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Total Cuti (hari)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $karyawanCutiTerbanyak as $cutiterbanyak)
                        <tr>
                            <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cutiterbanyak->karyawan->nama }}</th>
                            <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cutiterbanyak->total_cuti }}</th>
                        </tr>
                        @endforeach
                </tbody>
            </table>

        </div>
      </div>
    </div>  
    
    <div class="col-xl-7 col-sm-7 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Karyawan Cuti</h3>
            </div>

            @if($dataAtasanCuti->isEmpty() && $dataKaryawanCuti->isEmpty())
              <h5 class="text-center ">Tidak ada yang melakukan cuti hari ini</p>
            @else
                <table class="min-w-full divide-y ">
                    <thead class="">
                        <tr>
                          <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                          <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tipe Cuti</th>
                          <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                          <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="">
                      @foreach( $dataAtasanCuti as $cuti)
                        <tr>
                          <th class="px-4 py-3 ">{{ $cuti->atasan->nama }}</th>
                          <th class="px-5 py-3 ">{{ $cuti->jenisCuti->nama_cuti }}</th>
                          <th class="px-4 py-3 ">{{ $cuti->tanggal_mulai }}</th>
                          <th class="px-5 py-3 ">{{ $cuti->tanggal_selesai }}</th>
                        </tr>
                      @endforeach
                      @foreach( $dataKaryawanCuti as $cuti)
                        <tr>
                          <th class="px-4 py-3 ">{{ $cuti->karyawan->nama }}</th>
                          <th class="px-5 py-3 ">{{ $cuti->jenisCuti->nama_cuti }}</th>
                          <th class="px-4 py-3 ">{{ $cuti->tanggal_mulai }}</th>
                          <th class="px-5 py-3 ">{{ $cuti->tanggal_selesai }}</th>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            @endif

        </div>
      </div>
    </div> 

    <br>
  </div>
@endsection
