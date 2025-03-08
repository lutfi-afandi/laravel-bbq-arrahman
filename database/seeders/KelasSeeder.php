<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = [
            'A',
            'B',
            'C',
            'D',
            'Dx',
            'E',
            'Ex',
            'F',
            'Fx',
            'G',
            'GAB 1',
            'GAB 2',
            'GAB 3',
            'H',
            'Hx',
            'X1',
            'X2',
            'X3'
        ];

        foreach ($kelasList as $nama) {
            Kelas::create(['nama' => $nama]);
        }
    }
}
