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
               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="name" class="float-left">Nama</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        autofocus value="{{ $periode->name }}" disabled>
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
                        name="start_date" autofocus value="{{ $periode->start_date }}" disabled>
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
                     <input type="datetime" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                        name="end_date" autofocus value="{{ $periode->end_date }}" disabled>
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
                     <input type="text" class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                        name="is_active" autofocus value="{{ $periode->is_active ? 'Ya' : 'Tidak' }}" disabled>
                     @error('is_active')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <a href="{{ route('periode.edit', $periode->id) }}" class="btn btn-primary">Edit</a>
         </div>
      </div>
   </div>
</div>
@endsection
