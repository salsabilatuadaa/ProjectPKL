@extends('layouts.user_type.auth')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->

                <h1 class="m-0">Pengajuan</h1> <br>

                <div class="content">
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Pengajuan</h3>
                            <a href="{{ route('form-pengajuan') }}" class="btn btn-primary btn-sm float-right">Ajukan Cuti</a>
                        </div>
                        <div class="card-body">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                                        <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tipe Cuti</th>
                                        <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                        <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                        <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cuti as $cuti)
                                        <tr >
                                            <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_pengajuan }}</td>
                                            <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">salsabila</td>
                                            <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->jenis_cuti_id }}</td>
                                            <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_mulai }}</td>
                                            <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_selesai }}</td>
                                            <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->status_id}}</td>
                                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                <a href="{{ route('form-pengajuan') }}" class="btn btn-primary btn-sm float-right">Edit</a>
                                            </th>
                                            <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                <a href="{{ route('form-pengajuan') }}" class="btn btn-primary btn-sm float-right">Delete</a>
                                            </th>

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