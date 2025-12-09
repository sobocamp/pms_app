@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('periode.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="formPengumuman" method="post" action="{{ route('periode.store') }}">
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
                            <label class="form-label" for="start_date" class="float-left">Mulai</label>
                            <input type="datetime" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                name="start_date" autofocus value="{{ old('start_date') }}">
                            @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="end_date" class="float-left">Akhir</label>
                            <input type="datetime" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" autofocus value="{{ old('end_date') }}">
                            @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="is_active" class="float-left">Aktif</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active"
                                name="is_active">
                                <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ old('is_active')=='1' ? 'selected' : '' }}>Ya</option>
                            </select>
                            @error('is_active')
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
