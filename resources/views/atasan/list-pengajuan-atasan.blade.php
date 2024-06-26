@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <h1 class="m-0">List Pengajuan</h1> <br>
    <div class="content">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">List Pengajuan</h3>
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
                            <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($cuti as $cuti)
                            <tr>
                                <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_pengajuan }}</td>
                                <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->karyawan->nama }}</td>
                                <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->jenisCuti->nama_cuti }}</td>
                                <td class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_mulai }}</td>
                                <td class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->tanggal_selesai }}</td>
                                <td class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">{{ $cuti->statusAtasan->status }}</td>
                                <td class="py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $cuti->id }}">Detail</button>
                                </td>
                                <td class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    <a href="/setujui-pengajuan/{{ $cuti->id }}" class="btn btn-danger btn-sm" onclick="return confirmAction('ACC')">Setuju</a>
                                </td>
                                <td class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    <a href="/tolak-pengajuan/{{ $cuti->id }}" class="btn btn-danger btn-sm" onclick="return confirmAction('Tolak')">Tolak</a>
                                </td>
                            </tr>

                            <script>
                                function confirmAction(action) {
                                    var message = action === 'ACC' ? "Are you sure you want to approve?" : "Are you sure you want to reject?";
                                    return confirm(message);
                                }
                            </script>

                            <!-- Modal -->
                            <div class="modal fade" id="detailModal-{{ $cuti->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $cuti->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel-{{ $cuti->id }}">Detail Pengajuan Cuti</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tanggal Pengajuan:</strong> {{ $cuti->tanggal_pengajuan }}</p>
                                            <p><strong>Nama:</strong> {{ $cuti->karyawan->nama }}</p>
                                            <p><strong>Tipe Cuti:</strong> {{ $cuti->jenisCuti->nama_cuti }}</p>
                                            <p><strong>Tanggal Mulai:</strong> {{ $cuti->tanggal_mulai }}</p>
                                            <p><strong>Tanggal Selesai:</strong> {{ $cuti->tanggal_selesai }}</p>
                                            <p><strong>Status:</strong> {{ $cuti->statusAtasan->status }}</p>
                                            <p><strong>Alasan Cuti:</strong> {{ $cuti->alasan_cuti }}</p>
                                            <p><strong>File Persyaratan</strong></p>
                                            @if($cuti->file_persyaratan)
                                                <div class="mt-3">
                                                    @if(pathinfo($cuti->file_persyaratan, PATHINFO_EXTENSION) == 'pdf')
                                                        <embed src="{{ asset('storage/' . $cuti->file_persyaratan) }}" type="application/pdf" width="100%" height="500px" />
                                                    @else
                                                        <img src="{{ asset('storage/' . $cuti->file_persyaratan) }}" alt="File Persyaratan" width="100%" />
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
