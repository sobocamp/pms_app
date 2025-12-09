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
               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="name" class="float-left">Nama</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        autofocus value="{{ $extracurricular->name }}" disabled>
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
                     <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" autofocus value="{{ $extracurricular->description }}" disabled>
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
                        name="quota" autofocus value="{{ $extracurricular->quota }}" disabled>
                     @error('quota')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="pembina" class="float-left">Pembina</label>
                     <input type="text" class="form-control @error('pembina') is-invalid @enderror" id="pembina"
                        name="pembina" autofocus value="{{ $extracurricular->pembina->pluck('name')->implode(', ') }}" disabled>
                     @error('pembina')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <a href="{{ route('extracurricular.edit', $extracurricular->id) }}" class="btn btn-primary">Edit</a>
         </div>
      </div>
   </div>
</div>
@endsection
