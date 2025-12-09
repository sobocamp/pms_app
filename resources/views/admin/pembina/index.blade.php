@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
<a href="{{ route('pembina.create') }}" class="btn btn-primary float-end mt-n1">
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
                            <th>Email</th>
                            <th>Mengampu Ekstra</th>
                            <th width="60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembina as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @foreach ($item->extracurricularsHandled as $ekstra)
                                <span class="badge bg-primary">{{ $ekstra->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-nowrap">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-primary"
                                    href="{{ route('pembina.show', $item->id) }}" title="Lihat">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-warning"
                                    href="{{ route('pembina.edit', $item->id) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('pembina.destroy', $item->id) }}" method="post"
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
            {{ $pembina->links() }}
        </div>
    </div>
</div>
@endsection
