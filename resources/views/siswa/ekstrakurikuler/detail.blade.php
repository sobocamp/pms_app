@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('extracurricular') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
    <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="h6 card-title">Ekstrakurikuler</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span data-feather="activity" class="feather-sm me-1"></span> {{
                        $extracurricular->name }}
                    </li>

                    <li class="mb-1"><span data-feather="users" class="feather-sm me-1"></span> Kuota (<b>{{
                            $extracurricular->quota }}</b>)
                    </li>
                </ul>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Deskripsi</h5>
                <p>{{ $extracurricular->description }}</p>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Pembina</h5>
                @foreach ($extracurricular->pembina as $item)
                <span class="badge bg-primary me-1 my-1">{{ $item->name }}</span>
                @endforeach
            </div>

        </div>
    </div>

    <div class="col-md-6 col-xl-8">
        <div class="card">
            <div class="card-body">
                <h5 class="h6 card-title">Siswa Terdaftar</h5>
                <div class="row">
                    <div class="mb-3">
                        @if ($extracurricular->participants->count() > 0)
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($extracurricular->participants as $peserta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peserta->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <div class="alert-message">
                                Belum ada siswa terdaftar pada ekstrakurikuler ini
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if ($registered)
                <form action="{{ route('extracurricular.unregister', $extracurricular->id) }}" method="post"
                    onsubmit="return confirm('Anda yakin ingin membatalkan pendaftaran pada ekstrakurikuler ini?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Batalkan Pendaftaran</button>
                </form>
                @else
                @if ($extracurricular->approvedParticipants->count() >= $extracurricular->quota)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-message">
                        Kuota untuk ekstrakurikuler ini sudah penuh
                    </div>
                </div>
                @else
                <form action="{{ route('extracurricular.register', $extracurricular->id) }}" method="post"
                    onsubmit="return confirm('Anda yakin ingin mendaftar ekstrakurikuler ini?');">
                    @csrf
                    <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                </form>
                @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
