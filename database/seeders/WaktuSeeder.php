<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaktuSeeder extends Seeder
{
    public function run()
    {
        // DB::table('waktus')->truncate();

        $waktus = [
            ['hari' => 'Senin', 'jam' => '07.00'],
            ['hari' => 'Senin', 'jam' => '09.00'],
            ['hari' => 'Senin', 'jam' => '11.00'],
            ['hari' => 'Senin', 'jam' => '13.00'],
            ['hari' => 'Senin', 'jam' => '15.00'],
            ['hari' => 'Senin', 'jam' => '17.00'],
            ['hari' => 'Senin', 'jam' => '19.00'],

            ['hari' => 'Selasa', 'jam' => '07.00'],
            ['hari' => 'Selasa', 'jam' => '09.00'],
            ['hari' => 'Selasa', 'jam' => '11.00'],
            ['hari' => 'Selasa', 'jam' => '13.00'],
            ['hari' => 'Selasa', 'jam' => '15.00'],
            ['hari' => 'Selasa', 'jam' => '17.00'],
            ['hari' => 'Selasa', 'jam' => '19.00'],

            ['hari' => 'Rabu', 'jam' => '07.00'],
            ['hari' => 'Rabu', 'jam' => '09.00'],
            ['hari' => 'Rabu', 'jam' => '11.00'],
            ['hari' => 'Rabu', 'jam' => '13.00'],
            ['hari' => 'Rabu', 'jam' => '15.00'],
            ['hari' => 'Rabu', 'jam' => '17.00'],
            ['hari' => 'Rabu', 'jam' => '19.00'],

            ['hari' => 'Kamis', 'jam' => '07.00'],
            ['hari' => 'Kamis', 'jam' => '09.00'],
            ['hari' => 'Kamis', 'jam' => '11.00'],
            ['hari' => 'Kamis', 'jam' => '13.00'],
            ['hari' => 'Kamis', 'jam' => '15.00'],
            ['hari' => 'Kamis', 'jam' => '17.00'],
            ['hari' => 'Kamis', 'jam' => '19.00'],

            ['hari' => 'Jumat', 'jam' => '07.00'],
            ['hari' => 'Jumat', 'jam' => '09.00'],
            ['hari' => 'Jumat', 'jam' => '11.00'],
            ['hari' => 'Jumat', 'jam' => '13.00'],
            ['hari' => 'Jumat', 'jam' => '15.00'],
            ['hari' => 'Jumat', 'jam' => '17.00'],
            ['hari' => 'Jumat', 'jam' => '19.00'],

            ['hari' => 'Sabtu', 'jam' => '07.00'],
            ['hari' => 'Sabtu', 'jam' => '09.00'],
            ['hari' => 'Sabtu', 'jam' => '11.00'],
            ['hari' => 'Sabtu', 'jam' => '13.00'],
            ['hari' => 'Sabtu', 'jam' => '15.00'],
            ['hari' => 'Sabtu', 'jam' => '17.00'],
            ['hari' => 'Sabtu', 'jam' => '19.00'],
        ];

        DB::table('waktus')->insert($waktus);
    }
}
