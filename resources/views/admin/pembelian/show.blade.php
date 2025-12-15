@extends('layouts.template')

@section('title', $title)

@section('content')
<a href="{{ route('pembelian.index') }}" class="btn btn-danger float-end mt-n1">Kembali</a>
<div class="mb-3">
   <h1 class="h3 d-inline align-middle">{{ $title }}</h1>
</div>

<div class="row">
   <div class="col-12 col-xl-12">
      <div class="card">
         <div class="card-body">
               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="purchase_number" class="float-left">No. Pembelian</label>
                     <input type="text" class="form-control @error('purchase_number') is-invalid @enderror" id="purchase_number" name="purchase_number"
                        autofocus value="{{ $pembelian->purchase_number }}" disabled>
                     @error('purchase_number')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="purchase_date" class="float-left">Tanggal</label>
                     <input type="datetime" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date"
                        name="purchase_date" autofocus value="{{ $pembelian->purchase_date }}" disabled>
                     @error('purchase_date')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="supplier" class="float-left">Supplier</label>
                     <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier"
                        name="supplier" autofocus value="{{ $pembelian->supplier }}" disabled>
                     @error('supplier')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <button class="btn btn-sm btn-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#itemPembelian" aria-expanded="false" aria-controls="itemPembelian">
                  <i class="fa fa-eye"></i> Lihat Item Pembelian
               </button>

               <div class="collapse" id="itemPembelian">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Produk</th>
                           <th width="150">Qty</th>
                           <th width="200">Harga</th>
                           <th width="200">Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($pembelian->purchaseItems as $item)
                        <tr>
                           <td>{{ $item->product->name }}</td>
                           <td>{{ $item->quantity }}</td>
                           <td>{{ number_format($item->price) }}</td>
                           <td>{{ number_format($item->subtotal) }}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>

               <div class="row">
                  <div class="mb-3">
                     <label class="form-label" for="total" class="float-left">Total</label>
                     <input type="text" class="form-control @error('total') is-invalid @enderror" id="total"
                        name="total" autofocus value="{{ number_format($pembelian->total) }}" disabled>
                     @error('total')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>

               <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-primary">Edit</a>
         </div>
      </div>
   </div>
</div>
@endsection
