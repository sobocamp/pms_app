<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman form pengaturan profil pengguna.
     *
     * Method ini mengambil data user yang sedang login melalui
     * instance $request->user() dan meneruskannya ke view form profil.
     *
     * @param  Request  $request  Request HTTP berisi data user saat ini.
     * @return View  Halaman form edit profil pengguna.
     */
    public function edit(Request $request): View
    {
        return $this->render('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     *
     * Method ini:
     * - Mengeksekusi validasi melalui ProfileUpdateRequest.
     * - Mengisi model user dengan data yang telah divalidasi.
     * - Mengatur ulang email_verified_at jika user mengubah email.
     * - Menyimpan perubahan ke database.
     *
     * Hal ini memastikan bahwa perubahan email memicu verifikasi ulang.
     *
     * @param  ProfileUpdateRequest  $request  Data profil baru yang telah divalidasi.
     * @return RedirectResponse  Redirect ke halaman edit profil dengan status sukses.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // Jika email berubah, reset status verifikasi
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna beserta proses logout dan pembersihan session.
     *
     * Proses:
     * - Memvalidasi password pengguna menggunakan rule 'current_password'.
     * - Mendapatkan instance user saat ini.
     * - Logout dari sistem.
     * - Menghapus akun user dari database (soft/hard delete tergantung konfigurasi model).
     * - Menghapus session dan regenerasi token untuk keamanan.
     * - Redirect ke halaman utama.
     *
     * Method ini digunakan ketika pengguna ingin menutup akunnya secara permanen.
     *
     * @param  Request  $request  Request yang berisi password untuk konfirmasi penghapusan akun.
     * @return RedirectResponse  Redirect ke halaman utama setelah akun terhapus.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password untuk keamanan
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus akun user
        $user->delete();

        // Hapus session dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
