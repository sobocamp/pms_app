@extends('layouts.template')

@section('title', $title)

@section('content')
<style>
    p {
        margin: 0;
    }
</style>
{{-- <a href="{{ route('extracurricular.siswa', auth()->user()->id) }}" class="btn btn-primary float-end mt-n1">
    <i class="fa fa-eye"></i> Lihat Ekstrakurikuler Saya
</a> --}}
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}<b> {{ $extracurricular->name }} </b></h1>
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
                            <th width="100px;">Status</th>
                            <th width="120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extracurricular->participants as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->pivot->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif ($item->pivot->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @elseif ($item->pivot->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a onclick="return confirm('Yakin ingin menyetujui pendaftaran ini?')"
                                    data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-primary"
                                    href="{{ route('extracurricular.approve', ['id' => $extracurricular->id, 'user_id' => $item->id]) }}"
                                    title="Approve">
                                    <i data-feather="check-circle"></i>
                                </a>
                                <a onclick="return confirm('Yakin ingin menunda pendaftaran ini?')"
                                    data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-warning"
                                    href="{{ route('extracurricular.pending', ['id' => $extracurricular->id, 'user_id' => $item->id]) }}"
                                    title="Pending">
                                    <i data-feather="minus-circle"></i>
                                </a>
                                <a onclick="return confirm('Yakin ingin menolak pendaftaran ini?')"
                                    data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-danger"
                                    href="{{ route('extracurricular.reject', ['id' => $extracurricular->id, 'user_id' => $item->id]) }}"
                                    title="Reject">
                                    <i data-feather="x-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{-- {{ $peserta->links() }} --}}
        </div>
    </div>
</div>
@endsection
