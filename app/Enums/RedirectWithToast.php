<?php

namespace App\Enums;

enum RedirectWithToast: string
{
    case EXTRACURRICULAR_CREATE_SUCCESS = 'Ekstrakurikuler berhasil disimpan';
    case EXTRACURRICULAR_CREATE_FAILURE = 'Ekstrakurikuler gagal disimpan';
    case EXTRACURRICULAR_UPDATE_SUCCESS = 'Ekstrakurikuler berhasil diperbarui';
    case EXTRACURRICULAR_UPDATE_FAILURE = 'Ekstrakurikuler gagal diperbarui';
    case EXTRACURRICULAR_DELETE_SUCCESS = 'Ekstrakurikuler berhasil dihapus';
    case EXTRACURRICULAR_DELETE_FAILURE = 'Ekstrakurikuler gagal dihapus';

    case EXTRACURRICULAR_PERIOD_NOT_ACTIVE = 'Periode registrasi belum dibuka';
    case EXTRACURRICULAR_QUOTA_EXCEEDED = 'Kuota untuk ekstrakurikuler ini sudah penuh';

    case EXTRACURRICULAR_REGISTRATION_SUCCESS = 'Registrasi ekstrakurikuler berhasil dilakukan';
    case EXTRACURRICULAR_REGISTRATION_FAILURE = 'Anda sudah mendaftar ekstrakurikuler pada periode ini';
    case EXTRACURRICULAR_UNREGISTER_SUCCESS = 'Unregistrasi ekstrakurikuler berhasil dilakukan';
    case EXTRACURRICULAR_UNREGISTER_FAILURE = 'Anda belum mendaftar ekstrakurikuler pada periode ini';
    case EXTRACURRICULAR_APPROVE_SUCCESS = 'Approval ekstrakurikuler berhasil dilakukan';
    case EXTRACURRICULAR_PENDING_SUCCESS = 'Pending ekstrakurikuler berhasil dilakukan';
    case EXTRACURRICULAR_REJECT_SUCCESS = 'Rejection ekstrakurikuler berhasil dilakukan';
    case EXTRACURRICULAR_NO_DATA_AVAILABLE = 'Tidak ada data yang tersedia';

    case PEMBINA_CREATE_SUCCESS = 'Pembina berhasil ditambahkan';
    case PEMBINA_CREATE_FAILURE = 'Pembina gagal ditambahkan';
    case PEMBINA_UPDATE_SUCCESS = 'Pembina berhasil diperbarui';
    case PEMBINA_UPDATE_FAILURE = 'Pembina gagal diperbarui';
    case PEMBINA_DELETE_SUCCESS = 'Pembina berhasil dihapus';
    case PEMBINA_DELETE_FAILURE = 'Pembina gagal dihapus';

    case PERIOD_CREATE_SUCCESS = 'Periode pendaftaran berhasil ditambahkan';
    case PERIOD_CREATE_FAILURE = 'Periode pendaftaran gagal ditambahkan';
    case PERIOD_UPDATE_SUCCESS = 'Periode pendaftaran berhasil diperbarui';
    case PERIOD_UPDATE_FAILURE = 'Periode pendaftaran gagal diperbarui';
    case PERIOD_DELETE_SUCCESS = 'Periode pendaftaran berhasil dihapus';
    case PERIOD_DELETE_FAILURE = 'Periode pendaftaran gagal dihapus';

    /**
     * Mendapatkan tipe toast berdasarkan nama enum.
     */
    public function type(): string
    {
        return str_contains($this->name, 'SUCCESS') ? 'success' : 'error';
    }

    /**
     * Redirect elegan ke route tertentu.
     */
    public function redirect(string $route, array $params = [])
    {
        return redirect()
            ->route($route, $params)
            ->with('toast', [
                'type' => $this->type(),
                'message' => $this->value
            ]);
    }

    /**
     * Redirect elegan ke halaman sebelumnya.
     */
    public function back()
    {
        return redirect()
            ->back()
            ->with('toast', [
                'type' => $this->type(),
                'message' => $this->value
            ]);
    }
}
