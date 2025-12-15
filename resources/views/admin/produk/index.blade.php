@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
<a href="{{ route('produk.create') }}" class="btn btn-primary float-end mt-n1">
    <i class="fa fa-plus"></i> Tambah
</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('produk.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                class="form-control" placeholder="Cari produk...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>SKU</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th width="60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>
                                @if ($product->status == 'draft')
                                <span class="badge bg-warning">Draft</span>
                                @elseif ($product->status == 'active')
                                <span class="badge bg-success">Active</span>
                                @elseif ($product->status == 'inactive')
                                <span class="badge bg-danger">Inactive</span>
                                @elseif ($product->status == 'discontinued')
                                <span class="badge bg-secondary">Discontinued</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                {{-- View --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-primary"
                                    href="{{ route('produk.show', $product->id) }}" title="Lihat">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-warning"
                                    href="{{ route('produk.edit', $product->id) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('produk.destroy', $product->id) }}" method="post"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                                        class="btn btn-danger btn-sm"
                                        onClick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection
