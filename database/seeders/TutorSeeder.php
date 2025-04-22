<?php

namespace Database\Seeders;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('tutors')->truncate();
        $tutors = [
            [
                'name' => 'Ervin Ta',
                'username' => 'ervin12',
                'jenis_kelamin' => 'laki-laki',
                'no_wa' => '08121212',
                'password'  => Hash::make('username')
            ],
            [
                'name' => 'Mas Tutor Ganteng',
                'username' => 'tutor',
                'jenis_kelamin' => 'laki-laki',
                'no_wa' => '08223344',
                'password'  => Hash::make('tutor')
            ],
            [
                'name' => 'Rina Maharani',
                'username' => 'rina_m',
                'jenis_kelamin' => 'perempuan',
                'no_wa' => '08334455',
                'password'  => Hash::make('username')
            ],
            [
                'name' => 'Siti Nurhaliza',
                'username' => 'siti_n',
                'jenis_kelamin' => 'perempuan',
                'no_wa' => '08445566',
                'password'  => Hash::make('username')
            ],
        ];

        foreach ($tutors as $tutorData) {
            // Insert ke tabel tutors
            $tutor = Tutor::create($tutorData);

            // Insert ke tabel users berdasarkan tutor
            User::create([
                'name' => $tutor->name,
                'username' => $tutor->username,
                'role' => 'tutor',
                'jenis_kelamin' => $tutor->jenis_kelamin,
                'no_wa' => $tutor->no_wa,
                'password' => Hash::make($tutor->username), // Gunakan username sebagai password
                'email' => $tutor->username . '@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
