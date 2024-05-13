@extends('layouts.user_type.auth')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->

                <div class="content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Cuti</h3>
                        </div>
                        <form action="/update-data-cuti-atasan/{{ $dataCuti->id }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jenis_cuti_id">Jenis Cuti</label>
                                    <select name="jenis_cuti_id" class="form-control" id="jenis_cuti_id" required>
                                        <option value="">--Pilih Jenis Cuti--</option>
                                       @foreach($jenisCuti as $cuti)
                                            <option value="{{ $cuti->id }}" style="color: black;" {{ $cuti->id == $dataCuti->jenis_cuti_id ? 'selected' : '' }}>
                                            {{ $cuti->nama_cuti }}</option>
                                       @endforeach
                                    </select>
                                    @error('jenis_cuti_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                

                                <div class="form-group">
                                    <label for="tanggal_cuti">Tanggal Pengajuan Cuti</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_cuti"
                                        value="{{ $dataCuti->tanggal_mulai }}" required>
                                    @error('tanggal_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_cuti">Tanggal Selesai Cuti</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_cuti"
                                        value="{{ $dataCuti->tanggal_selesai }}" required>
                                    @error('tanggal_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lamanya_cuti">Lamanya Cuti (dalam hari)</label>
                                    <input type="number" name="lamanya_cuti" class="form-control" id="lamanya_cuti"
                                        placeholder="Masukkan lamanya cuti dalam hari" value="{{ $dataCuti->lamanya_cuti }}" required>
                                    @error('lamanya_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keperluan_cuti">Keperluan Cuti</label>
                                    <textarea name="alasan_cuti" class="form-control" id="keperluan_cuti" rows="5" placeholder="Masukkan alasan atau keperluan cuti" required>{{ $dataCuti->alasan_cuti }}</textarea>
                                    @error('keperluan_cuti')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- <div class="form-group">
                                    <label for="file_persyaratan">File Submit Persyaratan</label>
                                    <input type="file" name="file_persyaratan" class="form-control-file" id="file_persyaratan">
                                    @error('file_persyaratan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->
                            </div>
       

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
  
  @endsection
