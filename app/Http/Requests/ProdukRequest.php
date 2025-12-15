<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
{
    /**
     * Menentukan apakah user diizinkan untuk melakukan request ini.
     *
     * Method ini mengembalikan nilai true, yang berarti seluruh pengguna
     * yang mengakses route terkait diperbolehkan melakukan permintaan ini.
     * Pada implementasi lebih kompleks, logic otorisasi dapat ditambahkan
     * berdasarkan role atau permission tertentu.
     *
     * @return bool  True jika request diizinkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mendefinisikan aturan validasi untuk penyimpanan atau pembaruan data produk.
     *
     * Aturan validasi mencakup:
     * - **sku**: wajib diisi, bertipe string.
     * - **name**: wajib diisi, bertipe string.
     * - **description**: wajib diisi, bertipe string.
     * - **brand**: wajib diisi, bertipe string.
     * - **status**: wajib diisi, bertipe string.
     *
     * Digunakan pada proses `store()` dan `update()` pada ProdukController.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *         Array aturan validasi untuk request ini.
     */
    public function rules(): array
    {
        return [
            'sku' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }
}
