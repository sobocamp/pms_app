<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\ToastType;
use App\Enums\ToastMessage;
use App\Enums\ParticipantStatus;
use App\Traits\ExtracurricularHelper;
use App\Helpers\RedirectHelper;
use Illuminate\Support\Facades\Auth;
use App\Models\Extracurricular;
use App\Http\Requests\EkstrakurikulerRequest;

class EkstrakurikulerController extends Controller
{
    use ExtracurricularHelper;

    /**
     * Menampilkan daftar ekstrakurikuler dengan pagination.
     *
     * Method ini mengambil semua data ekstrakurikuler dari database
     * menggunakan paginasi sebanyak 10 item per halaman dan meneruskannya
     * ke view halaman daftar ekstrakurikuler untuk admin.
     *
     * @return \Illuminate\View\View  Halaman daftar ekstrakurikuler.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::paginate(10);

        return view('admin.ekstrakurikuler.index', [
            'title' => 'Ekstrakurikuler',
            'extracurriculars' => $extracurriculars
        ]);
    }

    /**
     * Menampilkan form untuk membuat ekstrakurikuler baru.
     *
     * Method ini juga mengambil daftar seluruh pembina
     * untuk ditampilkan sebagai opsi pemilihan pada form.
     *
     * @return \Illuminate\View\View  Halaman form tambah ekstrakurikuler.
     */
    public function create()
    {
        $pembina = User::where('role', 'pembina')->get();

        return view('admin.ekstrakurikuler.create', [
            'title' => 'Tambah Ekstrakurikuler',
            'pembina' => $pembina
        ]);
    }

    /**
     * Menyimpan data ekstrakurikuler baru yang diterima dari form.
     *
     * Data yang disimpan telah divalidasi melalui EkstrakurikulerRequest.
     * Setelah ekstrakurikuler dibuat, relasi dengan pembina akan disimpan
     * melalui tabel pivot menggunakan method sync().
     *
     * @param  EkstrakurikulerRequest  $request  Data yang telah divalidasi.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan toast sukses.
     */
    public function store(EkstrakurikulerRequest $request)
    {
        $extracurricular = Extracurricular::create($request->validated());
        $extracurricular->pembina()->sync($request->pembina_id);

        // Redirect dengan toast
        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.index'),
            ToastType::SUCCESS,
            ToastMessage::EXTRACURRICULAR_CREATE_SUCCESS
        );
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
        $extracurricular = Extracurricular::find($id);
        $pembina = $extracurricular->pembina;

