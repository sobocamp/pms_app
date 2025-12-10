# Sistem Manajemen Ekstrakurikuler Sekolah  
Aplikasi berbasis Laravel untuk mengelola kegiatan ekstrakurikuler dengan fitur multi-role (Admin, Pembina, Siswa), pendaftaran peserta, manajemen periode registrasi, approval, dan batas kuota.

---

## Fitur Utama
| Role | Fitur |
|------|-------|
| **Admin** | CRUD ekstrakurikuler, menentukan kuota, periode registrasi, mengatur pembina, approval/reject pendaftaran |
| **Pembina** | Melihat ekstrakurikuler yang dibina, daftar siswa, status peserta |
| **Siswa** | Melihat daftar ekstrakurikuler, mendaftar & membatalkan pendaftaran, melihat status pendaftaran |

---

## Teknologi
- Laravel 11
- Laravel UI (Bootstrap Auth)
- MySQL / MariaDB
- Blade Templates

---

## Instalasi
```bash
git clone https://github.com/sobocamp/ekskul-app.git
cd ekskul-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
