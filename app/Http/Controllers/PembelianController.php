<?php

namespace App\Http\Controllers;

use App\Enums\RedirectWithToast;
use App\Models\Pembelian;
use App\Models\Product;
use App\Services\PembelianService;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $pembelian = Pembelian::paginate(10);
        return view('admin.pembelian.index', [
            'title' => 'Pembelian',
            'pembelian' => $pembelian
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.pembelian.create', [
            'title' => 'Tambah Pembelian',
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_number' => 'required|string',
            'purchase_date' => 'required|date',
            'supplier' => 'required|string',
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.subtotal' => 'required|numeric|min:0',
        ]);

        app(PembelianService::class)->store($validated); // Menyimpan pembelian dan menambahkan stok

        return RedirectWithToast::PEMBELIAN_CREATE_SUCCESS->redirect('pembelian.index');
    }

    public function show(string $id)
    {
        $pembelian = Pembelian::find($id);
        return view('admin.pembelian.show', [
            'title' => 'Detail Pembelian',
            'pembelian' => $pembelian
        ]);
    }

    public function edit(string $id)
    {
        $pembelian = Pembelian::find($id);
        $products = Product::orderBy('name', 'asc')->get();
        return view('admin.pembelian.edit', [
            'title' => 'Edit Pembelian',
            'pembelian' => $pembelian,
            'products' => $products
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'purchase_number' => 'required|string',
            'purchase_date' => 'required|date',
            'supplier' => 'required|string',
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.subtotal' => 'required|numeric|min:0',
        ]);

        app(PembelianService::class)->update(Pembelian::find($id), $validated); // Menyimpan pembelian dan menambahkan stok

        return RedirectWithToast::PEMBELIAN_UPDATE_SUCCESS->redirect('pembelian.index');
    }

    public function destroy(string $id)
    {
        app(PembelianService::class)->destroy(Pembelian::find($id));

        return RedirectWithToast::PEMBELIAN_DELETE_SUCCESS->redirect('pembelian.index');
    }
}
