@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('extracurricular.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="formPengumuman" method="post"
                    action="{{ route('extracurricular.update', $extracurricular->id) }}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="name" class="float-left">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" autofocus value="{{ $extracurricular->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="description" class="float-left">Deskripsi</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" autofocus
                                value="{{ $extracurricular->description }}">
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="quota" class="float-left">Kuota</label>
                            <input type="number" class="form-control @error('quota') is-invalid @enderror" id="quota"
                                name="quota" autofocus value="{{ $extracurricular->quota }}">
                            @error('quota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="pembina_id">Pembina</label>
                        <select class="form-control choices-multiple @error('pembina_id') is-invalid @enderror"
                            id="pembina_id" name="pembina_id[]" multiple>

                            @foreach ($pembina as $item)
                            <option value="{{ $item->id }}" @if(collect(old('pembina_id', $extracurricular->
                                pembina->pluck('id')->toArray()))->contains($item->id))
                                selected
                                @endif>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('pembina_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (document.querySelector(".choices-multiple")) {
            new Choices(".choices-multiple", {
                removeItemButton: true,
                searchPlaceholderValue: "Cari pembina...",
                placeholder: true,
            });
        }
    });
</script>
@endpush
@endsection
