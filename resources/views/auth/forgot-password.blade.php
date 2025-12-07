@extends('layouts.auth')

@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Lupa Password?</h1>
                    <p class="lead">
                        Masukkan email Anda dan kami akan mengirimkan link reset password.
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">

                            {{-- Alert sukses --}}
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                                    <i class="align-middle me-2" data-feather="check-circle"></i>
                                    <span>{{ session('status') }}</span>
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- Alert error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                                    <i class="align-middle me-2" data-feather="alert-circle"></i>
                                    <span>Periksa kembali input email Anda.</span>
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Kirim Link Reset Password
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}">
                                        <i data-feather="arrow-left" class="align-middle"></i> Kembali ke login
                                    </a>
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
