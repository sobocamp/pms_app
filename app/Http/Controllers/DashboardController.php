<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 *
 * Controller ini bertanggung jawab untuk menampilkan halaman dashboard
 * yang sesuai dengan role pengguna yang sedang login.
 *
 * Terdapat tiga role yang berbeda: admin, pembina, dan siswa. Setiap role
 * memiliki dashboard yang berbeda dengan konten dan tampilan yang sesuai.
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    public function index()
    {
        // cek role user, lalu pindahkan ke halaman dashboard yang sesuai
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard.index');
        } elseif (Auth::user()->role == 'pembina') {
            return view('pembina.dashboard.index');
        } elseif (Auth::user()->role == 'siswa') {
            return view('siswa.dashboard.index');
        }
    }
}
