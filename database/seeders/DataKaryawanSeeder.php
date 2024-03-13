<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataKaryawan = [
            [
                'nip' => '24060121130057',
                'nama' => 'Salsabila Tuada',
                'atasan_id' => 3,
                'id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($dataKaryawan as $dataKar){
        Karyawan::create($dataKar);
       }
    }
}
