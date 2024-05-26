@extends('layouts.user_type.auth')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->

                <div class="content">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Riwayat Cuti</h3>
                            <!-- <a href="{{ route('form-pengajuan') }}" class="btn btn-primary btn-sm float-right">Ajukan Cuti</a> -->
                        </div>
                        <div class="card-body">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                                        <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tipe Cuti</th>
                                        <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                        <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                        <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Status Cuti</th>
                                        <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Verifikasi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cuti as $cuti)
                                        <tr >
                                            <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_pengajuan }}</td>
                                            <td class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->atasan->nama }}</td>
                                            <td class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->jenisCuti->nama_cuti }}</td>
                                            <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_mulai }}</td>
                                            <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_selesai }}</td>
                                            <td class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->statusHR->status}}</td>
                                            <td class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
  
  @endsection
