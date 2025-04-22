<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->truncate();

        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'role' => 'admin',
            'jenis_kelamin' => 'laki-laki',
            'no_wa' => '025555555',
            'password' => Hash::make('admin'), // Gunakan username sebagai password
            'email' => 'admin@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
