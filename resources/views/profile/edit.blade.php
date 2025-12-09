@extends('layouts.template')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?size=110&name={{ Auth::user()->name }}" class="rounded-circle mb-3" alt="Avatar">

                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                <small class="text-muted">{{ Auth::user()->email }}</small>

                <hr>

                <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 mt-2">
                    <i data-feather="arrow-left" class="me-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-8">
        {{-- Update Data User --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Profil</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Hapus Akun --}}
        <div class="card bg-light border-danger">
            <div class="card-header border-danger">
                <h5 class="card-title text-danger mb-0">Hapus Akun</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Menghapus akun akan menghapus seluruh data terkait dan tindakan ini tidak dapat dikembalikan.
                </p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
