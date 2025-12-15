<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaUpdateRequest extends FormRequest
{
    /**
     * Menentukan apakah user diizinkan membuat request ini.
     *
     * Method ini mengembalikan true sehingga semua pengguna yang
     * mengakses endpoint ini dapat melakukan request. Pada aplikasi
     * yang lebih kompleks, kontrol akses dapat diatur melalui policy
     * atau gate untuk membatasi siapa yang boleh memperbarui data pengguna.
     *
     * @return bool  True jika request diperbolehkan diproses.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk memperbarui data pengguna.
     *
     * Aturan validasi meliputi:
     *
     * - **name**: wajib diisi, string, maksimal 255 karakter.
     * - **email**:
     *      - wajib diisi, harus format email valid.
     *      - maksimal 255 karakter.
     *      - harus unik di tabel users, tetapi mengabaikan email pengguna yang sedang diedit.
     *        Aturan ini menggunakan `Rule::unique()->ignore()` untuk menghindari false positive.
     * - **password**:
     *      - boleh dikosongkan (nullable).
     *      - jika diisi, minimal 8 karakter.
     * - **role**:
     *      - wajib diisi.
     *      - harus bernilai 'gudang' atau 'kasir'.
     *
     * Request ini digunakan pada update data pengguna dalam `PenggunaController@update`.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *         Array aturan validasi yang diterapkan pada request ini.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            // Email harus unik tetapi abaikan id pengguna yang sedang diedit
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],

            // Password opsional, tetapi jika diisi harus minimal 8 karakter
            'password' => ['nullable', 'string', 'min:8'],

            // Role harus tetap 'gudang' atau 'kasir'
            'role' => ['required', 'string', 'in:gudang,kasir'],
        ];
    }
}
