<?php

namespace App\Http\Controllers;

use App\Enums\RedirectWithToast;
use App\Http\Requests\ProdukRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan pagination.
     *
     * Method ini mengambil semua data produk dari database
     * menggunakan paginasi sebanyak 10 item per halaman dan meneruskannya
     * ke view halaman daftar produk untuk admin.
     *
     * @return \Illuminate\View\View  Halaman daftar produk.
     */
    public function index()
    {
        $products = Product::when(request('search'), function ($query) {
                    $query->where('sku', 'like', '%' . request('search') . '%');
                    $query->orWhere('name', 'like', '%' . request('search') . '%');
                    $query->orWhere('description', 'like', '%' . request('search') . '%');
                    $query->orWhere('brand', 'like', '%' . request('search') . '%');
                })->paginate(10);

        Log::channel('custom')->info('User melihat daftar produk', [
            'user' => Auth::user(),
            'ip_address' => request()->ip(),
        ]);

        return $this->render('admin.produk.index', [
            'title' => 'Produk',
            'products' => $products
        ]);
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     *
     * Method ini juga mengambil daftar seluruh pembina
     * untuk ditampilkan sebagai opsi pemilihan pada form.
     *
     * @return \Illuminate\View\View  Halaman form tambah produk.
     */
    public function create()
    {
        return $this->render('admin.produk.create', [
            'title' => 'Tambah Produk'
        ]);
    }

    /**
     * Menyimpan data ekstrakurikuler baru yang diterima dari form.
     *
     * Data yang disimpan telah divalidasi melalui ProdukRequest.
     *
     * @param  ProdukRequest  $request  Data yang telah divalidasi.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan toast sukses.
     */
    public function store(ProdukRequest $request)
    {
        $product = Product::create($request->validated());

        Log::channel('custom')->info('User menambahkan produk', [
            'user' => Auth::user(),
            'ip_address' => request()->ip(),
            'product' => $product
        ]);

        // Redirect dengan toast
        return RedirectWithToast::PRODUCT_CREATE_SUCCESS->redirect('produk.index');
    }

    /**
     * Menampilkan detail ekstrakurikuler.
     *
     * Method ini mengambil data ekstrakurikuler berdasarkan ID serta
     * memanggil relasi pembina untuk ditampilkan bersama informasi lengkap.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\View\View  Halaman detail ekstrakurikuler.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return $this->render('admin.produk.show', [
            'title' => 'Detail Produk',
            'product' => $product
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data ekstrakurikuler.
     *
     * Method ini mengambil data ekstrakurikuler berdasarkan ID serta
     * daftar pembina untuk ditampilkan dalam form edit.
     *
     * @param  string  $id  ID ekstrakurikuler yang akan diedit.
     * @return \Illuminate\View\View  Halaman edit ekstrakurikuler.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        return $this->render('admin.produk.edit', [
            'title' => 'Edit Produk',
            'product' => $product
        ]);
    }

    /**
     * Memperbarui data ekstrakurikuler pada database.
     *
     * Setelah data divalidasi melalui ProdukRequest,
     * ekstrakurikuler akan diperbarui. Pembina juga disinkronkan ulang.
     *
     * @param  ProdukRequest  $request  Data validasi.
     * @param  string                  $id       ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan pesan sukses.
     */
    public function update(ProdukRequest $request, string $id)
    {
        $product = Product::find($id);

        $product->update($request->validated());

        Log::channel('custom')->info('User mengubah ekstrakurikuler', [
            'user' => Auth::user(),
            'ip_address' => request()->ip(),
            'product' => $product
        ]);

        // Redirect dengan toast
        return RedirectWithToast::PRODUCT_UPDATE_SUCCESS->redirect('produk.index');
    }

    /**
     * Menghapus ekstrakurikuler dari database.
     *
     * Method ini akan menghapus relasi pembina melalui detach(),
     * kemudian menghapus data utama ekstrakurikuler.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan notifikasi.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus data utama
        $product->delete();

        Log::channel('custom')->info('User menghapus ekstrakurikuler', [
            'user' => Auth::user(),
            'ip_address' => request()->ip(),
            'product' => $product
        ]);

        // Redirect dengan toast
        return RedirectWithToast::PRODUCT_DELETE_SUCCESS->redirect('produk.index');
    }
}
