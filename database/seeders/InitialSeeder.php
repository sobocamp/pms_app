<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Extracurricular;
use App\Models\RegistrationPeriod;

class InitialSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Pembina
        $pembina = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pembina@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'pembina',
        ]);

        // Siswa
        $siswa = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siswa@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // Ekstrakurikuler
        Extracurricular::create([
            'name' => 'Pencak Silat',
            'description' => 'Ekstrakurikuler pencak silat dengan fokus pada seni bela diri tradisional Indonesia.',
            'quota' => 30,
        ]);

        // Relasi pembina
        $extracurricular = Extracurricular::first();
        $extracurricular->pembina()->attach($pembina->id);

        // Periode pendaftaran awal
        RegistrationPeriod::create([
            'name' => 'Semester Genap 2025',
            'start_date' => now()->subDays(3),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);
    }
}
