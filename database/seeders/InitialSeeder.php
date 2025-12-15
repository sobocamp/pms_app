<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InitialSeeder extends Seeder
{
    public function run(): void
    {
        // Admin PMS
        $admin = User::create([
            'name' => 'Admin PMS',
            'email' => 'admin@pms.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Gudang
        $gudang = User::create([
            'name' => 'Gudang',
            'email' => 'gudang@pms.com',
            'password' => Hash::make('password'),
            'role' => 'gudang',
        ]);

        // Kasir
        $kasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@pms.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}
