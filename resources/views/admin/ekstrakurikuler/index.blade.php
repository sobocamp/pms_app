@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
<a href="{{ route('extracurricular.create') }}" class="btn btn-primary float-end mt-n1">
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
                            {{-- <th>Deskripsi</th> --}}
                            <th>Pembina</th>
                            <th width="20px;">Kuota</th>
                            <th width="60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extracurriculars as $ekstra)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ekstra->name }}</td>
                            {{-- <td>{{ $ekstra->description }}</td> --}}
                            <td>
                                @foreach($ekstra->pembina as $pb)
                                <span class="badge bg-primary">{{ $pb->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $ekstra->quota }}</td>
                            <td class="text-nowrap">
                                {{-- View --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-primary"
                                    href="{{ route('extracurricular.show', $ekstra->id) }}" title="Lihat">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-warning"
                                    href="{{ route('extracurricular.edit', $ekstra->id) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('extracurricular.destroy', $ekstra->id) }}" method="post"
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
            {{ $extracurriculars->links() }}
        </div>
    </div>
</div>
@endsection
