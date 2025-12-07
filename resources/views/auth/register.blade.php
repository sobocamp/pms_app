@extends('layouts.auth')

@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Buat Akun Baru</h1>
                    <p class="lead">
                        Silakan isi formulir untuk mendaftar.
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                                    <i class="align-middle me-2" data-feather="alert-circle"></i>
                                    <span>Terjadi kesalahan. Periksa kembali input Anda.</span>
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name') }}" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" required>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Daftar
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}">Login di sini</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
