<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeRequest extends FormRequest
{
    /**
     * Menentukan apakah user diizinkan membuat request ini.
     *
     * Method ini mengembalikan true, yang berarti semua pengguna
     * yang mengakses route terkait diperbolehkan melakukan request.
     * Pada implementasi lebih kompleks, otorisasi dapat diatur
     * berdasarkan role atau permission tertentu.
     *
     * @return bool  True jika request diperbolehkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk membuat atau memperbarui periode pendaftaran.
     *
     * Aturan validasi meliputi:
     * - **name**: wajib diisi, bertipe string, maksimal 255 karakter.
     * - **start_date**: wajib diisi, bertipe tanggal, format `Y-m-d`.
     * - **end_date**: wajib diisi, bertipe tanggal, format `Y-m-d`.
     * - **is_active**: wajib diisi, bertipe boolean. Menentukan apakah periode ini aktif.
     *
     * Request ini digunakan pada proses penyimpanan atau pembaruan data
     * periode pendaftaran di `PeriodeController@store` dan `PeriodeController@update`.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *         Array berisi aturan validasi yang diterapkan pada request ini.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            // Tanggal mulai periode, format Y-m-d
            'start_date' => ['required', 'date_format:Y-m-d'],

            // Tanggal akhir periode, format Y-m-d
            'end_date' => ['required', 'date_format:Y-m-d'],

            // Status aktif periode
            'is_active' => ['required', 'boolean'],
        ];
    }
}
