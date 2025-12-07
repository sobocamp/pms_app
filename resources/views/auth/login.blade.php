@extends('layouts.auth')

@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Selamat Datang</h1>
                    <p class="lead">Silakan login ke akun Anda</p>
                </div>

                @if (session('status'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">

                            <div class="text-center mb-3">
                                <img src="{{ asset('img/avatars/avatar.jpg') }}" class="img-fluid rounded-circle"
                                    width="100" height="100" />
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Masukkan email" required autofocus>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        type="password" name="password" placeholder="Masukkan password" required>
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <small>
                                        <a href="{{ route('password.request') }}">Lupa password?</a>
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember">
                                        <span class="form-check-label">Ingat saya</span>
                                    </label>
                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
