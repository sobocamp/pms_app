<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\RedirectWithToast;
use App\Http\Requests\PenggunaStoreRequest;
use App\Http\Requests\PenggunaUpdateRequest;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar seluruh pengguna dengan pagination.
     *
     * Method ini mengambil semua data pengguna dengan role "gudang" atau "kasir"
     * menggunakan paginasi sebanyak 10 data per halaman, lalu mengirimkannya
     * ke view untuk ditampilkan dalam tabel admin.
     *
     * @return \Illuminate\View\View  View halaman daftar pengguna.
     */
    public function index()
    {
        $pengguna = User::whereIn('role', ['gudang', 'kasir'])->paginate(10);

        return $this->render('admin.pengguna.index', [
            'title' => 'Pengguna',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     *
     * Method ini hanya mengembalikan view form pembuatan pengguna baru
     * tanpa melakukan query tambahan ke database.
     *
     * @return \Illuminate\View\View  View halaman form tambah pengguna.
     */
    public function create()
    {
        return $this->render('admin.pengguna.create', [
            'title' => 'Tambah Pengguna'
        ]);
    }

    /**
     * Menyimpan data pengguna baru ke dalam database.
     *
     * Method ini menerima data yang sudah tervalidasi melalui
     * PenggunaStoreRequest. Password di-hash menggunakan bcrypt sebelum
     * disimpan. Data pengguna baru akan dibuat sebagai user dengan role "gudang" atau "kasir".
     *
     * @param  PenggunaStoreRequest  $request  Request berisi input yang telah divalidasi.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pengguna dengan pesan sukses.
     */
    public function store(PenggunaStoreRequest $request)
    {
        // Hash password sebelum disimpan
        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        User::create($request->validated());

        // Redirect dengan toast
        return RedirectWithToast::PENGGUNA_CREATE_SUCCESS->redirect('pengguna.index');
    }

    /**
     * Menampilkan detail pengguna berdasarkan ID.
     *
     * Method ini akan mencari data pengguna berdasarkan ID.
     * Jika ditemukan, data dikirim ke view detail pengguna.
     *
     * @param  string  $id  ID pengguna yang akan ditampilkan.
     * @return \Illuminate\View\View  View halaman detail pengguna.
     */
    public function show(string $id)
    {
        $pengguna = User::find($id);

        return $this->render('admin.pengguna.show', [
            'title' => 'Detail Pengguna',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data pengguna.
     *
     * Method ini mengambil data pengguna berdasarkan ID dan mengirimkannya
     * ke view form edit pengguna.
     *
     * @param  string  $id  ID pengguna yang akan diedit.
     * @return \Illuminate\View\View  View halaman edit pengguna.
     */
    public function edit(string $id)
    {
        $pengguna = User::find($id);

        return $this->render('admin.pengguna.edit', [
            'title' => 'Edit Pengguna',
            'pengguna' => $pengguna
        ]);
    }

    /**
     * Memperbarui data pengguna di database.
     *
     * Method ini menerima input yang sudah tervalidasi melalui
     * PenggunaUpdateRequest. Password hanya akan diubah jika input password baru diisi.
     * Jika password tidak diisi, field password tidak akan diubah (di-unset).
     *
     * @param  PenggunaUpdateRequest  $request  Request berisi input yang telah divalidasi.
     * @param  string                $id       ID pengguna yang akan diperbarui.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pengguna dengan pesan sukses.
     */
    public function update(PenggunaUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        // Update password hanya jika diisi
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        User::find($id)->update($data);

        // Redirect dengan toast
        return RedirectWithToast::PENGGUNA_UPDATE_SUCCESS->redirect('pengguna.index');
    }

    /**
     * Menghapus pengguna dari database.
     *
     * Method ini menghapus user berdasarkan ID. Tidak dilakukan pengecekan
     * tambahan secara eksplisit karena diasumsikan ID sudah valid dan
     * data pengguna telah ditampilkan di halaman sebelumnya.
     *
     * @param  string  $id  ID pengguna yang akan dihapus.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pengguna dengan pesan sukses.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();

        // Redirect dengan toast
        return RedirectWithToast::PENGGUNA_DELETE_SUCCESS->redirect('pengguna.index');
    }
}
