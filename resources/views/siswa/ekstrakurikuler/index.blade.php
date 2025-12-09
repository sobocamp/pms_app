@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
<a href="{{ route('extracurricular') }}" class="btn btn-primary float-end mt-n1">
    <i class="fa fa-eye"></i> Semua Ekstrakurikuler
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
                            <th>Deskripsi</th>
                            <th>Pembina</th>
                            <th width="100px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extracurriculars as $ekstra)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $ekstra->name }}</td>
                            <td>{{ $ekstra->description }}</td>
                            <td>
                                @foreach($ekstra->pembina as $pb)
                                <span class="badge bg-primary">{{ $pb->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @php
                                $status = $ekstra->participants->where('id', Auth::user()->id)->first()->pivot->status
                                @endphp
                                @if ($status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif ($status == 'approved')
                                <span class="badge bg-success">Diterima</span>
                                @elseif ($status == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
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
