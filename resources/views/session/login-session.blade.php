@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0" style="background-image: url('../assets/img/Diskominfo.png'); background-size: cover; background-position: center; height: 100vh;">
    <section style="background-color: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px); height: 100%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder" style="color: #B31312;">Sistem Cuti Online</h3>
                            <h3 class="font-weight-bolder" style="color: #B31312;">Diskominfo Kota Semarang</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" method="POST" action="/session">
                                @csrf
                                <label>Email</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn text-white w-100 mt-4 mb-0" style="background-color: #B31312;">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection