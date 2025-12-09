<?php

namespace App\Http\Controllers;

use App\Enums\RedirectWithToast;
use App\Models\RegistrationPeriod;
use App\Http\Requests\PeriodeRequest;

class PeriodeController extends Controller
{
    /**
     * Menampilkan daftar seluruh periode pendaftaran dengan pagination.
     *
     * Method ini mengambil data periode pendaftaran dari database
     * menggunakan paginasi sebanyak 10 item per halaman dan meneruskannya
     * ke view admin untuk ditampilkan dalam tabel daftar periode.
     *
     * @return \Illuminate\View\View  Halaman daftar periode pendaftaran.
     */
    public function index()
    {
        $periode = RegistrationPeriod::paginate(10);

        return $this->render('admin.periode.index', [
            'title' => 'Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Menampilkan form untuk membuat periode pendaftaran baru.
     *
     * Method ini hanya mengembalikan view form tanpa melakukan pengambilan data tambahan.
     *
     * @return \Illuminate\View\View  Halaman form tambah periode pendaftaran.
     */
    public function create()
    {
        return $this->render('admin.periode.create', [
            'title' => 'Tambah Periode Pendaftaran'
        ]);
    }

    /**
     * Menyimpan periode pendaftaran baru ke dalam database.
     *
     * Logika validasi tambahan:
     * - Jika field "is_active" dicentang, maka seluruh periode aktif lain
     *   akan dinonaktifkan terlebih dahulu (set is_active = false).
     *
     * Data utama kemudian disimpan melalui model RegistrationPeriod.
     *
     * @param  PeriodeRequest  $request  Request berisi data yang telah divalidasi.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan pesan sukses.
     */
    public function store(PeriodeRequest $request)
    {
        // Jika membuat periode aktif baru, nonaktifkan periode aktif sebelumnya
        if ($request->is_active) {
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        RegistrationPeriod::create($request->validated());

        // Redirect dengan toast
        return RedirectWithToast::PERIOD_CREATE_SUCCESS->redirect('periode.index');
        // return RedirectHelper::redirectWithToast(
        //     redirect()->route('periode.index'),
        //     ToastType::SUCCESS,
        //     ToastMessage::PERIOD_CREATE_SUCCESS
        // );
    }

    /**
     * Menampilkan detail periode pendaftaran berdasarkan ID.
     *
     * Method ini mengambil data periode berdasarkan ID dan menampilkannya
     * dalam halaman detail untuk admin.
     *
     * @param  string  $id  ID periode pendaftaran.
     * @return \Illuminate\View\View  Halaman detail periode.
     */
    public function show(string $id)
    {
        $periode = RegistrationPeriod::find($id);

        return $this->render('admin.periode.show', [
            'title' => 'Detail Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Menampilkan form edit periode pendaftaran.
     *
     * Method ini mengambil data periode berdasarkan ID untuk disunting
     * melalui form edit pada halaman admin.
     *
     * @param  string  $id  ID periode pendaftaran.
     * @return \Illuminate\View\View  Halaman edit periode.
     */
    public function edit(string $id)
    {
        $periode = RegistrationPeriod::find($id);

        return $this->render('admin.periode.edit', [
            'title' => 'Edit Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Memperbarui periode pendaftaran pada database.
     *
     * Logika:
     * - Jika "is_active" diset menjadi true, seluruh periode aktif lainnya
     *   akan dinonaktifkan terlebih dahulu.
     * - Data akan diperbarui berdasarkan validasi dari PeriodeRequest.
     *
     * @param  PeriodeRequest  $request  Data validasi periode pendaftaran.
     * @param  string          $id       ID periode yang diperbarui.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan pesan sukses.
     */
    public function update(PeriodeRequest $request, string $id)
    {
        // Jika menyetel periode ini sebagai aktif, maka nonaktifkan semua periode aktif lainnya
        if ($request->is_active) {
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        $periode = RegistrationPeriod::find($id);
        $periode->update($request->validated());

        // Redirect dengan toast
        return RedirectWithToast::PERIOD_UPDATE_SUCCESS->redirect('periode.index');
    }

    /**
     * Menghapus periode pendaftaran dari database.
     *
     * Method ini menghapus data periode berdasarkan ID.
     * Tidak ada pengecekan tambahan karena diasumsikan ID valid
     * berasal dari halaman listing atau detail.
     *
     * @param  string  $id  ID periode pendaftaran.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan pesan sukses.
     */
    public function destroy(string $id)
    {
        RegistrationPeriod::find($id)->delete();

        // Redirect dengan toast
        return RedirectWithToast::PERIOD_DELETE_SUCCESS->redirect('periode.index');
    }
}