        return view('admin.ekstrakurikuler.show', [
            'title' => 'Detail Ekstrakurikuler',
            'extracurricular' => $extracurricular,
            'pembina' => $pembina
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
        $pembina = User::where('role', 'pembina')->get();
        $extracurricular = Extracurricular::find($id);

        return view('admin.ekstrakurikuler.edit', [
            'title' => 'Edit Ekstrakurikuler',
            'pembina' => $pembina,
            'extracurricular' => $extracurricular
        ]);
    }

    /**
     * Memperbarui data ekstrakurikuler pada database.
     *
     * Setelah data divalidasi melalui EkstrakurikulerRequest,
     * ekstrakurikuler akan diperbarui. Pembina juga disinkronkan ulang.
     *
     * @param  EkstrakurikulerRequest  $request  Data validasi.
     * @param  string                  $id       ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse  Redirect dengan pesan sukses.
     */
    public function update(EkstrakurikulerRequest $request, string $id)
    {
        $extracurricular = Extracurricular::find($id);

        $extracurricular->update($request->validated());
        $extracurricular->pembina()->sync($request->pembina_id);

        // Redirect dengan toast

        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.index'),
            ToastType::SUCCESS,
            ToastMessage::EXTRACURRICULAR_UPDATE_SUCCESS
        );
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
        $extracurricular = Extracurricular::findOrFail($id);

        // Hapus relasi pivot pembina-ekstrakurikuler
        $extracurricular->pembina()->detach();

        // Hapus data utama
        $extracurricular->delete();

        // Redirect dengan toast
        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.index'),
            ToastType::SUCCESS,
            ToastMessage::EXTRACURRICULAR_DELETE_SUCCESS
        );
    }

    /**
     * Menampilkan daftar ekstrakurikuler berdasarkan pembina.
     *
     * Method ini mencari seluruh ekstrakurikuler yang memiliki relasi pembina
     * dengan user ID tertentu melalui whereHas().
     *
     * @param  string  $id  ID user pembina.
     * @return \Illuminate\View\View  Halaman daftar ekstrakurikuler pembina.
     */
    public function ekstrakurikulerPembina(string $id)
    {
        $extracurriculars = Extracurricular::whereHas('pembina', function ($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->whereHas('registrations.registrationPeriod', function ($query) {
            $query->where('is_active', true);
        })
        ->paginate(10);

        return view('pembina.ekstrakurikuler.index', [
            'title' => 'Ekstrakurikuler Saya',
            'extracurriculars' => $extracurriculars
        ]);
    }

    /**
     * Menampilkan daftar peserta ekstrakurikuler.
     *
     * Method ini akan mengambil data ekstrakurikuler
     * dan menampilkan seluruh peserta melalui relasi participants.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\View\View  Halaman daftar peserta.
     */
    public function peserta(string $id)
    {
        $extracurricular = Extracurricular::find($id);

        return view('pembina.ekstrakurikuler.peserta', [
            'title' => 'Peserta Ekstrakurikuler',
            'extracurricular' => $extracurricular,
        ]);
    }

    /**
     * Menampilkan ekstrakurikuler yang diikuti oleh siswa tertentu.
     *
     * Method ini mencari ekstrakurikuler berdasarkan relasi registrations
     * yang mengaitkan siswa dengan periode pendaftaran.
     *
     * @param  string  $id  ID user siswa.
     * @return \Illuminate\View\View  Halaman "Ekstrakurikuler Saya" untuk siswa.
     */
    public function ekstrakurikulerSiswa(string $id)
    {
        $extracurriculars = Extracurricular::whereHas('registrations', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(10);

        return view('siswa.ekstrakurikuler.index', [
            'title' => 'Ekstrakurikuler Saya',
            'extracurriculars' => $extracurriculars
        ]);
    }

    /**
     * Menampilkan detail ekstrakurikuler untuk siswa,
     * serta status apakah siswa sudah mendaftar atau belum.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\View\View  Halaman detail ekstrakurikuler siswa.
     */
    public function ekstrakurikulerDetail(string $id)
    {
        $extracurricular = Extracurricular::find($id);

        // mengecek apakah siswa sudah menjadi peserta
        $registered = $extracurricular->participants->contains('id', Auth::user()->id);

        return view('siswa.ekstrakurikuler.detail', [
            'title' => 'Detail Ekstrakurikuler',
            'extracurricular' => $extracurricular,
            'registered' => $registered
        ]);
    }

    /**
     * Mendaftarkan siswa ke ekstrakurikuler pada periode aktif.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa tidak boleh mendaftar dua kali pada periode yang sama
     * - Jumlah peserta yang disetujui tidak boleh melebihi kuota
     *
     * Setelah validasi terpenuhi, data pendaftaran disimpan ke tabel pivot.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(string $id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $user = Auth::user();

        // Ambil periode aktif
        $period = $this->getActivePeriodOrFail();

        if (!$period) {
            // Redirect dengan toast
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_PERIOD_NOT_ACTIVE
            );
        }

        // Hitung peserta approved
        $jumlahApproved = $extracurricular->approvedParticipants()->count();

        // Cek kuota
        if ($jumlahApproved >= $extracurricular->quota) {
            // Redirect dengan toast
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_QUOTA_EXCEEDED
            );
        }

        // Cek apakah sudah mendaftar pada periode ini
        $alreadyJoined = $this->checkAlreadyJoined($extracurricular, $user->id, $period->id);

        if ($alreadyJoined) {
            // Redirect dengan toast
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_REGISTRATION_FAILURE
            );
        }

        // Simpan ke pivot
        $extracurricular->participants()->attach($user->id, [
            'registration_period_id' => $period->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect dengan toast
        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.detail', $extracurricular->id),
            ToastType::SUCCESS,
            ToastMessage::EXTRACURRICULAR_REGISTRATION_SUCCESS
        );
    }

    /**
     * Membatalkan pendaftaran siswa pada ekstrakurikuler.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa harus sudah terdaftar sebelumnya
     *
     * Jika lolos validasi, relasi di tabel pivot akan dihapus.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unregister(string $id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $user = Auth::user();

        // Ambil periode aktif
        $period = $this->getActivePeriodOrFail();

        if (!$period) {
            // Redirect dengan toast
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_PERIOD_NOT_ACTIVE
            );
        }

        // Cek apakah sudah mendaftar
        $alreadyJoined = $this->checkAlreadyJoined($extracurricular, $user->id, $period->id);

        if (!$alreadyJoined) {
            // Redirect dengan toast
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_UNREGISTER_FAILURE
            );
        }

        // Hapus dari pivot
        $extracurricular->participants()->detach($user->id);

        // Redirect dengan toast
        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.detail', $extracurricular->id),
            ToastType::SUCCESS,
            ToastMessage::EXTRACURRICULAR_UNREGISTER_SUCCESS
        );
    }

    /**
     * Menampilkan daftar semua ekstrakurikuler untuk siswa,
     * tidak terbatas pada yang mereka ikuti.
     *
     * Method ini digunakan pada halaman daftar ekstrakurikuler umum
     * yang dapat dilihat oleh semua siswa.
     *
     * @return \Illuminate\View\View  Halaman daftar semua ekstrakurikuler.
     */
    public function ekstrakurikulerSemua()
    {
        $extracurriculars = Extracurricular::paginate(10);

        return view('siswa.ekstrakurikuler.list', [
            'title' => 'Semua Ekstrakurikuler',
            'extracurriculars' => $extracurriculars
        ]);
    }

    /**
     * Mengupdate status pendaftaran siswa pada ekstrakurikuler.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa harus sudah mendaftar sebelumnya
     *
     * Jika lolos validasi, status pendaftaran di tabel pivot akan diubah menjadi 'approved'.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    private function updateStatus(string $id, string $userId, ParticipantStatus $status)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $user = User::findOrFail($userId);

        // periode aktif
        $period = $this->getActivePeriodOrFail();
        if (!$period) {
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_PERIOD_NOT_ACTIVE
            );
        }

        // cek apakah user pernah daftar
        $joined = $this->checkAlreadyJoined($extracurricular, $user->id, $period->id);
        if (!$joined) {
            return RedirectHelper::backWithToast(
                back(),
                ToastType::ERROR,
                ToastMessage::EXTRACURRICULAR_NO_DATA_AVAILABLE
            );
        }

        // update status
        $status->execute($extracurricular, $user->id);

        return RedirectHelper::redirectWithToast(
            redirect()->route('extracurricular.peserta', $extracurricular->id),
            ToastType::SUCCESS,
            $status->successMessage()
        );
    }

    /**
     * Menyetujui pendaftaran siswa pada ekstrakurikuler.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa harus sudah mendaftar sebelumnya
     *
     * Jika lolos validasi, status pendaftaran di tabel pivot akan diubah menjadi 'approved'.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(string $id, string $user_id)
    {
        return $this->updateStatus(
            $id,
            $user_id,
            ParticipantStatus::APPROVED,
        );
    }

    /**
     * Menunda pendaftaran siswa pada ekstrakurikuler.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa harus sudah mendaftar sebelumnya
     *
     * Jika lolos validasi, status pendaftaran di tabel pivot akan diubah menjadi 'pending'.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pending(string $id, string $user_id)
    {
        return $this->updateStatus(
            $id,
            $user_id,
            ParticipantStatus::PENDING,
        );
    }

    /**
     * Menolak pendaftaran siswa pada ekstrakurikuler.
     *
     * Validasi yang dilakukan:
     * - Periode registrasi harus aktif
     * - Siswa harus sudah mendaftar sebelumnya
     *
     * Jika lolos validasi, status pendaftaran di tabel pivot akan diubah menjadi 'rejected'.
     *
     * @param  string  $id  ID ekstrakurikuler.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(string $id, string $user_id)
    {
        return $this->updateStatus(
            $id,
            $user_id,
            ParticipantStatus::REJECTED,
        );
    }
}
