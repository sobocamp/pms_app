@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('produk.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="formPengumuman" method="post"
                    action="{{ route('produk.update', $product->id) }}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="sku" class="float-left">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku"
                                name="sku" autofocus value="{{ $product->sku }}">
                            @error('sku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="name" class="float-left">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" autofocus value="{{ $product->name }}">
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
                                value="{{ $product->description }}">
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="brand" class="float-left">Brand</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand"
                                name="brand" autofocus value="{{ $product->brand }}">
                            @error('brand')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status" class="float-left">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">-- Pilih Status --</option>
                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="discontinued" {{ $product->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                        </select>
                        @error('status')
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
        if (document.querySelector("#status")) {
            new Choices("#status", {
                removeItemButton: true,
                searchPlaceholderValue: "Cari status...",
                placeholder: true,
            });
        }
    });
</script>
@endpush
@endsection
