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
                <form id="formPengumuman" method="post" action="{{ route('pembelian.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="purchase_number" class="float-left">No. Pembelian</label>
                            <input type="text" class="form-control @error('purchase_number') is-invalid @enderror"
                                id="purchase_number" name="purchase_number" autofocus
                                value="{{ old('purchase_number') }}">
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
                            <input type="datetime" class="form-control @error('purchase_date') is-invalid @enderror"
                                id="purchase_date" name="purchase_date" autofocus value="{{ old('purchase_date') }}">
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
                            <input type="text" class="form-control @error('supplier') is-invalid @enderror"
                                id="supplier" name="supplier" autofocus value="{{ old('supplier') }}">
                            @error('supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5>Item Pembelian</h5>

                        <table class="table table-bordered" id="items-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th width="150">Qty</th>
                                    <th width="200">Harga</th>
                                    <th width="200">Subtotal</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <button type="button" class="btn btn-sm btn-success" id="add-item">
                            + Tambah Produk
                        </button>
                    </div>


                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="total" class="float-left">Total</label>
                            <input type="text" class="form-control @error('total') is-invalid @enderror" id="total"
                                name="total" autofocus value="{{ old('total') }}">
                            @error('total')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<template id="item-template">
    <tr>
        <td>
            <select name="items[__index__][product_id]" class="form-control product-select" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->sku }} - {{ $product->name }}
                </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="items[__index__][quantity]" class="form-control quantity" min="1" value="1"
                required>
        </td>
        <td>
            <input type="number" name="items[__index__][price]" class="form-control price" min="0" required>
        </td>
        <td>
            <input type="number" name="items[__index__][subtotal]" class="form-control subtotal" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger remove-item">×</button>
        </td>
    </tr>
</template>

@push('scripts')
<script>
    let index = 0;

document.getElementById('add-item').addEventListener('click', function () {
    let template = document.getElementById('item-template').innerHTML;
    template = template.replace(/__index__/g, index++);

    document.querySelector('#items-table tbody')
        .insertAdjacentHTML('beforeend', template);
});

document.addEventListener('input', function (e) {
    if (e.target.classList.contains('quantity') || e.target.classList.contains('price')) {
        let row = e.target.closest('tr');
        let qty = row.querySelector('.quantity').value || 0;
        let price = row.querySelector('.price').value || 0;
        let subtotal = qty * price;

        row.querySelector('.subtotal').value = subtotal;

        calculateTotal();
    }
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
        e.target.closest('tr').remove();
        calculateTotal();
    }
});

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(function (el) {
        total += Number(el.value) || 0;
    });
    document.getElementById('total').value = total;
}
</script>
@endpush

@endsection