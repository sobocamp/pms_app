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
            'name' => 'Eko Arif',
            'email' => 'eko@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'pembina',
        ]);

        $pembina1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'pembina',
        ]);

        // Siswa
        $siswa = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // Siswa
        $siswa1 = User::create([
            'name' => 'Bejo Margono',
            'email' => 'bejo@ekstra.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // Ekstrakurikuler
        Extracurricular::create([
            'name' => 'Pencak Silat',
            'description' => 'Ekstrakurikuler pencak silat dengan fokus pada seni bela diri tradisional Indonesia.',
            'quota' => 2,
        ]);

        Extracurricular::create([
            'name' => 'Bulutangkis',
            'description' => 'Ekstrakurikuler bulutangkis dengan fokus pada olahraga renang.',
            'quota' => 2,
        ]);

        // Relasi pembina
        $extracurricular = Extracurricular::find(1);
        $extracurricular->pembina()->attach($pembina->id);
        $extracurricular = Extracurricular::find(2);
        $extracurricular->pembina()->attach($pembina1->id);

        // Periode pendaftaran awal
        RegistrationPeriod::create([
            'name' => 'Semester Genap 2025',
            'start_date' => now()->subDays(3),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);
    }
}
