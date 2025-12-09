@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
<a href="{{ route('periode.create') }}" class="btn btn-primary float-end mt-n1">
    <i class="fa fa-plus"></i> Tambah
</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Nama</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th>Aktif</th>
                            <th width="60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periode as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                            <td>{{ $item->is_active ? 'Ya' : 'Tidak' }}</td>
                            <td class="text-nowrap">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-primary"
                                    href="{{ route('periode.show', $item->id) }}" title="Lihat">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-warning"
                                    href="{{ route('periode.edit', $item->id) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('periode.destroy', $item->id) }}" method="post"
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
            {{ $periode->links() }}
        </div>
    </div>
</div>
@endsection
