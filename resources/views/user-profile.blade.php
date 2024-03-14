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
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ __('User') }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ __('Role') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- <div>
                            <label for="user-nip" class="form-control-label">{{ __('NIP') }}</label>
                            <div class="@error('user.nip')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->nip }}" type="text" placeholder="NIP" id="user-nip" name="nip">
                                    @error('nip')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div> -->
                        <div>
                            <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                        <!-- <div>
                            <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div> -->
                        <div>
                            <label for="user.id" class="form-control-label">{{ __('User_ID') }}</label>
                            <div class="@error('user.id')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="id" placeholder="40770888444" id="number" name="id" value="{{ auth()->user()->id }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                        <div>
                            <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                            <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Save Changes') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection