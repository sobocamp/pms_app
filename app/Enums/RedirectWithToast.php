<?php

namespace App\Enums;

enum RedirectWithToast: string
{
    case PRODUCT_CREATE_SUCCESS = 'Produk berhasil ditambahkan';
    case PRODUCT_CREATE_FAILURE = 'Produk gagal ditambahkan';
    case PRODUCT_UPDATE_SUCCESS = 'Produk berhasil diperbarui';
    case PRODUCT_UPDATE_FAILURE = 'Produk gagal diperbarui';
    case PRODUCT_DELETE_SUCCESS = 'Produk berhasil dihapus';
    case PRODUCT_DELETE_FAILURE = 'Produk gagal dihapus';

    case PENGGUNA_CREATE_SUCCESS = 'Pengguna berhasil ditambahkan';
    case PENGGUNA_CREATE_FAILURE = 'Pengguna gagal ditambahkan';
    case PENGGUNA_UPDATE_SUCCESS = 'Pengguna berhasil diperbarui';
    case PENGGUNA_UPDATE_FAILURE = 'Pengguna gagal diperbarui';
    case PENGGUNA_DELETE_SUCCESS = 'Pengguna berhasil dihapus';
    case PENGGUNA_DELETE_FAILURE = 'Pengguna gagal dihapus';

    case PEMBELIAN_CREATE_SUCCESS = 'Pembelian berhasil ditambahkan';
    case PEMBELIAN_CREATE_FAILURE = 'Pembelian gagal ditambahkan';
    case PEMBELIAN_UPDATE_SUCCESS = 'Pembelian berhasil diperbarui';
    case PEMBELIAN_UPDATE_FAILURE = 'Pembelian gagal diperbarui';
    case PEMBELIAN_DELETE_SUCCESS = 'Pembelian berhasil dihapus';
    case PEMBELIAN_DELETE_FAILURE = 'Pembelian gagal dihapus';

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
