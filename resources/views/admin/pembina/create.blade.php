@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('pembina.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="formPengumuman" method="post" action="{{ route('pembina.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="name" class="float-left">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" autofocus value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="email" class="float-left">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" autofocus value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="password" class="float-left">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" autofocus value="{{ old('password') }}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="role" class="float-left">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role"
                                name="role">
                                <option value="">-- Pilih Role --</option>
                                <option value="pembina" {{ old('role')=='pembina' ? 'selected' : '' }}>Pembina</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
