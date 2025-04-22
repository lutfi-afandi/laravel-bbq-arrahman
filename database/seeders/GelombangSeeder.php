<?php

namespace Database\Seeders;

use App\Models\Gelombang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelombangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('gelombangs')->truncate();

        $tahunAkademik = [
            '2021/2022',
            '2022/2023',
            '2023/2024',
            '2024/2025',
        ];

        foreach ($tahunAkademik as $tahun) {
            for ($i = 1; $i <= 3; $i++) {
                Gelombang::create([
                    'nomor' =>  $i,
                    'tahun_akademik' => $tahun,
                ]);
            }
        }
    }
}
