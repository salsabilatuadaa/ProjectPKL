<!-- @extends('layouts.user_type.auth') -->

@section('content')
@if(Auth::check())
    @php
        $karyawan = Auth::user()->karyawan;
        $namaArray = explode(' ', $karyawan->nama);
        $namaDepan = $namaArray[0]; 
    @endphp
    <div class="welcome">
        <h3>Welcome, {{ $namaDepan }}!</h3>
    </div>
@endif

  <div class="row">

    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-7">
              <div class="numbers">
                <p class="text-lg mb-0">Selamat Datang di <span class="font-weight-bold">Sistem Cuti Karyawan!</span></p>
              </div>
            </div>
            <div class="col-5 d-flex align-items-center justify-content-end">
              <a href="{{ route('form-pengajuan') }}" class="btn btn-primary btn-sm font-weight-bold" style="font-size: 15px;">Ajukan Cuti</a>
            </div>            
          </div>
        </div>
      </div>
    </div>      

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Sisa Cuti Tahunan</p>
                <h5 class="font-weight-bolder mb-0">
                 {{ $sisaCuti }}
                  <span class="text-success text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 


  </div>

  <br>

  <div class="row">

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Cuti Disetujui</p>
                <h5 class="font-weight-bolder mb-0">
                  0
                  <span class="text-danger text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-thumbs-up text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Cuti Ditolak</p>
                <h5 class="font-weight-bolder mb-0">
                  0
                  <span class="text-success text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-remove text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengajuan Cuti</p>
                <h5 class="font-weight-bolder mb-0">
                  0
                  <span class="text-success text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-hourglass-end text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <br>

  <div class="row">

    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">

            <div >
              <h3 class="text-lg mb-0 text-capitalize font-weight-bold">Detail Pengajuan Cuti</h3>
            </div>

            <table class="mt-3 w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Jenis Cuti</th>
                        <th class="px-7 py-2 text-left text-sm font-medium text-gray-500">Total Diambil (hari)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2">Cuti Sakit</td>
                        <td class="px-7 py-2">0</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Cuti Besar</td>
                        <td class="px-7 py-2">0</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Cuti Tahunan</td>
                        <td class="px-7 py-2">0</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Cuti Melahirkan</td>
                        <td class="px-7 py-2">0</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Cuti Alasan Penting</td>
                        <td class="px-7 py-2">0</td>
                    </tr>
                    <!-- Tambahkan baris lain sesuai dengan kebutuhan -->
                </tbody>
            </table>

        </div>
      </div>
    </div>      

  </div>

  <br>

  <div class="content-wrapper">
    <div class="content">
        <div class="card card-primary">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Status Pengajuan Cuti</h3>
            </div>

            <div class="card-body">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                          <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                          <!-- <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Nama</th> -->
                          <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tipe Cuti</th>
                          <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                          <th class="px-5 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                          <th class="px-3 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Status</th>
                          <th class="px-4 py-3 text-left text-xl font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
  </div>

@endsection
