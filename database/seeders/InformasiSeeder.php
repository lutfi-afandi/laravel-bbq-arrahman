<?php

namespace Database\Seeders;

use App\Models\Informasi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('informasis')->truncate();

        Informasi::create([
            'gelombang_id' => 12,
            'mulai_daftar' => '2024-10-01',
            'akhir_daftar' => '2024-10-07',
            'status_pendaftaran' => 'dibuka',
            'biaya' => 60,
            'wa_konfirmasi' => '82179706078',
            'mulai_kbm' => '2024-10-10',
            'launching' => '2024-10-23',
            'mabit' => '2024-11-06',
            'jalasah' => '2024-11-06',
            'talkshow' => '2025-01-30',
            'cp1' => '85266272440',
            'nama_cp1' => 'Bagus',
            'cp2' => '82184697197',
            'nama_cp2' => 'Yulistiani',
            'pamflet' => 'arrahmanteknokrat_310953354_512778924002707_320370919775952814_n.jfif',
            'deskripsi' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
