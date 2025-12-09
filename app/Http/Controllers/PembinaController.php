<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\RedirectWithToast;
use App\Http\Requests\PembinaStoreRequest;
use App\Http\Requests\PembinaUpdateRequest;

class PembinaController extends Controller
{
    /**
     * Menampilkan daftar seluruh pembina dengan pagination.
     *
     * Method ini mengambil semua data pengguna dengan role "pembina"
     * menggunakan paginasi sebanyak 10 data per halaman, lalu mengirimkannya
     * ke view untuk ditampilkan dalam tabel admin.
     *
     * @return \Illuminate\View\View  View halaman daftar pembina.
     */
    public function index()
    {
        $pembina = User::where('role', 'pembina')->paginate(10);

        return $this->render('admin.pembina.index', [
            'title' => 'Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Menampilkan form untuk membuat pembina baru.
     *
     * Method ini hanya mengembalikan view form pembuatan pembina baru
     * tanpa melakukan query tambahan ke database.
     *
     * @return \Illuminate\View\View  View halaman form tambah pembina.
     */
    public function create()
    {
        return $this->render('admin.pembina.create', [
            'title' => 'Tambah Pembina'
        ]);
    }

    /**
     * Menyimpan data pembina baru ke dalam database.
     *
     * Method ini menerima data yang sudah tervalidasi melalui
     * PembinaStoreRequest. Password di-hash menggunakan bcrypt sebelum
     * disimpan. Data pembina baru akan dibuat sebagai user dengan role "pembina".
     *
     * @param  PembinaStoreRequest  $request  Request berisi input yang telah divalidasi.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pembina dengan pesan sukses.
     */
    public function store(PembinaStoreRequest $request)
    {
        // Hash password sebelum disimpan
        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        User::create($request->validated());

        // Redirect dengan toast
        return RedirectWithToast::PEMBINA_CREATE_SUCCESS->redirect('pembina.index');
    }

    /**
     * Menampilkan detail pembina berdasarkan ID.
     *
     * Method ini akan mencari data pembina berdasarkan ID.
     * Jika ditemukan, data dikirim ke view detail pembina.
     *
     * @param  string  $id  ID pembina yang akan ditampilkan.
     * @return \Illuminate\View\View  View halaman detail pembina.
     */
    public function show(string $id)
    {
        $pembina = User::find($id);

        return $this->render('admin.pembina.show', [
            'title' => 'Detail Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data pembina.
     *
     * Method ini mengambil data pembina berdasarkan ID dan mengirimkannya
     * ke view form edit pembina.
     *
     * @param  string  $id  ID pembina yang akan diedit.
     * @return \Illuminate\View\View  View halaman edit pembina.
     */
    public function edit(string $id)
    {
        $pembina = User::find($id);

        return $this->render('admin.pembina.edit', [
            'title' => 'Edit Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Memperbarui data pembina di database.
     *
     * Method ini menerima input yang sudah tervalidasi melalui
     * PembinaUpdateRequest. Password hanya akan diubah jika input password baru diisi.
     * Jika password tidak diisi, field password tidak akan diubah (di-unset).
     *
     * @param  PembinaUpdateRequest  $request  Request berisi input yang telah divalidasi.
     * @param  string                $id       ID pembina yang akan diperbarui.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pembina dengan pesan sukses.
     */
    public function update(PembinaUpdateRequest $request, string $id)
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
        return RedirectWithToast::PEMBINA_UPDATE_SUCCESS->redirect('pembina.index');
    }

    /**
     * Menghapus pembina dari database.
     *
     * Method ini menghapus user berdasarkan ID. Tidak dilakukan pengecekan
     * tambahan secara eksplisit karena diasumsikan ID sudah valid dan
     * data pembina telah ditampilkan di halaman sebelumnya.
     *
     * @param  string  $id  ID pembina yang akan dihapus.
     * @return \Illuminate\Http\RedirectResponse  Redirect ke daftar pembina dengan pesan sukses.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();

        // Redirect dengan toast
        return RedirectWithToast::PEMBINA_DELETE_SUCCESS->redirect('pembina.index');
    }
}
