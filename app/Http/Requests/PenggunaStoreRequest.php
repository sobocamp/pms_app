<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaStoreRequest extends FormRequest
{
    /**
     * Menentukan apakah user diizinkan membuat request ini.
     *
     * Method ini mengembalikan nilai true, artinya seluruh pengguna yang
     * mengakses route ini diizinkan membuat request. Pada implementasi
     * aplikasi yang lebih kompleks, otorisasi dapat diperluas menggunakan
     * role, permission, atau policy.
     *
     * @return bool  True jika request diperbolehkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk permintaan pembuatan pengguna baru.
     *
     * Aturan validasi meliputi:
     * - **name**: wajib diisi, string, maksimal 255 karakter.
     * - **email**: wajib diisi, harus format email valid, maksimal 255 karakter,
     *              dan harus unik dalam tabel users.
     * - **password**: wajib diisi, string, minimal 8 karakter.
     * - **role**: wajib diisi dan harus bernilai 'gudang' atau 'kasir'.
     *
     * Request ini digunakan pada proses penyimpanan pengguna baru di
     * `PenggunaController@store`.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *         Array aturan validasi yang diterapkan pada request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            // Email harus unik di tabel users
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)
            ],

            // Password minimal 8 karakter
            'password' => ['required', 'string', 'min:8'],

            // Role hanya diperbolehkan berisi 'gudang' atau 'kasir'
            'role' => ['required', 'string', 'in:gudang,kasir'],
        ];
    }
}
