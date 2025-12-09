@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('pembina.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
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
                        autofocus value="{{ $pembina->name }}" disabled>
                     @error('name')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="email" class="float-left">Email</label>
                     <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" autofocus value="{{ $pembina->email }}" disabled>
                     @error('email')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="role" class="float-left">Role</label>
                     <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                        name="role" autofocus value="{{ $pembina->role }}" disabled>
                     @error('role')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <a href="{{ route('pembina.edit', $pembina->id) }}" class="btn btn-primary">Edit</a>
         </div>
      </div>
   </div>
</div>
@endsection
