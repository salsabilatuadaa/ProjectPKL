@extends('layouts.user_type.auth')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->

                <h1 class="m-0">Pengajuan</h1> <br>

                <div class="content">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Cuti</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="/tambah-mahasiswa" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nip">NIP *</label>
                                    <input type="text" name="nip" class="form-control" id="nim"
                                        placeholder="Masukkan NIP" value="{{ old('nip') }}" required pattern="[0-9]">
                                    <!-- <small class="text-muted">Harap masukkan hanya angka.</small> -->
                                    @error('nip')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_cuti">Jenis Cuti *</label>
                                    <select name="jenis_cuti" class="form-control" id="jenis_cuti" required>
                                        <option value="">--Pilih Jenis Cuti--</option>
                                        <option value="Cuti Sakit">Cuti Sakit</option>
                                        <option value="Cuti Besar">Cuti Besar</option>
                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                        <option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
                                      
                                    </select>
                                    @error('jenis_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_cuti">Tanggal Diajukan Cuti *</label>
                                    <input type="date" name="tanggal_cuti" class="form-control" id="tanggal_cuti"
                                        value="{{ old('tanggal_cuti') }}" required>
                                    @error('tanggal_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lamanya_cuti">Lamanya Cuti (dalam hari) *</label>
                                    <input type="number" name="lamanya_cuti" class="form-control" id="lamanya_cuti"
                                        placeholder="Masukkan lamanya cuti dalam hari" value="{{ old('lamanya_cuti') }}" required>
                                    @error('lamanya_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keperluan_cuti">Keperluan Cuti *</label>
                                    <textarea name="keperluan_cuti" class="form-control" id="keperluan_cuti" rows="5" placeholder="Masukkan alasan atau keperluan cuti" required>{{ old('keperluan_cuti') }}</textarea>
                                    @error('keperluan_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="file_persyaratan">File Submit Persyaratan</label>
                                    <input type="file" name="file_persyaratan" class="form-control-file" id="file_persyaratan">
                                    @error('file_persyaratan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <!-- <div class="form-group">
                                    <label for="nama">Tanggal DIajukan Cuti</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->

                                <!-- <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <select name="angkatan" class="form-control" id="angkatan">
                                        <option value="" selected disabled>-- Pilih Angkatan --</option>
                                        
                                    </select>
                                    @error('angkatan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->

                                <!-- <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" class="form-control" id="status" value="Aktif"
                                        disabled>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label for="dosen_wali">Dosen Wali</label>
                                    <select name="dosen_wali" id="dosen_wali" class="form-control">
                                        <option value="" selected disabled>-- Pilih Dosen Wali --</option>
                                        
                                    </select>
                                    @error('dosen_wali')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <!-- <a href="/operator/impor-excel" onclick="showFileUpload()" class="btn btn-success">Impor
                                    dari Excel</a>
                                <a href="/dashboard" class="btn btn-secondary ml-2">Back</a> -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
                <br>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  
  @endsection
