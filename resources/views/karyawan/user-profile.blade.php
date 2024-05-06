@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4 bg-gradient-primary">
            <span class="mask opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    @foreach($karyawan as $krywn)
                        <h5 class="mb-1">
                            {{ $krywn->nama }}
                        </h5>
                    @endforeach
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ __('Karyawan') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @if($karyawan->isEmpty() || is_null($karyawan->first()->nip))
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Profile Information</h6>
            </div>
            
            <div class="card-body pt-4 p-3">
                <form action="{{ route('simpan-profile') }}" method="POST" role="form text-left">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nip" class="form-control-label">NIP</label>
                            <div class="@error('nip')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="" type="text" placeholder="NIP" id="nip" name="nip" required>
                                    @error('nip')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                        <div>
                            <label for="name" class="form-control-label">Full Name</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="" type="text" placeholder="Name" id="nama" name="nama" required>
                                    @error('nama')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                        <div>
                            <label for="email" class="form-control-label">Email</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="email" name="email" required disabled>
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>

                        <div>
                            <label for="role" class="form-control-label">Role</label>
                            <div class="@error('role')border border-danger rounded-3 @enderror">
                                <select class="form-control" type="role" id="role" name="role" required disabled>
                                    <option value="">--Pilih Role--</option>
                                        @foreach($role as $jabatan)
                                            <option value="{{ $jabatan->id }}" style="color: black;" {{ $jabatan->id == $user->role ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}</option>
                                       @endforeach
                                </select>

                                @error('role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="atasan_id" class="form-control-label">Atasan</label>
                            <div class="@error('atasan_id')border border-danger rounded-3 @enderror">
                                <select class="form-control" type="atasan_id" id="atasan_id" name="atasan_id" required>
                                    <option value="">--Pilih Atasan--</option>
                                        @foreach($atasan as $ats)
                                            <option value="{{ $ats->id }}" style="color: black;" {{ $ats->id == $user->user_id ? 'selected' : '' }}>
                                            {{ $ats->nama }}</option>
                                       @endforeach
                                </select>

                                @error('atasan_id')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="lokasi_kerja" class="form-control-label">Lokasi Kerja</label>
                            <div class="@error('lokasi_kerja')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="" type="lokasi" id="lokasi_kerja" name="lokasi_kerja" required>
                                    @error('lokasi')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>

                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Save Changes</button>
                    </div>
                    
                </form>

            </div>
        </div>
    </div>

    @else
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Profile Information</h6>
            </div>
            @foreach($karyawan as $krywn)
            <div class="card-body pt-4 p-3">
                <!-- <form action="{{ route('simpan-profile') }}" method="POST" role="form text-left"> -->
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nip" class="form-control-label">NIP</label>
                            <div class="@error('nip')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $krywn->nip }}" style="color: black;" type="text" placeholder="NIP" id="nip" name="nip" required disabled>
                                    @error('nip')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                        <div>
                            <label for="email" class="form-control-label">Email</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->email }}" style="color: black;" type="email" placeholder="@example.com" id="email" name="email" required disabled>
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>

                        <div>
                            <label for="role" class="form-control-label">Role</label>
                            <div class="@error('role')border border-danger rounded-3 @enderror">
                                <select class="form-control" type="role" id="role" name="role" required disabled>
                                    <option value="">--Pilih Role--</option>
                                        @foreach($role as $jabatan)
                                            <option value="{{ $jabatan->id }}" style="color: black;" {{ $jabatan->id == $user->role ? 'selected' : '' }}>
                                            {{ $jabatan->nama_jabatan }}</option>
                                       @endforeach
                                </select>

                                @error('role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="atasan_id" class="form-control-label">Atasan</label>
                            <div class="@error('atasan_id')border border-danger rounded-3 @enderror">
                                <select class="form-control" type="atasan_id" id="atasan_id" name="atasan_id" required disabled>
                                    <option value="">--Pilih Atasan--</option>
                                        @foreach($atasan as $ats)
                                            <option value="{{ $ats->id }}" style="color: black;" {{ $ats->id == $krywn->atasan_id ? 'selected' : '' }}>
                                            {{ $ats->nama }}</option>
                                       @endforeach
                                </select>

                                @error('atasan_id')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="lokasi_kerja" class="form-control-label">Lokasi Kerja</label>
                            <div class="@error('lokasi_kerja')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $krywn->lokasi_kerja }}" style="color: black;" type="lokasi" id="lokasi_kerja" name="lokasi_kerja" required disabled>
                                    @error('lokasi')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>

                    </div>
                    
                    <div class="flex justify-end">
                        <a href="/edit-profile/" class="btn bg-gradient-dark btn-md mt-4 mb-4">Edit</a>
                    </div>

                    
                </form>

            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
